@extends('layouts.app.index')

@section('styles')
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.css" crossorigin="anonymous"> --}}
  <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" crossorigin="anonymous"/>
@endsection

@section('content')
  <div class="container mx-auto p-4 md:p-8">
    <div class="flex flex-col gap-4 md:gap-8 pt-12">

      @component('components.breadcrumb')
        @slot('pages', array(
          array('Home', route('home')),
          array('My Books', route('user.books.index')),
        ))
        @slot('current_page', 'Add a Book')
      @endcomponent

      <card-basic title="Add a Book">
        <form id="add-book-form"
          method="POST"
          action="{{ route('user.books.store') }}"
          enctype="multipart/form-data"
          class="flex flex-col gap-2 sm:gap-4">

          @csrf

          <input-basic label="Title"
            type="text"
            name="title"
            value="{{ old('title') }}"
            error="{{ $errors->has('title') ? $errors->first('title') : '' }}"
            placeholder="What book do you own?"
            required>
          </input-basic>

          <input-basic label="ISBN-13"
            type="text"
            name="isbn"
            value="{{ old('isbn') }}"
            error="{{ $errors->has('isbn') ? $errors->first('isbn') : '' }}"
            placeholder="What is your book's 13-digit International Standard Book Number?"
            footertext="Can't find your copy's ISBN? Try searching for it here."
            footerhref="https://isbnsearch.org"
            required>
          </input-basic>

          <input-basic label="Year"
            type="number"
            name="year"
            value="{{ old('year') }}"
            error="{{ $errors->has('year') ? $errors->first('year') : '' }}"
            placeholder="When was your book published?"
            min="1000"
            max="{{ Carbon\Carbon::now()->year }}">
          </input-basic>

          <input-basic label="Edition"
            type="text"
            name="edition"
            value="{{ old('edition') }}"
            error="{{ $errors->has('edition') ? $errors->first('edition') : '' }}"
            placeholder="Which edition is your copy? (e.g. 1st, 2nd, 3rd)">
          </input-basic>

          <input-basic label="Page Count"
            type="number"
            name="page_count"
            value="{{ old('page_count') }}"
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
            rows="5">{{ old('synopsis') }}
          </textarea>

          {{-- <input-basic label="Images"
            type="file"
            name="images[]"
            error="{{ $errors->has('images') ? $errors->first('images') : '' }}"
            multiple
            footertext="You can select up to 30 images.">
          </input-basic> --}}
          
          {{-- <div class="bg-red-300">
            <p>Cover Photo</p>
            <div class="flex gap-2 bg-green-300">
              <button class="p-2 bg-green-400"
                type="button">
                Upload a Photo
              </button>
              <button class="p-2 bg-green-500"
                type="button">
                Paste from Url
              </button>
            </div>
            <div class="bg-blue-300 p-4 pb-0">
              <input-basic
                type="file"
                name="cover_photo"
                error="{{ $errors->has('cover_photo') ? $errors->first('cover_photo') : '' }}"
                footertext="Select a photo that will help people recognize your book. Max size: 1,000KB">
              </input-basic>
            </div>
          </div> --}}
          <image-uploader label="Cover Photo"
            name="cover_photo">
          </image-uploader>

          <div class="flex flex-wrap justify-end">
            <button type="submit" class="btn-primary w-full md:w-auto" id="submit-all">
              Add Your Copy!
            </button>
          </div>

        </form>
      </card-basic>

    </div>
  </div>
@endsection

@section('scripts')
  <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
@endsection