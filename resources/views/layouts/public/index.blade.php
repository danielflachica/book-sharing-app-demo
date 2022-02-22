<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>

    {{-- Google Analytics --}}
    {{-- @include('components.google-analytics-tracker') --}}

    {{-- Meta --}}
    @include('layouts.public.meta')

    {{-- CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" crossorigin="anonymous">
    @yield('styles')

  </head>
  <body>

    <div id="app">

      <scroll-to-top></scroll-to-top>

      @include('layouts.public.navbar')

      <main class="bg-light" role="main">
        @yield('content')
      </main>

      @include('layouts.app.footer')
      {{-- @include('components.cookies') --}}

    </div>

    {{-- JavaScript --}}
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')

  </body>
</html>
