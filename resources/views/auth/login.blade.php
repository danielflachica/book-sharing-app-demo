@extends('layouts.public.index')

@section('content')
  <div class="container mx-auto p-4 md:p-8">
    <div class="flex flex-col gap-4 md:gap-8">

      <div class="flex-grow sm:flex-none bg-white p-4 sm:p-8 flex flex-col gap-2 sm:gap-4 shadow w-96">

        <h2 class="font-bold">
          {{ __('Login') }}
        </h2>

        <form method="POST"
          action="{{ route('login') }}"
          class="flex flex-col gap-2 sm:gap-4">
          @csrf

          {{-- Email --}}
          <div class="flex flex-col">

            {{ __('E-Mail Address') }}

            <input id="email"
              type="email"
              class="border-2 border-gray-200 p-2 {{ $errors->has('email') ? 'is-invalid' : '' }}"
              name="email"
              value="{{ old('email') }}"
              required
              autofocus>

            @if ($errors->has('email'))
              <span class="text-red-600"
                role="alert">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif

          </div>

          {{-- Password --}}
          <div class="flex flex-col">

            {{ __('Password') }}

            <input id="password"
              type="password"
              class="border-2 border-gray-200 p-2 {{ $errors->has('password') ? 'is-invalid' : '' }}"
              name="password"
              required>

            @if ($errors->has('password'))
              <span class="text-red-600"
                role="alert">
                <strong>
                  {{ $errors->first('password') }}
                </strong>
              </span>
            @endif

          </div>

          {{-- Remember Me --}}
          <div class="">
            <input class=""
              type="checkbox"
              name="remember"
              id="remember"
              {{ old('remember') ? 'checked' : '' }}>

            <label class=""
              for="remember">
              {{ __('Remember Me') }}
            </label>
          </div>

          <div class="flex flex-wrap justify-between gap-1 sm:gap-2">

            {{-- Login Button --}}
            <button type="submit"
              class="btn-primary w-full">
              {{ __('Login') }}
            </button>

            {{-- Forgot Password Link --}}
            <a class="btn-outlined-primary w-full"
              href="{{ route('password.request') }}">
              {{ __('Forgot Your Password?') }}
            </a>

          </div>

        </form>

      </div>

    </div>
  </div>
@endsection
