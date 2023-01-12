<ul class="flex flex-col gap-3 px-2 py-4 font-medium text-navy lg:flex-row lg:items-center" x-data="{
    width: (window.innerWidth > 0) ? window.innerWidth : screen.width,
    isShow: false,
    showBank: false
}"
  x-on:click="showBank = !showBank">
  <div class="flex items-center gap-3">
    <li class="w-10 text-center" x-text="i + 1"></li>
    <li class="w-96" x-text="bank.name"></li>
  </div>
  <div class="flex flex-col gap-3 pl-11 lg:flex-row lg:items-center lg:pl-0" x-show="width > 768 ? true : showBank"
    x-transition.duration.700ms>
    <li class="lg:w-64">
      <span class="lg:hidden">Max Loan : </span>
      <span x-text="bank.loaning_percentage + '%'"></span>
    </li>
    <li class="flex items-center gap-4 lg:w-48">
      <a x-on:click="isShow = !isShow"
        class="cursor-pointer rounded-lg bg-orange-1 px-3 py-1 text-center text-white transition-all duration-300 hover:bg-[#EAA765]">Detail</a>
      {{-- <a href=""
        class="rounded-lg bg-orange-2 px-3 py-1 text-center text-white transition-all duration-300 hover:bg-[#D73707]">Delete</a> --}}
    </li>
  </div>
  <div class="absolute inset-x-0 top-0 z-20 w-full" x-show="isShow" x-transition.duration.300ms>
    @livewire('components.modal.detail-bank')
  </div>
</ul>
