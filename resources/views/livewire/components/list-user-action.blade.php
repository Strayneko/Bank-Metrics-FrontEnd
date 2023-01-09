{{-- list data user di page list data user --}}
<ul class="flex flex-col gap-3 px-3 py-4 font-medium text-navy lg:flex-row lg:items-center">
  <li class="w-9 text-center" x-text="i + 1"></li>
  <li class="w-80" x-text="user.name"></li>
  <li class="w-80" x-text="user.email"></li>
  <li class="w-24"><a href="#" class="rounded-md bg-orange-1 px-3 py-1 text-white">Detail</a></li>
</ul>
