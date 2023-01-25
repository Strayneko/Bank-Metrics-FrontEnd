<ul class="flex flex-col gap-3 px-3 py-4 font-medium text-navy lg:flex-row lg:items-center" x-data="submission"
  x-on:click="showUser = !showUser">
  <div class="flex items-center gap-3">
    <li class="w-9 text-center" x-text="startAt + i + 1"></li>
    <li class="w-56 lg:w-80" x-text="user.name"></li>
  </div>
  <div class="flex flex-col gap-3 pl-12 lg:flex-row lg:items-center lg:pl-0" x-show="width > 768 ? true : showUser"
    x-transition.duration.500ms>
    <li class="w-56 lg:w-80" x-html="`<span class='lg:hidden'>Email : </span>${user.email}`"></li>
    <li class="w-24">
      <a x-on:click="showDetail = true; getSubmission(user.id)"
        class="cursor-pointer rounded-md bg-orange-1 px-3 py-1 text-white transition-all duration-200 hover:bg-orange-2/50">Detail</a>
    </li>
  </div>

  <div class="absolute inset-x-0 top-0 w-full" x-show="showDetail" x-transition.duration.200ms>
    @livewire('components.modal.detail-user')
  </div>
</ul>
