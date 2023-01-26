<ul class="flex flex-col gap-3 px-2 py-4 font-medium text-navy lg:flex-row lg:items-center" x-data="{
    width: (window.innerWidth > 0) ? window.innerWidth : screen.width,
    isShow: false,
    showBank: false,
    isShowUpdate: false
}"
  x-on:click="showBank = !showBank">
  <div class="flex items-center gap-3">
    <li class="w-10 text-center" x-text="startAt + i + 1"></li>
    <li class="w-96" x-text="bank.name"></li>
  </div>
  <div class="flex flex-col gap-3 pl-11 lg:flex-row lg:items-center lg:pl-0" x-show="width > 768 ? true : showBank"
    x-transition.duration.200ms>
    <li class="flex flex-col lg:w-72">
      <span class="lg:hidden">Deleted At : </span>
      <span>
        <span x-text="(new Date(bank.deleted_at)).toDateString()"></span>
        <span x-text="(new Date(bank.deleted_at)).toLocaleTimeString()"></span>
      </span>
    </li>
    <li class="flex items-center gap-3 lg:w-24">
      <a x-on:click="restoreBank(bank.id)"
        class="cursor-pointer rounded-lg bg-navy/40 px-3 py-1 text-center text-white transition-all duration-300 hover:bg-[#EAA765]">Restore</a>
    </li>
  </div>
</ul>
