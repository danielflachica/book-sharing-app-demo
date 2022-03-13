<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\BookImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Naxon\UrlUploadedFile\UrlUploadedFile;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::where('added_by', Auth::id())->orderBy('updated_at', 'DESC')->paginate(15);
        $uri = 'books';
        return view('user.books.index', compact('books', 'uri'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::find(Auth::id());
        $uri = 'books';
        return view('user.books.create', compact('user', 'uri'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|between:1,255',
            'isbn' => 'required|string|numeric|digits:13|starts_with:978,979',
            'year' => 'nullable|integer|between:1000,'.Carbon::now()->year,
            'edition' => array('nullable', 'string', 'regex:/^\d+(st|nd|rd|th)$/'),
            'page_count' => 'nullable|integer|min:1',
            'synopsis' => 'nullable|string|max:1000',
            // 'cover_photo' => 'nullable|mimes:jpg,jpeg,png|max:1000',
            // 'images' => 'nullable|image|max:2048',
            // 'images.*' => 'nullable|mimes:jpg,jpeg,png|max:200'
        ]);

        // validate image url pattern
        if ($request->from_url) {
            if (!BookController::checkImageUrl($request->cover_photo)) {
                return back()->with('error', 'The URL you specified does not point to a valid image.');
            }
        }

        $book = new Book();
        $book->title = $request->title;
        $book->isbn = $request->isbn;
        $book->year = $request->year;
        $book->edition = $request->edition;
        $book->page_count = $request->page_count;
        $book->synopsis = $request->synopsis;
        $book->added_by = Auth::id();

        if (!$book->save()) {
            return back()->with('error', 'Uh oh! We couldn\'t save your copy of '.$book->title.'.');
        }

        // add cover photo to newly created book, if any
        $uploaded_file = null;
        $path = null;
        // determine source of uploaded file (user or URL)
        if ($request->hasFile('cover_photo')) {
            // get photo from form
            $uploaded_file = $request->file('cover_photo');
            // save updated image to storage
            $path = BookController::uploadImage($uploaded_file, $book->id);
        }
        elseif ($request->from_url) {
            // get photo from url
            $uploaded_file = UrlUploadedFile::createFromUrl($request->cover_photo);
            // save updated image to storage
            $path = BookController::uploadImage($uploaded_file, $book->id);
        }
        // save image path in database if not null
        if ($request->hasFile('cover_photo') || $request->from_url) {
            if ($path) {
                $book_img = new BookImage();
                $book_img->book_id = $book->id;
                $book_img->image_path = $path;
                $book_img->is_cover = TRUE;
                $book_img->from_url = $request->from_url ? TRUE : FALSE;

                if (!$book_img->save()) {
                    return back()->with('error', 'Uh oh! We couldn\'t add a cover photo to your copy of '.$book->title.'.');
                }
            } 
            else {
                return back()->with('error', 'Something went wrong when saving your book\'s cover photo.');
            }
        }

        return redirect(route('user.books.index'))->with('success', 'Your copy of '.$book->title.' is now public!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $uri = 'books';
        return view('user.books.edit', compact('book', 'uri'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|between:1,255',
            'isbn' => 'required|string|numeric|digits:13|starts_with:978,979',
            'year' => 'nullable|integer|between:1000,'.Carbon::now()->year,
            'edition' => array('nullable', 'string', 'regex:/^\d+(st|nd|rd|th)$/'),
            'page_count' => 'nullable|integer|min:1',
            'synopsis' => 'nullable|string|max:1000',
            // 'cover_photo' => 'nullable|mimes:jpg,jpeg,png|max:1000',
            // 'images' => 'nullable|image|max:2048',
            // 'images.*' => 'nullable|mimes:jpg,jpeg,png|max:200'
        ]);

        // validate image url pattern
        if ($request->from_url) {
            if (!BookController::checkImageUrl($request->cover_photo)) {
                return back()->with('error', 'The URL you specified does not point to a valid image.');
            }
        }

        $book->title = $request->title;
        $book->isbn = $request->isbn;
        $book->year = $request->year;
        $book->edition = $request->edition;
        $book->page_count = $request->page_count;
        $book->synopsis = $request->synopsis;

        if (!$book->save()) {
            return back()->with('error', 'Uh oh! We couldn\'t update your copy of '.$book->title.'.');
        }

        // add updated cover photo to created book, if any
        $uploaded_file = null;
        $path = null;
        // determine source of uploaded file (user or URL)
        if ($request->hasFile('cover_photo')) {
            // get photo from form
            $uploaded_file = $request->file('cover_photo');
            // save updated image to storage
            $path = BookController::uploadImage($uploaded_file, $book->id);
        }
        elseif ($request->from_url) {
            // get photo from url
            $uploaded_file = UrlUploadedFile::createFromUrl($request->cover_photo);
            // save updated image to storage
            $path = BookController::uploadImage($uploaded_file, $book->id);
        }
        // save updated image path in database if not null
        if ($request->hasFile('cover_photo') || $request->from_url) {
            if ($path) {
                // unset all past cover photos of that book
                $prev_cover_photos = BookImage::where('book_id', $book->id)->get();
                if ($prev_cover_photos) {
                    foreach ($prev_cover_photos as $img)  {
                        $img->is_cover = FALSE;
                        if (!$img->save()) {
                            return back()->with('error', 'Something went wrong when updating your book\'s cover photo.');
                        }
                    }
                }

                $book_img = BookImage::where('book_id', $book->id)->first();
                if (!$book_img) {
                    $book_img = new BookImage();
                }
                $book_img->book_id = $book->id;
                $book_img->image_path = $path;
                $book_img->is_cover = TRUE;
                $book_img->from_url = $request->from_url ? TRUE : FALSE;

                if (!$book_img->save()) {
                    return back()->with('error', 'Uh oh! We couldn\'t updated the cover photo of your copy of '.$book->title.'.');
                }
            } 
            else {
                return back()->with('error', 'Something went wrong when updating your book\'s cover photo.');
            }
        }

        return redirect(route('user.books.index'))->with('success', 'Your copy of '.$book->title.' was updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        if ($book->uploader->id != Auth::id()) {
            return back()->with('error', 'You can\'t delete other people\'s books!');
        }

        $title = $book->title;
        if ($book->delete()) {
            return redirect(route('user.books.index'))->with('success', 'Deleted '.$title.'.');
        }
        return back()->with('error', 'Could not delete '.$title.'.');
    }

    public static function uploadImage($upload, $bookID)
    {
        return Storage::disk('public')->putFile('books/' . $bookID, $upload);
    }

    public static function checkImageUrl($imgPath)
    {
        $isValid = false;
        $imgPath = strtolower($imgPath);

        if (
            (Str::startsWith($imgPath, 'https://') || Str::startsWith($imgPath, 'http://'))
            &&
            // TO-DO: This doesn't check for GET parameters AFTER the file extension (e.g. filename.jpg?foo=bar)
            (Str::endsWith($imgPath, '.jpg') || Str::endsWith($imgPath, '.jpeg') || Str::endsWith($imgPath, '.png'))
        )
        {
            $isValid = true;
        }

        return $isValid;
    }
}
