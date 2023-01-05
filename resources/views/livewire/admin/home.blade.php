<section class="mt-20 w-full py-10 lg:mt-0 lg:w-[80%]">
  <div class="mx-auto w-11/12 rounded-xl pb-6 lg:mx-0 lg:w-full lg:bg-gray-1 lg:p-6">
    <div
      class="mb-10 flex w-full flex-wrap items-center justify-center gap-8 gap-y-12 rounded-xl bg-navy py-12 px-1 text-lg text-gray-2 lg:gap-6 lg:px-5 lg:text-xl">
      <div
        class="group relative h-28 w-32 rounded-xl bg-white px-1 py-3 text-center font-bold transition-all duration-300 hover:rotate-6 lg:h-32 lg:w-40 lg:py-5">
        <div
          class="absolute right-1 -top-5 flex h-10 w-10 items-center justify-center rounded-lg bg-orange-2 group-hover:animate-bounce">
          <div class="w-6"><img class="w-full" src="{{ asset('images/icons/user-white.svg') }}" alt="">
          </div>
        </div>
        <p>Admins</p>
        <p class="text-3xl">70</p>
        <p>Person</p>
      </div>

      <div
        class="group relative h-28 w-32 rounded-xl bg-white px-1 py-3 text-center font-bold transition-all duration-300 hover:rotate-6 lg:h-32 lg:w-40 lg:py-5">
        <div
          class="absolute right-1 -top-5 flex h-10 w-10 items-center justify-center rounded-lg bg-orange-2 group-hover:animate-bounce">
          <div class="w-6"><img class="w-full" src="{{ asset('images/icons/user-white.svg') }}" alt="">
          </div>
        </div>
        <p>Users</p>
        <p class="text-3xl">75</p>
        <p>Person</p>
      </div>

      <div
        class="group relative h-28 w-32 rounded-xl bg-white px-1 py-3 text-center font-bold transition-all duration-300 hover:rotate-6 lg:h-32 lg:w-40 lg:py-5">
        <div
          class="absolute right-1 -top-5 flex h-10 w-10 items-center justify-center rounded-lg bg-orange-2 group-hover:animate-bounce">
          <div class="w-6"><img class="w-full" src="{{ asset('images/icons/submission-white.svg') }}" alt="">
          </div>
        </div>
        <p>Submission</p>
        <p class="text-3xl">125</p>
        <p>Person</p>
      </div>

      <div
        class="group relative h-28 w-32 rounded-xl bg-white px-1 py-3 text-center font-bold transition-all duration-300 hover:rotate-6 lg:h-32 lg:w-40 lg:py-5">
        <div
          class="absolute right-1 -top-5 flex h-10 w-10 items-center justify-center rounded-lg bg-orange-2 group-hover:animate-bounce">
          <div class="w-6"><img class="w-full" src="{{ asset('images/icons/approve-white.svg') }}" alt="">
          </div>
        </div>
        <p>Approved</p>
        <p class="text-3xl">70</p>
        <p>Person</p>
      </div>

      <div
        class="group relative h-28 w-32 rounded-xl bg-white px-1 py-3 text-center font-bold transition-all duration-300 hover:rotate-6 lg:h-32 lg:w-40 lg:py-5">
        <div
          class="absolute right-1 -top-5 flex h-10 w-10 items-center justify-center rounded-lg bg-orange-2 group-hover:animate-bounce">
          <div class="w-6"><img class="w-full" src="{{ asset('images/icons/not-approved-white.svg') }}"
              alt="">
          </div>
        </div>
        <p class="leading-none">Not Approved</p>
        <p class="text-3xl">70</p>
        <p>Person</p>
      </div>
    </div>

    <div class="bg-white">
      <ul class="flex gap-3 bg-orange-1 px-3 py-4 font-semibold text-navy">
        <li class="w-10 text-center">No</li>
        <li class="w-64">Nama</li>
        <div class="hidden gap-3 lg:flex">
          <li class="w-56">Tanggal Lahir</li>
          <li class="w-80">Alamat</li>
        </div>
      </ul>

      <ul class="flex flex-col gap-3 px-3 py-4 font-medium text-navy lg:flex-row lg:items-center"
        x-data="{
            showUser: false,
            width: (window.innerWidth > 0) ? window.innerWidth : screen.width
        }" x-on:click="showUser = !showUser">
        <div class="flex items-center gap-3">
          <li class="w-10 text-center font-semibold">1</li>
          <li class="flex w-64 items-center gap-5">
            <div class="h-14 w-14 rounded-lg bg-gray-3">
              <img src="" alt="">
            </div>
            <span>Apriando Pratama</span>
          </li>
        </div>
        <div class="flex flex-col gap-3 pl-11 lg:flex-row lg:items-center lg:pl-0"
          x-show="width > 640 ? true : showUser" x-transition.duration.700ms>
          <li class="lg:w-56"><span class="lg:hidden">Tanggal Lahir : </span>2000 April 03</li>
          <li class="lg:w-80"><span class="lg:hidden">Alamat : </span>Jl. May Ruslan Perum Villa Garden Galic No. 134
          </li>
        </div>
      </ul>

      <ul class="flex flex-col gap-3 px-3 py-4 font-medium text-navy lg:flex-row lg:items-center"
        x-data="{
            showUser: false,
            width: (window.innerWidth > 0) ? window.innerWidth : screen.width
        }" x-on:click="showUser = !showUser">
        <div class="flex items-center gap-3">
          <li class="w-10 text-center font-semibold">2</li>
          <li class="flex w-64 items-center gap-5">
            <div class="h-14 w-14 rounded-lg bg-gray-3">
              <img src="" alt="">
            </div>
            <span>Apriando Pratama</span>
          </li>
        </div>
        <div class="flex flex-col gap-3 pl-11 lg:flex-row lg:items-center lg:pl-0"
          x-show="width > 640 ? true : showUser" x-transition.duration.700ms>
          <li class="lg:w-56"><span class="lg:hidden">Tanggal Lahir : </span>2000 April 03</li>
          <li class="lg:w-80"><span class="lg:hidden">Alamat : </span>Jl. May Ruslan Perum Villa Garden Galic No. 134
          </li>
        </div>
      </ul>

      <ul class="flex flex-col gap-3 px-3 py-4 font-medium text-navy lg:flex-row lg:items-center"
        x-data="{
            showUser: false,
            width: (window.innerWidth > 0) ? window.innerWidth : screen.width
        }" x-on:click="showUser = !showUser">
        <div class="flex items-center gap-3">
          <li class="w-10 text-center font-semibold">3</li>
          <li class="flex w-64 items-center gap-5">
            <div class="h-14 w-14 rounded-lg bg-gray-3">
              <img src="" alt="">
            </div>
            <span>Apriando Pratama</span>
          </li>
        </div>
        <div class="flex flex-col gap-3 pl-11 lg:flex-row lg:items-center lg:pl-0"
          x-show="width > 640 ? true : showUser" x-transition.duration.700ms>
          <li class="lg:w-56"><span class="lg:hidden">Tanggal Lahir : </span>2000 April 03</li>
          <li class="lg:w-80"><span class="lg:hidden">Alamat : </span>Jl. May Ruslan Perum Villa Garden Galic No. 134
          </li>
        </div>
      </ul>

    </div>
  </div>
</section>
