<script>
  Alpine.data('submissionAdminDashboard', () => ({
    showSidebar: false,
    token: localStorage.getItem('token'),
    resData: [],
    roleId: 0,
    checkLogin() {
      if (!this.token) {
        window.location.href = `{{ route('login') }}`
        // console.log('hello')
      }

      fetch(`{{ env('API_URL') }}/api/user/me`, {
        method: 'GET',
        headers: {
          'Content-type': 'application/json;charset=UTF-8',
          'Authorization': this.token
        }
      }).then(async res => {
        this.resData = await res.json()
        /**
         * Redirect to login if user not found
         */
        if (this.resData.status == false) {
          localStorage.removeItem('token')
          window.location.href = `{{ route('login') }}`
        }
        // console.log(this.resData)
        this.roleId = this.resData.data.role_id

        if (this.roleId != 2) {
          window.location.replace(`{{ route('home') }}`)
          // console.log(this.roleId)
        }
      })
    },
    showMessage: 'Please wait...',
    resSubmissionData: [],
    submissionStatus: '',
    getSubData() {
      fetch(`{{ env('API_URL') }}/api/loan/all`, {
        method: 'GET',
        headers: {
          'Content-type': 'application/json;charset=UTF-8',
          'Authorization': this.token
        }
      }).then(async res => {
        this.resSubmissionData = await res.json()
        this.showMessage = 'No data Submissions found!'
        // console.log(this.resSubmissionData)
        // console.log('aaaa')
      })
    },
  }))
</script>
<main class="container relative flex justify-end font-poppins" x-data="submissionAdminDashboard" x-init="checkLogin()">
  @livewire('partials.nav-mobile')

  @livewire('partials.sidebar')

  <section class="mt-20 w-full py-10 lg:mt-0 lg:w-[80%]">
    <div class="mx-auto w-11/12 rounded-xl pb-6 lg:mx-0 lg:w-full lg:bg-gray-1 lg:p-6" x-data="{ isSub: 1 }">
      <div class="relative mx-auto mb-14 mt-5 flex w-max flex-col items-center justify-center gap-3">
        <h1 class="text-3xl font-bold text-orange-2">Sub<span class="text-navy">mission</span></h1>
        <div
          class="relative h-2 w-48 rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
        </div>
      </div>

      <ul
        class="mx-auto mb-14 flex w-96 items-center justify-between gap-2 rounded-lg bg-white py-4 px-2 font-bold text-navy"
        x-init="getSubData()">
        <li>
          <a x-on:click="isSub = 1; submissionStatus = ''; getSubData()"
            :class="isSub == 1 ? 'bg-orange-1 text-white' : ''"
            class="cursor-pointer rounded-lg px-4 py-2 transition-all duration-300 hover:bg-orange-1 hover:text-white">Submission</a>
        </li>
        <li>
          <a x-on:click="isSub = 2; submissionStatus = 'approved'; getSubData()"
            :class="isSub == 2 ? 'bg-orange-1 text-white' : ''"
            class="cursor-pointer rounded-lg px-4 py-2 transition-all duration-300 hover:bg-orange-1 hover:text-white">Approved</a>
        </li>
        <li>
          <a x-on:click="isSub = 3; submissionStatus = 'rejected'; getSubData()"
            :class="isSub == 3 ? 'bg-orange-1 text-white' : ''"
            class="cursor-pointer rounded-lg px-4 py-2 transition-all duration-300 hover:bg-orange-1 hover:text-white">Rejected</a>
        </li>
      </ul>

      <div class="overflow-hidden rounded-xl bg-white">
        <ul class="flex gap-3 bg-orange-1 px-3 py-4 font-semibold text-navy">
          <li class="w-9 text-center">No</li>
          <li class="w-80">Name</li>
          <li class="w-72">Bank Name</li>
          <li class="w-32">Status</li>
          <li class="w-24">Action</li>
        </ul>

        <template x-if="resSubmissionData.data.length == 0">
          <div class="my-10 text-center text-2xl font-bold text-navy">
            <h1 x-text="showMessage"></h1>
          </div>
        </template>

        <template x-for="(loan, i) of resSubmissionData.data">
          @livewire('components.list-loan')
        </template>
      </div>
    </div>
  </section>
</main>
