{{-- untuk list user di home dashboard admin --}}
<ul class="flex flex-col gap-3 px-3 py-4 font-medium text-navy lg:flex-row lg:items-center" x-data="{
    showUser: false,
    width: (window.innerWidth > 0) ? window.innerWidth : screen.width
}"
  x-on:click="showUser = !showUser">
  <div class="flex items-center gap-3">
    <li class="w-10 text-center font-semibold" x-text="i + 1"></li>
    <li class="flex w-64 items-center gap-5">
      <div class="flex h-14 w-14 items-center justify-center overflow-hidden rounded-lg bg-gray-3">
        <img class="w-full" :src="user.user_profile ? user.user_profile.photo : `{{ asset('assets/profile.svg') }}`"
          :alt="user.name">
      </div>
      <span x-text="user.name"></span>
    </li>
  </div>
  <div class="flex flex-col gap-3 pl-11 lg:flex-row lg:items-center lg:pl-0" x-show="width > 768 ? true : showUser"
    x-transition.duration.500ms>
    <li class="lg:w-56"
      x-html="`<span class='lg:hidden'>Tanggal Lahir : </span>${ user.user_profile ? user.user_profile.dob : 'The user has not filled in the profile data' }`">
    </li>
    <li class="lg:w-80"
      x-html="`<span class='lg:hidden'>Alamat : </span>${user.user_profile ? user.user_profile.address : 'The user has not filled in the profile data'}`">
    </li>
  </div>
</ul>
