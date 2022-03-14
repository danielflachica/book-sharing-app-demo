@extends('layouts.app.index')

@section('content')
  <div class="container mx-auto p-4 md:p-8">
    <div class="flex flex-col gap-4 md:gap-8 pt-12">

      @component('components.breadcrumb')
        @slot('pages', array(
          array('Home', route('home')),
          array('My Books', route('user.books.index')),
        ))
        @slot('current_page', $book->title)
      @endcomponent

      <card-basic title="View Book Details">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
          {{-- Book Details --}}
          <div class="lg:col-span-3 flex flex-col md:flex-row items-stretch gap-4">
            {{-- cover photo --}}
            <div class="flex flex-col items-start w-full md:w-auto">
              @isset($book->coverPhoto)
                <img class="h-80 w-56 object-cover self-center border-2 border-gray-200 bg-gray-200" 
                  src="{{ Storage::disk('public')->url($book->coverPhoto->image_path) }}" 
                  alt="{{ $book->title }}">
              @else
                <img class="h-80 w-56 object-cover self-center border-2 border-gray-200 bg-gray-200"
                  src="{{ asset('img/NoImageAvailable.jpg') }}"
                  alt="No Image Available">
              @endisset
            </div>
            {{-- details --}}
            <div class="w-full flex flex-col">
              {{-- title --}}
              <h1 class="text-4xl">
                {{ $book->title }}
              </h1>
              {{-- author --}}
              @isset($book->author)
                <h5 class="text-gray-500">By {{ $book->author }}</h5>
              @else
                <h5 class="text-gray-500 italic">Author unavailable</h5>
              @endif
              {{-- synopsis --}}
              <div class="whitespace-pre-line text-lg font-light text-gray-800 {{ isset($book->synopsis) ? 'mt-2' : 'mt-0' }}">
                {{ $book->synopsis }}
              </div>
              <hr class="my-4">
              <table class="table-auto border-separate text-gray-900" style="">
                {{-- isbn-13 --}}
                <tr class="text-left">
                  <th>ISBN-13</th>
                  <td>{{ $book->isbn }}</td>
                </tr>
                {{-- year --}}
                <tr class="text-left">
                  <th>Year Published</th>
                  <td>{{ $book->year }}</td>
                </tr>
                {{-- edition --}}
                <tr class="text-left">
                  <th>Edition</th>
                  <td>{{ $book->edition }}</td>
                </tr>
                {{-- page count --}}
                <tr class="text-left">
                  <th>Number of Pages</th>
                  <td>{{ $book->page_count }}</td>
                </tr>
              </table>
            </div>
          </div>

          {{-- Sidebar --}}
          <div class="h-full p-4 bg-gray-100">
            Sidebar
          </div>
      </card-basic>

    </div>
  </div>
@endsection
