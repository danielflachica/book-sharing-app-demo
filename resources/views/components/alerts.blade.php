@if(session('info') || session('success') || session('warning') || session('error'))
  <div class="fixed top-0 right-0 p-4 space-y-4 z-50">

    {{-- info alerts --}}
    @if(session('info'))
      @component('components.alert')
        @slot('bg_color', 'bg-blue-200')
        @slot('text_color', 'text-blue-600')
        @slot('content_color', 'text-blue-800')
        @slot('icon', 'info')
        @slot('title', 'Info')
        @slot('content', session('info'))
      @endcomponent
    @endif

    {{-- success alerts --}}
    @if(session('success'))
      @component('components.alert')
        @slot('bg_color', 'bg-green-200')
        @slot('text_color', 'text-green-600')
        @slot('content_color', 'text-green-800')
        @slot('icon', 'done')
        @slot('title', 'Success!')
        @slot('content', session('success'))
      @endcomponent
    @endif

    {{-- warning alerts --}}
    @if(session('warning'))
      @component('components.alert')
        @slot('bg_color', 'bg-orange-200')
        @slot('text_color', 'text-orange-600')
        @slot('content_color', 'text-orange-800')
        @slot('icon', 'warning')
        @slot('title', 'Warning')
        @slot('content', session('warning'))
      @endcomponent
    @endif

    {{-- error alerts --}}
    @if(session('error'))
      @component('components.alert')
        @slot('bg_color', 'bg-red-200')
        @slot('text_color', 'text-red-600')
        @slot('content_color', 'text-red-800')
        @slot('icon', 'error')
        @slot('title', 'Error')
        @slot('content', session('error'))
      @endcomponent
    @endif

  </div>
@endif
