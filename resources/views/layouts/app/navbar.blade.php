<nav class="fixed flex justify-between items-center bg-primary text-white w-full z-10 shadow">

  {{-- Sidedrawer Button --}}
  <div class="flex items-center hover:bg-secondary-light hover:text-white">
    <button type="button"
      class="h-12 w-12"
      onclick="openSideDrawer()">
      <i class="material-icons material-icons-outlined">menu</i>
    </button>
  </div>

  <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 h-12">
    <span class="h-full flex items-center font-bold">
      <a href="{{ route('home') }}" class="text-white hover:text-blue-500">
        {{ config('app.name', 'LibDemo') }}
      </a>
    </span>
  </div>

  {{-- Profile Pic --}}
  <a href="{{ route('user.profile.show') }}">
    <div class="flex items-center justify-end gap-4 pr-4">
      <span class="hidden md:inline text-white">
        {{ Auth::user()->name ?? '' }}
      </span>
      @if(Auth::user()->profile_pic)
        <img src="{{ Storage::disk('public')->url(Auth::user()->profile_pic) }}"
          class="w-8 h-8 rounded-full object-cover border-2"
          alt="Profile pic">
      @else
        <img src="{{ asset('img/svg/undraw_male_avatar_323b.svg') }}"
          class="w-8 h-8 rounded-full object-cover border-2"
          alt="Default profile pic">
      @endif
    </div>
  </a>

</nav>
<div class="h-12"></div>
