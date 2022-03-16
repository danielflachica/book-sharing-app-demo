<footer class="bg-secondary text-white">
  <div class="md:max-w-5xl xl:max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-16 px-4 py-16">
    {{-- Logo Column --}}
    <div class="col-span-1 md:col-span-4 lg:col-span-2 flex flex-col items-center md:items-start text-center md:text-left gap-4">
      <span class="text-2xl">
        {{ Config::get('app.name', 'AutoAid PH') }}
      </span>
      <span class="text-md text-gray-400 md:text-justify">
        Quis consectetur anim mollit sit amet in irure. Amet irure nulla ea exercitation ut aute incididunt non mollit eiusmod.
      </span>
    </div>

    {{-- 1st column --}}
    <div class="flex flex-col items-center md:items-start text-center md:text-left gap-4">

      <span class="uppercase font-medium">
        Amet dolor
      </span>

      <div class="flex flex-col gap-2">
        <a class="text-gray-400 hover:text-white text-sm capitalize"
          href="#">
          Aute Aliqua
        </a>

        <a class="text-gray-400 hover:text-white text-sm capitalize"
          href="#">
          consectetur
        </a>

        <a class="text-gray-400 hover:text-white text-sm capitalize"
          href="#">
          Laboris Voluptate
        </a>
      </div>

    </div>

    {{-- 2nd column --}}
    <div class="flex flex-col items-center md:items-start text-center md:text-left gap-4">

      <span class="uppercase font-medium">
        Ad ea nulla
      </span>

      <div class="flex flex-col gap-2">
        <a class="text-gray-400 hover:text-white text-sm capitalize"
          href="#">
          Consequat 
        </a>

        <a class="text-gray-400 hover:text-white text-sm capitalize"
          href="#">
          Laboris Voluptate
        </a>

        <a class="text-gray-400 hover:text-white text-sm capitalize"
          href="#">
          Aute Aliqua
        </a>

        <a class="text-gray-400 hover:text-white text-sm capitalize"
          href="#">
          consectetur
        </a>
      </div>

    </div>

    {{-- 3rd column --}}
    <div class="flex flex-col items-center md:items-start text-center md:text-left gap-4">

      <span class="uppercase font-medium">
        proident cillum
      </span>

      <div class="flex flex-col gap-2">
        <a class="text-gray-400 hover:text-white text-sm capitalize"
          href="#">
          Consequat 
        </a>

        <a class="text-gray-400 hover:text-white text-sm capitalize"
          href="#">
          Aute Aliqua
        </a>
      </div>

    </div>

    {{-- 4th column --}}
    <div class="flex flex-col items-center md:items-start text-center md:text-left gap-4">

      <span class="uppercase font-medium">
        Proident aute
      </span>

      <div class="flex flex-col gap-2">
        <a class="text-gray-400 hover:text-white text-sm capitalize"
          href="#">
          Consequat 
        </a>

        <a class="text-gray-400 hover:text-white text-sm capitalize"
          href="#">
          consectetur
        </a>

        <a class="text-gray-400 hover:text-white text-sm capitalize"
          href="#">
          Laboris Voluptate
        </a>
      </div>

    </div>
  </div>
  
  {{-- IWS Footer --}}
  <div class="bg-gray-800">
    <div class="md:max-w-5xl xl:max-w-7xl mx-auto p-4 flex justify-between">

      <span class="text-sm text-gray-400">
        &copy; {{ now()->year }} Copyright {{ Config::get('app.name') }}
      </span>

      <span class="text-sm md:text-right text-gray-400">
        Made with ❤️
      </span>

    </div>
  </div>
</footer>
