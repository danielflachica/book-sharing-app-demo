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
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 md:gap-6 xl:gap-8">
          {{-- Book Details --}}
          <div class="lg:col-span-3 flex flex-col md:flex-row items-stretch gap-4 md:gap-6 xl:gap-8">
            {{-- cover photo --}}
            <div class="flex flex-col items-start w-full md:w-auto">
              @isset($book->coverPhoto)
                <img class="h-80 xl:h-96 w-52 md:w-72 xl:w-80 object-cover self-center border-2 border-gray-200 bg-gray-200" 
                  src="{{ Storage::disk('public')->url($book->coverPhoto->image_path) }}" 
                  alt="{{ $book->title }}">
              @else
                <img class="h-80 xl:h-96 w-52 md:w-72 xl:w-80 object-cover self-center border-2 border-gray-200 bg-gray-200"
                  src="{{ asset('img/NoImageAvailable.jpg') }}"
                  alt="No Image Available">
              @endisset
            </div>
            {{-- details --}}
            <div class="w-full flex flex-col">
              {{-- title --}}
              <h1 class="text-4xl break-words">
                {{ $book->title }}
              </h1>
              {{-- author --}}
              @isset($book->author)
                <h5 class="text-gray-500">By {{ $book->author }}</h5>
              @else
                <h5 class="text-gray-500 italic">Author unavailable</h5>
              @endif
              {{-- synopsis --}}
              <div class="whitespace-pre-line text-lg font-light text-gray-800">
                {{ $book->synopsis }}
              </div>
              
              <hr class="my-4">

              <table class="table-fixed border-separate text-gray-900">
                {{-- isbn-13 --}}
                <tr class="text-left">
                  <th class="w-44">ISBN-13</th>
                  <td>{{ $book->isbn }}</td>
                </tr>
                {{-- year --}}
                <tr class="text-left">
                  <th>Year Published</th>
                  @isset($book->year)
                    <td>{{ $book->year }}</td>
                  @else
                    <td class="text-gray-500 italic">Unavailable</td>
                  @endisset
                </tr>
                {{-- edition --}}
                <tr class="text-left">
                  <th>Edition</th>
                  @isset($book->edition)
                    <td>{{ $book->edition }}</td>
                  @else
                    <td class="text-gray-500 italic">Unavailable</td>
                  @endisset
                </tr>
                {{-- page count --}}
                <tr class="text-left">
                  <th>Number of Pages</th>
                  @isset($book->page_count)
                    <td>{{ $book->page_count }}</td>
                  @else
                    <td class="text-gray-500 italic">Unavailable</td>
                  @endisset
                </tr>
              </table>

              <hr class="my-4">
              
              <div class="flex w-full gap-2">
                <a href="#" class="btn-primary w-full md:w-auto">
                  Get a Copy
                </a>
                <a href="#" class="btn-outlined-primary w-full md:w-auto">
                  Save to Wishlist
                </a>
              </div>
            </div>
          </div>

          {{-- Sidebar --}}
          <div class="h-full p-4 bg-gray-100">
            Sidebar
          </div>
        </div>
      </card-basic>

    </div>
  </div>
@endsection
