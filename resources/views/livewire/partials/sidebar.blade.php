<aside
  class="fixed inset-y-0 z-30 flex h-screen flex-col items-center bg-white pt-10 pl-2 pr-0 transition-all duration-500 lg:left-0 lg:pl-8"
  :class="showSidebar ? 'left-0' : '-left-96'">
  <div class="relative mb-16">
    <h1
      class="relative z-10 w-full text-4xl font-bold text-orange-2 before:absolute before:-left-4 before:-top-1 before:-z-10 before:block before:h-[110%] before:w-[125%] before:-rotate-6 before:bg-gray-1">
      Met<span class="text-navy">rics</span></h1>
  </div>

  <div class="mb-3 flex flex-col items-center justify-center text-gray-2">
    <div class="mb-3 h-24 w-24 overflow-hidden rounded-full">
      <img class="w-full" src="{{ asset('assets/profile.svg') }}" alt="profile" />
    </div>
    <p class="text-xl font-bold">Firman Supirman</p>
    <p class="text-sm">Admin</p>
  </div>

  <div class="my-3 w-full overflow-auto pt-8 text-base font-semibold text-navy">
    <ul class="mb-14 flex flex-col gap-8 px-8">
      <li>
        <a href="{{ route('home') }}"
          class="{{ request()->routeIs('home') ? 'before:opacity-100 before:-rotate-6' : 'before:opacity-0 before:rotate-6' }} relative z-10 flex w-full items-center gap-4 before:absolute before:-top-[14px] before:-left-3 before:-z-10 before:block before:h-12 before:w-[120%] before:rounded-lg before:bg-gray-3 before:transition-all before:duration-200 hover:before:-rotate-6 hover:before:opacity-100">
          <div class="w-6"><img class="w-full" src="{{ asset('assets/icons/home.svg') }}" alt=""></div>
          <span>Dashboard</span>
        </a>
      </li>

      <template x-if="roleId == 1">
        <div class="flex flex-col gap-8">
          <li>
            <a href="#"
              class="{{ request()->routeIs('admin.list') ? 'before:opacity-100 before:-rotate-6' : 'before:opacity-0 before:rotate-6' }} relative z-10 flex w-full items-center gap-4 before:absolute before:-top-[14px] before:-left-3 before:-z-10 before:block before:h-12 before:w-full before:rounded-lg before:bg-gray-3 before:transition-all before:duration-200 hover:before:-rotate-6 hover:before:opacity-100">
              <div class="w-6"><img class="w-full" src="{{ asset('assets/icons/user.svg') }}" alt=""></div>
              <span>Profile</span>
            </a>
          </li>
          <li>
            <a href="#"
              class="{{ request()->routeIs('admin.list') ? 'before:opacity-100 before:-rotate-6' : 'before:opacity-0 before:rotate-6' }} relative z-10 flex w-full items-center gap-4 before:absolute before:-top-[14px] before:-left-3 before:-z-10 before:block before:h-12 before:w-[120%] before:rounded-lg before:bg-gray-3 before:transition-all before:duration-200 hover:before:-rotate-6 hover:before:opacity-100">
              <div class="w-6"><img class="w-full" src="{{ asset('assets/icons/submission.svg') }}" alt="">
              </div>
              <span>Submission</span>
            </a>
          </li>
        </div>
      </template>

      <template x-if="roleId == 2">
        <div class="flex flex-col gap-8">
          <li>
            <a href="{{ route('admin.list') }}"
              class="{{ request()->routeIs('admin.list') ? 'before:opacity-100 before:-rotate-6' : 'before:opacity-0 before:rotate-6' }} relative z-10 flex w-full items-center gap-4 before:absolute before:-top-[14px] before:-left-3 before:-z-10 before:block before:h-12 before:w-full before:rounded-lg before:bg-gray-3 before:transition-all before:duration-200 hover:before:-rotate-6 hover:before:opacity-100">
              <div class="w-6"><img class="w-full" src="{{ asset('assets/icons/admin.svg') }}" alt=""></div>
              <span>Admin</span>
            </a>
          </li>
          <li>
            <a href="{{ route('user.list') }}"
              class="{{ request()->routeIs('user.list') ? 'before:opacity-100 before:-rotate-6' : 'before:opacity-0 before:rotate-6' }} relative z-10 flex w-full items-center gap-4 before:absolute before:-top-[14px] before:-left-3 before:-z-10 before:block before:h-12 before:w-full before:rounded-lg before:bg-gray-3 before:transition-all before:duration-200 hover:before:-rotate-6 hover:before:opacity-100">
              <div class="w-6"><img class="w-full" src="{{ asset('assets/icons/user.svg') }}" alt=""></div>
              <span>User</span>
            </a>
          </li>
          <li>
            <a href="{{ route('submission.list') }}"
              class="{{ request()->routeIs('submission.list') ? 'before:opacity-100 before:-rotate-6' : 'before:opacity-0 before:rotate-6' }} relative z-10 flex w-full items-center gap-4 before:absolute before:-top-[14px] before:-left-3 before:-z-10 before:block before:h-12 before:w-[115%] before:rounded-lg before:bg-gray-3 before:transition-all before:duration-200 hover:before:-rotate-6 hover:before:opacity-100">
              <div class="w-6"><img class="w-full" src="{{ asset('assets/icons/submission.svg') }}" alt="">
              </div>
              <span>Submission</span>
            </a>
          </li>
        </div>
      </template>
    </ul>

    <div class="mb-10 px-8">
      <a x-on:click="logout()"
        class="relative z-10 flex w-full items-center gap-4 before:absolute before:-top-[14px] before:-left-3 before:-z-10 before:block before:h-12 before:w-full before:rotate-6 before:rounded-lg before:bg-gray-3 before:opacity-0 before:transition-all before:duration-200 hover:before:-rotate-6 hover:before:opacity-100">
        <div class="w-6"><img class="w-full" src="{{ asset('assets/icons/logout.svg') }}" alt=""></div>
        <span>Sign Out</span>
      </a>
    </div>
  </div>
</aside>
