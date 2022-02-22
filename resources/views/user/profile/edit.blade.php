@extends('layouts.app.index')

@section('content')
  <div class="container mx-auto p-4 md:p-8">
    <div class="flex flex-col gap-4 md:gap-8 pt-12">

      @component('components.breadcrumb')
        @slot('pages', array(
          array('Home', route('home')),
          array('Profile', route('user.profile.show')),
        ))
        @slot('current_page', 'Edit')
      @endcomponent

      <card-basic title="Edit Profile">
        <form id="edit-profile-form"
          method="POST"
          action="{{ route('user.profile.update', ['user' => $user->id]) }}"
          enctype="multipart/form-data"
          class="flex flex-col gap-2 sm:gap-4">

          @csrf

          @method('PUT')

          <div class="flex justify-center items-start">
            @if($user->profile_pic)
              <img src="{{ Storage::disk('public')->url($user->profile_pic) }}"
                class="w-32 h-32 rounded-full object-cover border-2"
                alt="Profile pic">
              <button data-action="{{ route('user.profile.picture.destroy', ['user' => Auth::id()]) }}"
                class="btn-danger p-0"
                title="Delete profile pic">
                <i class="material-icons">close</i>
              </button>
            @else
              <img src="{{ asset('img/svg/undraw_male_avatar_323b.svg') }}"
                class="w-32 h-32 rounded-full object-cover border-2"
                alt="Default profile pic">
            @endif
          </div>

          <input-basic label="Profile Pic"
            type="file"
            name="profile_pic"
            accept="image/x-png,image/gif,image/jpeg,image/svg">
          </input-basic>

          <input-basic label="Name"
            type="name"
            name="name"
            value="{{ $user->name ?? old('name') }}"
            error="{{ $errors->has('name') ? $errors->first('name') : '' }}"
            required>
          </input-basic>

          <input-basic label="Email"
            type="email"
            name="email"
            value="{{ $user->email ?? old('email') }}"
            error="{{ $errors->has('email') ? $errors->first('email') : '' }}"
            footertext="{{ $user->email_verified_at != null ? 'Verified' : 'Not verified' }}"
            readonly>
          </input-basic>

          <input-basic label="Username"
            type="text"
            name="username"
            value="{{ $user->username ?? old('username') }}"
            error="{{ $errors->has('username') ? $errors->first('username') : '' }}">
          </input-basic>

          <label class="pb-0" for="bio">Bio</label>
          <textarea
            name="bio"
            class="rounded border-2 border-gray-200 focus:ring focus:outline-none p-2 mt-0"
            error="{{ $errors->has('bio') ? $errors->first('bio') : '' }}"
            rows="5">{{ $user->bio ?? old('bio') }}
          </textarea>

          <div class="flex flex-wrap justify-end">
            <button type="submit" class="btn-primary w-full md:w-auto">
              Update Profile
            </button>
          </div>

        </form>
      </card-basic>

    </div>
  </div>
@endsection
