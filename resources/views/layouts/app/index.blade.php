<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
  <head>

    {{-- Google Analytics --}}
    {{-- @include('components.google-analytics-tracker') --}}

    {{-- Meta --}}
    @include('layouts.app.meta')

    {{-- CSS --}}
    <link href="{{ asset('css/app.css') }}" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" crossorigin="anonymous">
    @yield('styles')

  </head>
  <body class="h-full bg-gray-200">

    <div id="app" class="flex flex-col h-full">

      <confirmation-modal></confirmation-modal>
      <scroll-to-top></scroll-to-top>

      @include('layouts.app.sidedrawer')
      @include('layouts.app.navbar')
      @include('components.alerts')

      <div class="flex-grow">
        @yield('content')
      </div>

      @include('layouts.app.footer')

    </div>

    {{-- JavaScript --}}
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')
    {{-- @yield('map_scripts') --}}

  </body>
</html>
