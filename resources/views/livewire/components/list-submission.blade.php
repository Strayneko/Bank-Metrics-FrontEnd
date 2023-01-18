<ul class="flex flex-col gap-3 px-3 py-4 font-medium text-navy lg:flex-row lg:items-center" x-data="rejected"
  x-on:click="showDetail = !showDetail">
  <div class="flex items-center gap-3">
    <li class="w-10 text-center" x-text="startAt + i + 1"></li>
    <li class="flex w-64 flex-col">
      <span x-text="(new Date(item.created_at)).toDateString()"></span>
      <span x-text="(new Date(item.created_at)).toLocaleTimeString()"></span>
    </li>
    <li class="w-56" x-text="'$' + item.loan_amount.toLocaleString()"></li>
  </div>
  <div class="flex flex-col gap-3 pl-12 lg:flex-row lg:items-center lg:pl-0" x-show="width > 768 ? true : showDetail"
    x-transition.duration.200ms>
    <li class="lg:w-40">
      <span class="lg:hidden">Approved : </span>
      <button :hidden="item.accepted_bank.length == 0" x-on:click="showApproved = true"
        class="cursor-pointer rounded-md bg-green-400 px-3 py-1 text-white transition-all duration-150 hover:bg-green-600">Detail</button>
      <span :hidden="item.accepted_bank.length > 0"> - </span>
    </li>
    <li class="lg:w-40">
      <span class="lg:hidden">Rejected : </span>
      <button x-on:click="showRejected = true; getRejected(item.id)"
        class="cursor-pointer rounded-md bg-red-400 px-3 py-1 text-white transition-all duration-150 hover:bg-red-600">Detail</button>
    </li>
  </div>

  <div class="absolute inset-x-0 top-0 w-full" x-show="showApproved" x-transition.duration.200ms>
    @livewire('components.modal.list-approved')
  </div>

  <div class="absolute inset-x-0 top-0 w-full" x-show="showRejected" x-transition.duration.200ms>
    @livewire('components.modal.list-rejected')
  </div>
</ul>
