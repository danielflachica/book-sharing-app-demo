<div id="side-drawer" class="fixed h-full w-full hidden text-gray-800 z-20">
  <div class="h-full w-full flex">
    <div class="h-full flex-initial bg-white">
      <div class="w-80 border-dark">

        <div class="flex flex-col justify-center items-center p-4 bg-primary text-white h-32">
          <span class="text-lg font-bold">
            {{ config('app.name', 'LibDemo') }}
          </span>
        </div>

        @if(Route::has('user.profile.show'))
          <a class="block p-4 hover:bg-secondary-light hover:text-white"
            href="{{ route('user.profile.show') }}">
            <i class="material-icons mr-2">person</i>
            Profile
          </a>
        @endif

        @if(Route::has('admin.admins.index'))
          <a class="block p-4 hover:bg-secondary-light hover:text-white"
            href="{{ route('admin.admins.index') }}">
            <i class="material-icons mr-2">groups</i>
            Admins
          </a>
        @endif

        @if(Route::has('user.books.index'))
          <a class="block p-4 hover:bg-secondary-light hover:text-white"
            href="{{ route('user.books.index') }}">
            <i class="material-icons mr-2">menu_book</i>
            My Books
          </a>
        @endif

        @if(Route::has('admin.location'))
          <a class="block p-4 hover:bg-secondary-light hover:text-white"
            href="{{ route('admin.location') }}">
            <i class="material-icons mr-2">place</i>
            Location
          </a>
        @endif

        @if(Route::has('admin.tasks.index'))
          <a class="block p-4 hover:bg-secondary-light hover:text-white"
            href="{{ route('admin.tasks.index') }}">
            <i class="material-icons mr-2">task</i>
            Tasks
          </a>
        @endif

        @if(Route::has('admin.notes.index'))
          <a class="block p-4 hover:bg-secondary-light hover:text-white"
            href="{{ route('admin.notes.index') }}">
            <i class="material-icons mr-2">note</i>
            Notes
          </a>
        @endif

        @if(Route::has('home'))
          <a class="block p-4 hover:bg-secondary-light hover:text-white"
            href="{{ route('home') }}"
            target="_blank">
            <i class="material-icons mr-2">public</i>
            Visit Site
          </a>
        @endif

        @if(Route::has('logout'))
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a class="block p-4 hover:bg-secondary-light hover:text-white"
              href="{{ route('logout') }}"
              onclick="event.preventDefault(); this.closest('form').submit();">
              <i class="material-icons mr-2">exit_to_app</i>
              Logout
            </a>
          </form>
        @endif

      </div>
    </div>
    <div class="h-full flex-grow bg-black opacity-50" onclick="closeSideDrawer()"></div>
  </div>
</div>
