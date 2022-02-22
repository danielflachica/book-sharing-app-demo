<card-basic>
  <div class="flex items-center">

    @if(isset($pages))
      @foreach($pages as $page)
        <a class="text-primary hover:text-blue-500"
          href="{{ $page[1] }}">
          {{ $page[0] }}
        </a>
        <i class="material-icons text-gray-400">keyboard_arrow_right</i>
      @endforeach
    @endif

    <span class="text-gray-600 font-bold">
      {{ $current_page }}
    </span>

  </div>
</card-basic>
  