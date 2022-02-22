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
        if ($request->has_url) {
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
        $path = null;
        if ($request->hasFile('cover_photo')) {
            // get photo from form
            $upload = $request->file('cover_photo');
            // upload image to storage
            $path = BookController::uploadImage($upload, $book->id);
        }
        elseif ($request->has_url) {
            $path = $request->cover_photo;
        }
        // save image path in database if not null
        if ($request->hasFile('cover_photo') || $request->has_url) {
            if ($path) {
                $book_img = new BookImage();
                $book_img->book_id = $book->id;
                $book_img->image_path = $path;
                $book_img->is_cover = TRUE;
                $book_img->has_url = $request->has_url ? TRUE : FALSE;

                if (!$book_img->save()) {
                    return back()->with('error', 'Uh oh! We couldn\'t add a cover photo to your copy of '.$book->title.'.');
                }
            } 
            else {
                return back()->with('error', 'Something went wrong when saving your book\'s cover photo');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
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
            (Str::endsWith($imgPath, '.jpg') || Str::endsWith($imgPath, '.jpeg') || Str::endsWith($imgPath, '.png'))
        )
        {
            $isValid = true;
        }

        return $isValid;
    }
}
