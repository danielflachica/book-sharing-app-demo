@extends('layouts.app.index')

@section('content')
  <div class="container mx-auto p-4 md:p-8">
    <div class="flex flex-col gap-4 md:gap-8 pt-12">

      @component('components.breadcrumb')
        @slot('pages', array(
          array('Home', route('home')),
          array('My Books', route('user.books.index')),
        //   array('Book', route('user.books.show')),
        ))
        @slot('current_page', 'Edit')
      @endcomponent

      <card-basic title="Edit Book">
        <form id="edit-book-form"
          method="POST"
          action="{{ route('user.books.update', ['book' => $book]) }}"
          enctype="multipart/form-data"
          class="flex flex-col gap-2 sm:gap-4">

          @csrf

          @method('PATCH')

          <input-basic label="Title"
            type="text"
            name="title"
            value="{{ $book->title }}"
            error="{{ $errors->has('title') ? $errors->first('title') : '' }}"
            placeholder="What book do you own?"
            required>
          </input-basic>

          <input-basic label="ISBN-13"
            type="text"
            name="isbn"
            value="{{ $book->isbn }}"
            error="{{ $errors->has('isbn') ? $errors->first('isbn') : '' }}"
            placeholder="What is your book's 13-digit International Standard Book Number?"
            footertext="Can't find your copy's ISBN? Try searching for it here."
            footerhref="https://isbnsearch.org"
            required>
          </input-basic>

          <input-basic label="Year"
            type="number"
            name="year"
            value="{{ $book->year }}"
            error="{{ $errors->has('year') ? $errors->first('year') : '' }}"
            placeholder="When was your book published?"
            min="1000"
            max="{{ Carbon\Carbon::now()->year }}">
          </input-basic>

          <input-basic label="Edition"
            type="text"
            name="edition"
            value="{{ $book->edition }}"
            error="{{ $errors->has('edition') ? $errors->first('edition') : '' }}"
            placeholder="Which edition is your copy? (e.g. 1st, 2nd, 3rd)">
          </input-basic>

          <input-basic label="Page Count"
            type="number"
            name="page_count"
            value="{{ $book->page_count }}"
            error="{{ $errors->has('page_count') ? $errors->first('page_count') : '' }}"
            placeholder="How many pages does your book have?"
            min="1">
          </input-basic>

          <label class="pb-0" for="synopsis">Synopsis</label>
          <textarea
            name="synopsis"
            class="rounded border-2 border-gray-200 focus:ring focus:outline-none p-2 mt-0"
            error="{{ $errors->has('synopsis') ? $errors->first('synopsis') : '' }}"
            placeholder="Help borrowers by providing a summary of your book. The short description at the back of your copy should work just fine!"
            rows="5">{{ $book->synopsis }}
          </textarea>

          <label>Cover Photo</label>

          @if($book->coverPhoto)
            <img class="h-80 w-48 object-cover border-2 border-gray-200"
              src="{{ $book->coverPhoto ? Storage::disk('public')->url($book->coverPhoto->image_path) : '' }}">
          @endif

          <image-uploader
            name="cover_photo">
          </image-uploader>

          <div class="flex flex-wrap justify-end">
            <button type="submit" class="btn-primary w-full md:w-auto" id="submit-all">
              Update Book
            </button>
          </div>

        </form>
      </card-basic>

    </div>
  </div>
@endsection
