<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'email' => 'required|string|email|max:90|unique:Users,email',
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'middle_initial' => 'nullable|string|max:1',
            'birthdate' => 'nullable|date',
        ]);

        $user = new User();
        $user->email = $request->input('email');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->middle_initial = $request->input('middle_initial', null);
        $user->birthdate = $request->input('birthdate', null);

        if ($user->save()) {
            Mail::to($user->email)->send(new Newuser($user));
            return redirect(route('user.users.index'))->with('success', 'Sent email to new user for verification.');
        }
        return back()->with('error', 'Could not add user.');
    }

    // If the first email fails, have an option to email again
    public function sendEmailInvite(User $user)
    {
        // TODO: Add error catching but for some reason surrounding the line below
        // will end up failing the if statement BUT actually sends the email
        // I think it has something to do with queues.
        Mail::to($user->email)->send(new Newuser($user));

        return redirect(route('user.users.index'))
            ->with('success', 'Sent email to user for verification.');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = User::find(Auth::id());
        $uri = 'profile';
        return view('user.profile.index', compact('user', 'uri'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = User::find(Auth::id());
        $uri = 'profile';
        return view('user.profile.edit', compact('user', 'uri'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|between:1,255',
            'username' => 'required|string|between:1,255|alpha_dash|unique:users,username,'.$user->id,
            'bio' => 'nullable|string|max:600',
            'profile_pic' => 'nullable|image|max:2048',
        ]);

        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->bio = $request->input('bio', null);

        if ($request->hasFile('profile_pic')) {
            $upload = $request->file('profile_pic'); // get photo from form

            // upload image to storage
            $path = UserController::uploadImage($upload, Auth::id());
            if ($path != false) {
                // save image path in database
                $user->profile_pic = $path;
            } else {
                return back()->with('error', 'Could not save your profile picture');
            }
        }

        if ($user->save()) {
            return redirect(route('user.profile.show'))->with('success', 'Updated your profile');
        }

        return back()->with('error', 'Could not update your profile');
    }

    public static function uploadImage($upload, $userID)
    {
        return Storage::disk('public')->putFile('users/' . $userID, $upload);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // If more than 1 user account exists
        if (User::all()->count() > 1) {
            // If deleting another user
            $route_name = "user.users.index";

            // If deleting own user account
            if ($user->id == Auth::id()) {
                $route_name = "login";
            }

            if ($user->delete()) {
                return redirect(route($route_name))->with('success', 'User successfully deleted.');
            }

            return back()->with('error', 'Could not delete User.');
        }

        // If only 1 user account exists
        return back()->with('error', 'There must be at least one useristrative account at all times. Your account was not deleted.');
    }

    public function restore($user)
    {
        $user = User::withTrashed()->find($user);
        if ($user->trashed()) {
            if ($user->restore()) {
                return back()->with('success', 'Restored user.');
            }
            return back()->with('error', 'Could not restore this user. Please contact the site user.');
        } else {
            return back()->with('warning', 'Could not restore an user that is not deleted');
        }
        return back()->with('error', 'Could not restore this user. Please contact the site user.');
    }

    public function forceDelete($user)
    {
        $user = User::withTrashed()->find($user);

        if ($user->id == Auth::id()) {
            return back()->with('warning', 'You cannot delete yourself.');
        }

        if ($user->forceDelete()) {
            return back()->with('success', 'Force deleted User.');
        }
        return back()->with('error', 'Could not force delete User.');
    }

    public function destroyPicture(User $user)
    {
        if ($user->profile_pic) {
            $path = $user->profile_pic;
            $user->profile_pic = null;

            if ($user->save()) {

                if (Storage::disk('public')->delete($path)) {
                    return redirect(route('user.profile.show'))->with('success', 'Profile picture successfully deleted.');
                }

                return back()->with('error', 'Could not delete profile picture.');
            }

            return back()->with('error', 'Could not save your profile.');
        }

        return back()->with('error', 'Your account does not currently have a profile picture.');
    }

    // TODO: Add this back as an option for users
    // Verify user email
    public function verifyEmail(Request $request, $token)
    {
        $email = $request->query('email');

        // Find password reset with the email in the URL
        $password_reset = DB::table('password_resets')->where('email', $email)->first();

        // Find the user with the email in the URL
        $user = User::where('email', $email)->first();

        if (!isset($password_reset)) {
            return back()->with('error', 'Invalid request.');
        }

        // CHeck if the token in the url is exists and it not yet used
        if (Hash::check($token, $password_reset->token) != 1) {
            return back()->with('error', 'Invalid token.');
        }

        if ($password_reset->email != $user->email) {
            return back()->with('error', 'Invalid email.');
        }

        // Verify email
        $user->email_verified_at = date('Y-m-d H:i:s');
        if ($user->save()) {
            return redirect('user')->with('success', 'Verified email.');
        }
        return back()->with('error', 'Could not verify email.');
    }
}
