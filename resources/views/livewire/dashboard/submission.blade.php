<main class="container relative flex justify-end font-poppins" x-data="{ showSidebar: false }">
  @livewire('partials.nav-mobile')

  @livewire('partials.sidebar')

  <section class="mt-20 w-full py-10 lg:mt-0 lg:w-[80%]">
    <div class="mx-auto w-11/12 rounded-xl pb-6 lg:mx-0 lg:w-full lg:bg-gray-1 lg:p-6" x-data="{ isSub: 1 }">
      <div class="relative mx-auto mb-14 mt-5 flex w-max flex-col items-center justify-center gap-3">
        <h1 class="text-3xl font-bold text-orange-2">Sub<span class="text-navy">mission</span></h1>
        <div
          class="relative h-2 w-48 rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
        </div>
      </div>

      <ul
        class="mx-auto mb-14 flex w-96 items-center justify-between gap-2 rounded-lg bg-white py-4 px-2 font-bold text-navy">
        <li><a x-on:click="isSub = 1" :class="isSub == 1 ? 'bg-orange-1 text-white' : ''"
            class="cursor-pointer rounded-lg px-4 py-2 transition-all duration-300 hover:bg-orange-1 hover:text-white">Submission</a>
        </li>
        <li><a x-on:click="isSub = 2" :class="isSub == 2 ? 'bg-orange-1 text-white' : ''"
            class="cursor-pointer rounded-lg px-4 py-2 transition-all duration-300 hover:bg-orange-1 hover:text-white">Approved</a>
        </li>
        <li><a x-on:click="isSub = 3" :class="isSub == 3 ? 'bg-orange-1 text-white' : ''"
            class="cursor-pointer rounded-lg px-4 py-2 transition-all duration-300 hover:bg-orange-1 hover:text-white">Rejected</a>
        </li>
      </ul>

      <div class="bg-white">
        <ul class="flex gap-3 bg-orange-1 px-3 py-4 font-semibold text-navy">
          <li class="w-9 text-center">No</li>
          <li class="w-80">Name</li>
          <li class="w-72">Bank Name</li>
          <li class="w-32">Status</li>
          <li class="w-24">Action</li>
        </ul>

        @livewire('components.list-user-action')
      </div>
    </div>
  </section>
</main>