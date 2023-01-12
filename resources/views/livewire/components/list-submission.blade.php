<ul class="flex flex-col gap-3 px-3 py-4 font-medium text-navy lg:flex-row lg:items-center" x-data="{
    showUser: false,
    width: (window.innerWidth > 0) ? window.innerWidth : screen.width,
    showDetail: false
}"
  x-on:click="showUser = !showUser">
  <div class="flex items-center gap-3">
    <li class="w-10 text-center" x-text="i + 1"></li>
    <li class="flex w-64 flex-col">
      <span x-text="(new Date(item.created_at)).toDateString()"></span>
      <span x-text="(new Date(item.created_at)).toLocaleTimeString()"></span>
    </li>
    <li class="w-56" x-text="'$' + item.loan_amount"></li>
  </div>
  <div class="flex flex-col gap-3 pl-12 lg:flex-row lg:items-center lg:pl-0" x-show="width > 768 ? true : showUser"
    x-transition.duration.700ms>
    <li class="w-40">
      <a x-on:click="showDetail = true" class="cursor-pointer rounded-md bg-orange-1 px-3 py-1 text-white">Detail</a>
    </li>
    <li class="w-40">
      <a x-on:click="showDetail = true" class="cursor-pointer rounded-md bg-orange-1 px-3 py-1 text-white">Detail</a>
    </li>
  </div>

  <div class="absolute inset-x-0 top-0 w-full" x-show="showDetail" x-transition.duration.300ms>
    @livewire('components.modal.detail-submission')
  </div>
</ul>
