@extends('layouts.app.index')

@section('content')
  <div class="container mx-auto p-4 md:p-8">
    <div class="flex flex-col gap-4 md:gap-8">

      <div class="grid grid-cols-1">
        <card-basic title="Card Title">
          <div class="flex flex-col items-center justify-center p-8 gap-4">
            <span class="text-center">
              Hello, {{ Auth::user()->name }}!
              {{ __('You are logged in!') }}
            </span>

            <a href="{{ route('user.books.create') }}" class="btn-outlined-primary">
              Add a Book
            </a>

            @if(Route::has('logout'))
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="btn-primary"
                  href="{{ route('logout') }}"
                  onclick="event.preventDefault(); this.closest('form').submit();">
                  <i class="material-icons mr-2">exit_to_app</i>
                  Logout
                </a>
              </form>
            @endif
          </div>
        </card-basic>
      </div>

    </div>
  </div>
@endsection
