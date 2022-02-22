@extends('layouts.app.index')

@section('content')
  <div class="container mx-auto p-4 md:p-8">
    <div class="flex flex-col gap-4 md:gap-8 pt-12">

      @component('components.breadcrumb')
        @slot('pages', array(
          array('Home', route('home')),
        ))
        @slot('current_page', 'Profile')
      @endcomponent

      {{-- Profile Details Card --}}
      <card-basic title="My Profile">
        <div class="flex flex-col gap-2 sm:gap-4">

          <div class="flex justify-center items-center">
            @if($user->profile_pic)
              <img src="{{ Storage::disk('public')->url($user->profile_pic) }}"
                class="w-32 h-32 rounded-full object-cover border-2"
                alt="Profile pic">
            @else
              <img src="{{ asset('img/svg/undraw_male_avatar_323b.svg') }}"
                class="w-32 h-32 rounded-full object-cover border-2"
                alt="Default profile pic">
            @endif
          </div>

          <input-basic label="Name"
            type="text"
            name="name"
            value="{{ $user->name ?? old('name') }}"
            error="{{ $errors->has('name') ? $errors->first('name') : '' }}"
            readonly>
          </input-basic>

          <input-basic label="Email"
            type="email"
            name="email"
            value="{{ $user->email ?? old('email') }}"
            error="{{ $errors->has('email') ? $errors->first('email') : '' }}"
            readonly
            footertext="{{ $user->email_verified_at != null ? 'Verified' : 'Not verified' }}">
          </input-basic>

          <input-basic label="Username"
            type="text"
            name="username"
            value="{{ '@'.$user->username ?? old('username') }}"
            error="{{ $errors->has('username') ? $errors->first('username') : '' }}"
            readonly>
          </input-basic>

          <input-basic label="Bio"
            type="text"
            name="bio"
            value="{{ $user->bio ?? old('bio') }}"
            error="{{ $errors->has('bio') ? $errors->first('bio') : '' }}"
            readonly>
          </input-basic>

        </div>
        <template v-slot:footer>
          <div class="flex flex-wrap justify-end">
            <a href="{{ route('user.profile.edit') }}"
            class="btn-primary w-full md:w-auto">Edit Profile</a>
          </div>
        </template>
      </card-basic>

      {{-- Update Password --}}
      {{-- <card-basic title="Update Password">
        <form id="update-password-form"
          method="POST"
          action="{{ route('admin.profile.password.update') }}"
          class="flex flex-col gap-2 sm:gap-4">

          @csrf

          <input-basic label="Current Password"
            type="password"
            name="current-password"
            value="{{ old('current-password') }}"
            error="{{ $errors->has('current-password') ? $errors->first('current-password') : '' }}"
            required>
          </input-basic>

          <input-basic label="New Password"
            type="password"
            name="new-password"
            value="{{ old('new-password') }}"
            error="{{ $errors->has('new-password') ? $errors->first('new-password') : '' }}"
            required>
          </input-basic>

          <input-basic label="Confirm New Password"
            type="password"
            name="new-password_confirmation"
            value="{{ old('new-password_confirmation') }}"
            error="{{ $errors->has('new-password_confirmation') ? $errors->first('new-password_confirmation') : '' }}"
            required>
          </input-basic>

          <div class="flex flex-wrap justify-end gap-1 sm:gap-2">
            <button class="btn-primary w-full md:w-auto" type="submit">
              Update Password
            </button>
          </div>

        </form>
      </card-basic> --}}

      {{-- Delete Account --}}
      {{-- <card-basic title="Delete Account">
        <div class="flex justify-center items-center p-8 text-red-600 text-center">
          Once you delete your account, you won't be able to recover it.
        </div>
        <template v-slot:footer>
          <div class="flex flex-wrap justify-end gap-1 sm:gap-2">
            <confirm-button class="btn-danger w-full md:w-auto"
              title="You're about to delete your own admin acccount"
              href="{{ route('admin.admins.destroy', ['administrator' => Auth::id()]) }}"
              csrf="{{ csrf_token() }}"
              method="DELETE">
              Delete Account
            </confirm-button>
          </div>
        </template>
      </card-basic> --}}

    </div>
  </div>
@endsection
