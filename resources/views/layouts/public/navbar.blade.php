<nav class="fixed flex justify-between items-center bg-primary text-white w-full z-10 shadow">

  {{-- Sidedrawer Button --}}
  {{-- <div class="flex items-center">
    <div class="h-12 w-12">
      <i class="material-icons material-icons-outlined text-primary">menu</i>
    </div>
  </div> --}}

  <div class="flex gap-4 h-12 pl-4">
    <a href="{{ route('home') }}" class="h-full flex items-center font-bold text-white hover:text-blue-500">
      Public Side
    </a>
  </div>

  {{-- Login/Register --}}
  @guest
    <div class="flex gap-4 pr-4">
      <a class="text-white hover:text-blue-500" href="{{ route('login') }}">{{ __('Login') }}</a>

      <a class="text-white hover:text-blue-500" href="{{ route('register') }}">{{ __('Register') }}</a>
    </div>
  @endguest

</nav>
<div class="h-12"></div>
