@extends('layouts.app.index')

@section('content')
  <div class="container mx-auto p-4 md:p-8">
    <div class="flex flex-col gap-4 md:gap-8 pt-12">

      @component('components.breadcrumb')
        @slot('pages', array(
          array('Home', route('home')),
        ))
        @slot('current_page', 'My Books')
      @endcomponent

      <card-basic title="My Books">
        <div class="mb-4">
          {{ $books->links() }}
        </div>
        <div class="grid grid-col-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4">

          @foreach($books as $book)
            <book-preview
              cover_photo="{{ $book->coverPhoto ? Storage::disk('public')->url($book->coverPhoto->image_path) : '' }}"
              title="{{ $book->title }}"
              isbn="{{ $book->isbn }}"
              year="{{ $book->year }}"
              added_by="{{ $book->uploader->name }}"
              last_updated="{{ $book->updated_at->diffForHumans() }}"
              editable
              csrf="{{ csrf_token() }}"
              delete_route="{{ route('user.books.destroy', ['book' => $book->id]) }}"
              edit_route="{{ route('user.books.edit', ['book' => $book->id]) }}"
              show_route="{{ route('user.books.show', ['book' => $book->id]) }}" />
            </book-preview>
          @endforeach

        </div>
        <div class="mt-4">
          {{ $books->links() }}
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
