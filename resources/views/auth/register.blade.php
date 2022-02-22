@extends('layouts.public.index')

@section('content')
  <div class="container mx-auto p-4 md:p-8">
    <div class="flex flex-col gap-4 md:gap-8">

      <div class="flex-grow sm:flex-none bg-white p-4 sm:p-8 flex flex-col gap-2 sm:gap-4 shadow w-96">

        <h2 class="font-bold">
          {{ __('Register') }}
        </h2>

        <form method="POST"
          action="{{ route('register') }}"
          class="flex flex-col gap-2 sm:gap-4">
          @csrf

          {{-- Name --}}
          <div class="flex flex-col">
            {{ __('Name') }}

            <input id="name"
              type="text"
              class="border-2 border-gray-200 p-2 {{ $errors->has('name') ? 'is-invalid' : '' }}"
              name="name"
              value="{{ old('name') }}"
              required
              autofocus>

            @if ($errors->has('name'))
              <span class="text-red-600"
                role="alert">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
            @endif
          </div>

          {{-- Email --}}
          <div class="flex flex-col">
            {{ __('E-Mail Address') }}

            <input id="email"
              type="email"
              class="border-2 border-gray-200 p-2 {{ $errors->has('email') ? 'is-invalid' : '' }}"
              name="email"
              value="{{ old('email') }}"
              required>

            @if ($errors->has('email'))
              <span class="text-red-600"
                role="alert">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
          </div>

          {{-- Username --}}
          <div class="flex flex-col">
            {{ __('Username') }}

            <input id="username"
              type="text"
              class="border-2 border-gray-200 p-2 {{ $errors->has('username') ? 'is-invalid' : '' }}"
              name="username"
              value="{{ old('username') }}"
              required>

            @if ($errors->has('username'))
              <span class="text-red-600"
                role="alert">
                <strong>{{ $errors->first('username') }}</strong>
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

          {{-- Confirm Password --}}
          <div class="flex flex-col">
            {{ __('Confirm Password') }}

            <input id="password-confirm"
              type="password"
              class="border-2 border-gray-200 p-2"
              name="password_confirmation"
              required>
          </div>

          <div class="flex flex-wrap justify-between gap-1 sm:gap-2 mt-2">
            {{-- Register Button --}}
            <button type="submit"
              class="btn-primary w-full">
              {{ __('Register') }}
            </button>

            {{-- Login Button --}}
            <a class="btn-outlined-primary w-full"
              href="{{ route('login') }}">
              {{ __('Already have an account?') }}
            </a>
          </div>
        </form>

      </div>
    </div>
  </div>
@endsection
