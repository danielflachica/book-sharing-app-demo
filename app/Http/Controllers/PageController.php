<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Show the application dashboard or landing page depending on authentication status
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        if(Auth::check()) {
            $books = Book::orderBy('updated_at', 'DESC')->paginate(15);
            return view('user.home', compact('books'));
        }
        return view('landing');
    }

    // Profile
    public function profile()
    {
        $user = User::find(Auth::id());
        $uri = 'profile';
        return view('user.profile.index', compact('user', 'uri'));
    }

    public function profileEdit()
    {
        $user = User::find(Auth::id());
        $uri = 'profile';
        return view('user.profile.edit', compact('user', 'uri'));
    }

    public function profileUpdate()
    {
        
    }
    
    public function redirectHome()
    {
        return redirect(route('home'));
    }
}
