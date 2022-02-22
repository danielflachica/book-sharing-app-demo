<footer class="bg-secondary text-white">

  {{-- Bible Verse --}}
  <div class="flex flex-col justify-center text-center p-4 bg-secondary">
    <span class="italic">
      Whatever you do [whatever your task may be], work from the soul [that is, put in your very best effort], as [something done] for the Lord and not for men.
    </span>
    <span class="font-bold">
      Colossians 3:23
    </span>
  </div>

  {{-- Socials --}}
  <div class="bg-primary">
    <div class="max-w-6xl mx-auto p-4">
      <div class="flex flex-wrap justify-center md:justify-between text-white gap-4">

        <span class="w-full md:w-auto text-center">
          Get connected with us on our social networks!
        </span>

        <div class="flex items-center gap-4">

          {{-- Facebook --}}
          <a class="text-white flex items-center gap-2"
            data-toggle="tooltip"
            data-placement="top"
            title="Facebook"
            href="https://www.facebook.com/jfmprofessionalrealty"
            target="_blank"
            aria-label="Facebook">
            {{-- <img src="{{ asset('svg/facebook.svg') }}"
              loading="lazy"
              height="20px"
              width="20px"
              alt="Facebook"> --}}
              FB
          </a>

        </div>

      </div>
    </div>
  </div>

  <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-6 gap-16 md:gap-4 px-4 py-16">

    {{-- Logo Column --}}
    <div class="col-span-1 md:col-span-2 flex flex-col items-center md:items-start text-center md:text-left gap-4">
      <a href="{{ route('home') }}">
        <img src="data:image/jpeg;base64,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"
          loading="lazy"
          class="w-32"
          alt="{{ Config::get('app.name', 'AutoAid PH') }}">
      </a>
      <span>
        {{ Config::get('app.name', 'AutoAid PH') }}
      </span>
      <span class="text-md text-gray-400">
        With {{ config('app.name', 'JFM Professional Realty') }}, real estate has never been easier.
      </span>
    </div>

    {{-- Listings Column --}}
    <div class="flex flex-col items-center md:items-start text-center md:text-left gap-4">

      <span class="uppercase font-medium">
        Listings
      </span>

      <div class="border-primary border-t-4 w-16"></div>

      <a class="text-white flex items-center gap-2"
        href="#">
        All Properties
      </a>

      {{-- @foreach(App\OfferType::all() as $offerType)
        <a class="text-white flex items-center gap-2"
          href="#">
          {{ $offerType->type }}
        </a>
      @endforeach --}}

      {{-- @if(count(App\Listing::find(App\ListingFeature::all()->pluck('listing_id'))) > 0)
        <a class="text-white flex items-center gap-2"
          href="#">
          Featured Properties
        </a>
      @endif --}}

    </div>

    {{-- Help Column --}}
    <div class="flex flex-col items-center md:items-start text-center md:text-left gap-4">

      <span class="uppercase font-medium">
        Help
      </span>

      <div class="border-primary border-t-4 w-16"></div>

      <a class="text-white flex items-center gap-2"
        href="#">
        Privacy Policy
      </a>

      <a class="text-white flex items-center gap-2"
        href="https://forms.gle/AWgdGRQLZ4De16kr5"
        target="_blank">
        Site Suggestions
      </a>

    </div>

    {{-- Contact Column --}}
    <div class="col-span-1 md:col-span-2 flex flex-col items-center md:items-start text-center md:text-left gap-4">

      <span class="uppercase font-medium">
        Contact
      </span>

      <div class="border-primary border-t-4 w-16"></div>

      <a class="text-white flex items-center gap-2"
        href="#">
        <i class="material-icons md-18">location_on</i>
        Aguirre Avenue, BF Homes, Parañaque
      </a>

      <a class="text-white flex items-center gap-2"
        href="mailto:jfmprofessionalrealty@gmail.com?subject=Listing Inquiry"
        target="_blank">
        <i class="material-icons md-18">email</i>
        jfmprofessionalrealty@&#8203;gmail.com
      </a>

      <a class="text-white flex items-center gap-2"
        href="tel:(+63) 917 812 3095">
        <i class="material-icons md-18">phone</i>
        (+63) 917 812 3095
      </a>

      <a class="text-white flex items-center gap-2"
        href="#">
        <i class="material-icons md-18">email</i>
        Send us a message
      </a>

    </div>

  </div>

  {{-- IWS Footer --}}
  <div class="bg-gray-800">
    <div class="max-w-6xl mx-auto p-8 flex justify-between">

      <span>
        &copy; {{ now()->year }} Copyright {{ Config::get('app.name') }}
      </span>

      <span>
        Made with ❤️ by
        <a href="https://imagineware.ph/" target="_blank">
          ImagineWare
        </a>
      </span>

    </div>
  </div>

</footer>
