@extends('layouts.app.index')

@section('content')
  <div class="container mx-auto p-4 md:p-8">
    <div class="flex flex-col gap-4 md:gap-8 pt-12">

      @component('components.breadcrumb')
        @slot('current_page', 'Home')
      @endcomponent

      <card-basic title="Book Catalogue">
        <div class="grid grid-col-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4">

          @foreach($books as $book)
            <book-preview
              cover_photo="{{ $book->coverPhoto ? Storage::disk('public')->url($book->coverPhoto->image_path) : 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/2048px-No_image_available.svg.png' }}"
              title="{{ $book->title }}"
              isbn="{{ $book->isbn }}"
              year="{{ $book->year }}"
              added_by="{{ $book->uploader->name }}"
              last_updated="{{ $book->updated_at->diffForHumans() }}" />
            </book-preview>
          @endforeach

        </div>
        <template v-slot:footer>
          <div class="flex flex-wrap justify-end">
            <a href="{{ route('user.books.create') }}" class="btn-outlined-primary">
              Add a Book
            </a>
          </div>
        </template>
      </card-basic>

    </div>
  </div>
@endsection
