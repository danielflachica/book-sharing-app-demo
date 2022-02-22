<div class="alert {{ $bg_color }} {{ $text_color }} p-4 rounded-lg">
  <div class="flex space-x-4">
    {{-- Icon --}}
    <i class="material-icons">{{ $icon ?? '' }}</i>
    <div>
      {{-- Title --}}
      <span class="font-bold">
        {{ $title ?? '' }}
      </span>
      {{-- Description --}}
      <p class="{{ $content_color }} max-w-md">
        {{ $content ?? '' }}
      </p>
    </div>
    {{-- Close Button --}}
    <button onclick="closeAlert(this)" class="h-0">
      <i class="material-icons">close</i>
    </button>
  </div>
</div>
