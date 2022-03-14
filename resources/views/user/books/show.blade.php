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

      <card-basic title="{{ $book->title }}">
      </card-basic>

    </div>
  </div>
@endsection
