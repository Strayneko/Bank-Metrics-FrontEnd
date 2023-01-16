<section class="mt-20 w-full py-10 text-navy lg:mt-0 lg:w-[80%]">

  <script>
    Alpine.data('submission', () => ({
      showMessage: 'Please wait...',
      submissionData: [],
      getSubmission() {
        fetch(`{{ env('API_URL') }}/api/loan/list`, {
          method: 'GET',
          headers: {
            'Authorization': localStorage.getItem('token')
          }
        }).then(async res => {
          this.submissionData = await res.json()
          this.showMessage = 'No data Submissions found!'
          console.log(this.submissionData)
        })
      }
    }))

    Alpine.data('rejected', () => ({
      resReject: [],
      getRejected(id) {
        fetch(`{{ env('API_URL') }}/api/loan/rejection_reason/${id}`, {
          method: 'GET',
          headers: {
            'Authorization': localStorage.getItem('token')
          }
        }).then(async res => {
          this.resReject = await res.json()
          // console.log(this.resReject)
        })
      },

      width: (window.innerWidth > 0) ? window.innerWidth : screen.width,
      showDetail: false,
      showApproved: false,
      showRejected: false
    }))
  </script>

  <div class="mx-auto w-11/12 rounded-xl pb-6 lg:mx-0 lg:w-full lg:bg-gray-1 lg:p-6">
    <h1 class="mx-auto mb-10 w-max text-3xl font-bold" x-text="'Welcome ' + resData.data.name"></h1>

    <template x-if="resData.data.profile">
      <div class="relative rounded-xl bg-white" x-data="submission" x-init="getSubmission()">
        <ul class="flex gap-3 rounded-t-xl bg-orange-1 px-3 py-4 font-semibold text-navy">
          <li class="w-10 text-center">No</li>
          <li class="w-64">Date</li>
          <div class="hidden gap-3 lg:flex">
            <li class="w-56">Loan Amount</li>
            <li class="w-40">Approved</li>
            <li class="w-40">Rejected</li>
          </div>
        </ul>

        <template x-if="submissionData.length == 0">
          <div class="my-10 pb-10 text-center text-2xl font-bold text-navy">
            <h1 x-text="showMessage"></h1>
          </div>
        </template>

        <template x-if="submissionData.status == false">
          <div class="my-10 pb-10 text-center text-2xl font-bold text-navy">
            <h1 x-text="showMessage"></h1>
          </div>
        </template>

        <template x-if="submissionData.data">
          <template x-for="(item, i) of submissionData.data.loans">
            @livewire('components.list-submission')
          </template>
        </template>

      </div>
    </template>

    <template x-if="!resData.data.profile">
      <div
        class="flex min-h-[100px] flex-col items-center justify-center gap-6 rounded-xl bg-gray-1/40 p-10 text-center lg:bg-white">
        <p class="text-xl font-semibold">Please fill in your personal data first!</p>
        <a href="{{ route('user.profile') }}"
          class="rounded-lg bg-orange-1 px-4 py-2 font-bold text-white transition-all duration-150 hover:-translate-y-1 hover:bg-orange-2/30 hover:shadow-sm hover:shadow-orange-1">Go
          to Profile!</a>
      </div>
    </template>
  </div>
</section>
