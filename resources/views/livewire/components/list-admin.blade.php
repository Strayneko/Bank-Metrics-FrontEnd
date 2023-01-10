<ul class="flex flex-col gap-3 px-3 py-4 font-medium text-navy lg:flex-row lg:items-center" x-data="{
    showItem: false,
    width: (window.innerWidth > 0) ? window.innerWidth : screen.width
}"
  x-on:click="showItem = !showItem">
  <div class="flex items-center gap-3">
    <li class="w-10 text-center" x-text="i + 1"></li>
    <li class="w-64 lg:w-80" x-text="admin.name"></li>
  </div>
  <div class="pl-12 lg:pl-0" x-show="width > 768 ? true : showItem" x-transition.duration.700ms>
    <li class="w-80" x-text="admin.email"></li>
  </div>
</ul>
