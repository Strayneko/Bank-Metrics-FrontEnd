<section class="absolute inset-x-0 -top-32 mx-auto w-full pb-12">
  <div class="relative z-20 mx-auto w-full rounded-xl bg-white py-10 px-6 shadow-md shadow-navy/60 lg:w-3/5 lg:p-10">
    <div class="relative mx-auto mb-6 flex w-max flex-col items-center justify-center gap-3">
      <h1 class="text-3xl font-bold text-orange-2">Detail <span class="text-navy">User</span></h1>
      <div
        class="relative h-2 w-52 rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
      </div>
    </div>

    <div
      class="mx-auto mb-5 flex h-24 w-24 items-center justify-center overflow-hidden rounded-full bg-gray-1 lg:h-36 lg:w-36">
      <img class="w-full" :src="user.user_profile ? user.user_profile.photo : `{{ asset('assets/profile.svg') }}`"
        :alt="user.name" />
    </div>

    <ul class="mx-auto mb-6 flex flex-col gap-3 rounded-lg bg-[#FFE1C5] p-6 text-lg font-semibold text-navy lg:gap-0">
      <li class="flex flex-col justify-between lg:flex-row">
        <span class="inline-block w-40 text-base font-normal lg:text-lg lg:font-semibold">Name</span>
        <span class="flex-1 break-all" x-text="user.name"></span>
      </li>
      <li class="flex flex-col justify-between lg:flex-row">
        <span class="inline-block w-40 text-base font-normal lg:text-lg lg:font-semibold">Email</span>
        <span class="flex-1 break-all" x-text="user.email"></span>
      </li>

      <template x-if="!user.user_profile">
        <li class="mt-6 w-full text-center"><span>No User Profile Found</span></li>
      </template>

      <template x-if="user.user_profile">
        <div class="flex flex-col gap-3 lg:gap-0">
          <li class="flex flex-col justify-between lg:flex-row">
            <span class="inline-block w-40 text-base font-normal lg:text-lg lg:font-semibold">Date Of Birth</span>
            <span class="flex-1" x-text="user.user_profile.dob"></span>
          </li>
          <li class="flex flex-col justify-between lg:flex-row">
            <span class="inline-block w-40 text-base font-normal lg:text-lg lg:font-semibold">Gender</span>
            <span class="flex-1" x-text="user.user_profile.gender ? 'Male' : 'Female'"></span>
          </li>
          <li class="flex flex-col justify-between lg:flex-row">
            <span class="inline-block w-40 text-base font-normal lg:text-lg lg:font-semibold">Address </span>
            <span class="flex-1 break-all" x-text="user.user_profile.address"></span>
          </li>
          <li class="flex flex-col justify-between lg:flex-row">
            <span class="inline-block w-40 text-base font-normal lg:text-lg lg:font-semibold">Status</span>
            <span class="flex-1" x-text="user.user_profile.status ? 'Married' : 'Single'"></span>
          </li>
          <li class="flex flex-col justify-between lg:flex-row">
            <span class="inline-block w-40 text-base font-normal lg:text-lg lg:font-semibold">Employement</span>
            <span class="flex-1" x-text="user.user_profile.employement ? 'Full-Time' : 'Half-Time'"></span>
          </li>
          <li class="flex flex-col justify-between lg:flex-row">
            <span class="inline-block w-40 text-base font-normal lg:text-lg lg:font-semibold">Nationality</span>
            <span class="flex-1" x-text="user.user_profile.country.country_name"></span>
          </li>
        </div>
      </template>
    </ul>

    <div class="w-full">
      <h1 class="py-3 text-center text-xl font-bold text-navy">User's Submissions</h1>
    </div>

    <div class="relative mx-auto w-full rounded-xl bg-gray-1/30">
      <ul class="flex gap-3 rounded-t-xl bg-orange-1 px-3 py-4 font-semibold text-navy">
        <li class="w-10 text-center">No</li>
        <li class="w-32 lg:w-64">Date</li>
        <li class="w-24 lg:w-56">Status</li>
      </ul>

      <template x-if="listSubmissions.length == 0">
        <div class="py-7 text-center text-xl font-bold text-navy">
          <h1 x-text="showMessage"></h1>
        </div>
      </template>

      <template x-if="submissionData.data">
        <template x-for="(loan, i) of listSubmissions">
          <ul class="flex items-center gap-3 px-3 py-4 font-medium text-navy">
            <li class="w-10 text-center" x-text="startAt + i + 1"></li>
            <li class="flex w-32 flex-col lg:w-64">
              <span x-text="(new Date(loan.created_at)).toDateString()"></span>
              <span x-text="(new Date(loan.created_at)).toLocaleTimeString()"></span>
            </li>
            <li class="w-24 lg:w-56">
              <span class="text-green-700" x-show="loan.status">Approved</span>
              <span class="text-red-700" x-show="!loan.status">Rejected</span>
            </li>
          </ul>
        </template>
      </template>

      <template x-if="submissionData.data">
        <template x-if="listSubmissions.length > 0">
          {{-- Start pagination --}}
          @livewire('components.paginate')
          {{-- End Pagination --}}
        </template>
      </template>

    </div>
  </div>

  <div class="fixed inset-0 z-10 bg-white/10 backdrop-blur-sm" x-on:click="showDetail = false"></div>
</section>
