<section class="absolute inset-x-0 -top-32 mx-auto w-full pb-12">

  <script>
    Alpine.data('submission', () => ({
      submissionData: [],
      getSubmission(id) {
        fetch(`{{ env('API_URL') }}/api/loan/list/${id}`, {
          method: 'GET',
          headers: {
            'Authorization': localStorage.getItem('token')
          }
        }).then(async res => {
          this.submissionData = await res.json()
          console.log(this.submissionData)
        })
      }
    }))
  </script>

  <div class="relative z-20 mx-auto w-full rounded-xl bg-white p-10 shadow-md shadow-navy/60 lg:w-3/5">
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

    <ul class="mx-auto mb-6 flex flex-col rounded-lg bg-[#FFE1C5] p-6 text-lg font-semibold text-navy">
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

    <div class="relative mx-auto w-full rounded-xl bg-white" x-data="submission" x-init="getSubmission(user.id)">
      <ul class="flex gap-3 rounded-t-xl bg-orange-1 px-3 py-4 font-semibold text-navy">
        <li class="w-10 text-center">No</li>
        <li class="w-64">Date</li>
        <li class="w-56">Status</li>
      </ul>

      {{-- <template x-for="(accept, i) of item.accepted_bank"> --}}
      <ul class="flex flex-col gap-3 px-3 py-4 font-medium text-navy lg:flex-row lg:items-center">
        <li class="w-10 text-center">1</li>
        <li class="w-64">2023-01-01</li>
        <li class="w-56">Approved</li>
      </ul>
      {{-- </template> --}}
    </div>
  </div>

  <div class="fixed inset-0 z-10 bg-gray-1/40 backdrop-blur-sm" x-on:click="showDetail = false"></div>
</section>
