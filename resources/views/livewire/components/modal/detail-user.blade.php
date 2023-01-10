<section class="absolute inset-x-0 -top-32 mx-auto w-full pb-12">
  <div class="relative z-20 mx-auto w-3/5 rounded-xl bg-white p-10 shadow-md shadow-navy/60">
    <div class="relative mx-auto mb-6 flex w-max flex-col items-center justify-center gap-3">
      <h1 class="text-3xl font-bold text-orange-2">Detail <span class="text-navy">User</span></h1>
      <div
        class="relative h-2 w-52 rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
      </div>
    </div>

    <div class="mx-auto mb-5 h-24 w-24 overflow-hidden rounded-full bg-gray-1">
      <img class="w-full" :src="user.user_profile ? user.user_profile.photo : `{{ asset('assets/profile.svg') }}`"
        :alt="user.name" />
    </div>

    <ul class="mx-auto flex flex-col rounded-lg bg-[#FFE1C5] p-6 text-lg font-semibold text-navy">
      <li class="flex justify-between">
        <span class="inline-block w-40">Name</span>
        <span class="flex-1" x-text="user.name"></span>
      </li>
      <li class="flex justify-between">
        <span class="inline-block w-40">Email</span>
        <span class="flex-1" x-text="user.email"></span>
      </li>

      <template x-if="!user.user_profile">
        <li class="mt-6 w-full text-center"><span>No User Profile Found</span></li>
      </template>

      <template x-if="user.user_profile">
        <div>
          <li>
            <span class="inline-block w-40">Date Of Birth</span>
            <span x-text="user.user_profile.dob"></span>
          </li>
          <li>
            <span class="inline-block w-40">Gender</span>
            <span x-text="user.user_profile.gender ? 'Male' : 'Female'"></span>
          </li>
          <li class="flex justify-between">
            <span class="inline-block w-40">Address </span>
            <span class="flex-1" x-text="user.user_profile.address"></span>
          </li>
          <li>
            <span class="inline-block w-40">Status</span>
            <span x-text="user.user_profile.status ? 'Married' : 'Single'"></span>
          </li>
          <li>
            <span class="inline-block w-40">Employement</span>
            <span x-text="user.user_profile.employement ? 'Full-Time' : 'Half-Time'"></span>
          </li>
          <li>
            <span class="inline-block w-40">Nationality</span>
            <span x-text="user.user_profile.country.country_name"></span>
          </li>
        </div>
      </template>
    </ul>
  </div>

  <div class="fixed inset-0 z-10 bg-gray-1/40 backdrop-blur-sm" x-on:click="showDetail = false"></div>
</section>
