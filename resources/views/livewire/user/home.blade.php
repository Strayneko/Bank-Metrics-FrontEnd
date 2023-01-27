<section class="mt-20 w-full py-10 text-navy lg:mt-0 lg:w-[80%]">

  <script>
    Alpine.data('submission', () => ({
      showMessage: 'Please wait...',
      submissionData: [],
      pageNumber: 0,
      size: 5,
      total: '',
      loansData: [],
      startAt: 0,
      pages: [],
      isLoad: false,
      getSubmission() {
        this.isLoad = true
        this.showMessage = 'Please wait...'

        /**
         * Generate api key from time request and endpoint api
         */
        const reqTime = Date.now()
        const path = '/api/loan/list'
        const apiKey = generateKey(path, reqTime)

        /**
         * Fetch to get submission data
         */
        fetch(`{{ env('API_URL') }}${path}`, {
          method: 'GET',
          headers: {
            'Authorization': localStorage.getItem('token'),
            'Request-Time': reqTime,
            'D-App-Key': apiKey
          }
        }).then(async res => {
          this.isLoad = false
          this.submissionData = await res.json()
          // console.log(this.submissionData)

          /**
           * Set number start and end for slice data
           */
          const start = this.pageNumber * this.size
          const end = start + this.size
          // console.log(start, end)

          /**
           * If response returns data, then slice the data
           * and insert into variable loansData. And
           * get number of length data and insert
           * it into varible total.
           */
          if (this.submissionData.data) {
            this.total = this.submissionData.data.loans.length
            // console.log(this.total)

            this.loansData = await this.submissionData.data.loans.slice(start, end)
            // console.log(this.loansData)

            /**
             * Generate number of pages from total data.
             */
            this.pages = Array.from({
              length: Math.ceil(this.total / this.size)
            }, (val, i) => i)
            // console.log(this.pages)
          }

          if (this.loansData.length == 0) {
            this.showMessage = 'No data Submissions found!'
          }

        }).catch(err => {
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Internal Server Error! Please Try Again Later.',
          })
        })
      },
      async viewPage(index) {
        /**
         * Reset loans data and set page number
         */
        this.loansData = []
        this.pageNumber = index

        /**
         * Set number start and end for slice data
         */
        const start = this.pageNumber * this.size
        const end = start + this.size
        // console.log(start, end)

        /**
         * Set number of start list on new page
         */
        this.startAt = start

        /**
         * Slice the data and insert into variable loansData.
         */
        this.loansData = await this.submissionData.data.loans.slice(start, end)
        // console.log(this.loansData)

        if (this.loansData.length == 0) {
          this.showMessage = 'No data Submissions found!'
        }
      }
    }))

    Alpine.data('rejected', () => ({
      resReject: [],
      showMessage: 'Please wait...',
      isLoad: false,
      getRejected(id) {
        this.isLoad = true

        /**
         * Generate api key from time request and endpoint api
         */
        const reqTime = Date.now()
        const path = `/api/loan/rejection_reason/${id}`
        const apiKey = generateKey(path, reqTime)

        fetch(`{{ env('API_URL') }}${path}`, {
          method: 'GET',
          headers: {
            'Content-type': 'application/json;charset=UTF-8',
            'Authorization': localStorage.getItem('token'),
            'Request-Time': reqTime,
            'D-App-Key': apiKey
          }
        }).then(async res => {
          this.isLoad = false
          this.resReject = await res.json()
          this.showMessage = 'No data Submissions found!'
          // console.log(this.resReject)
        }).catch(err => {
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Internal Server Error! Please Try Again Later.',
          })
        })
      },

      width: (window.innerWidth > 0) ? window.innerWidth : screen.width,
      showDetail: false,
      showApproved: false,
      showRejected: false
    }))
  </script>

  <div class="mx-auto w-11/12 rounded-xl pb-6 lg:mx-0 lg:w-full lg:bg-gray-1 lg:p-6">
    <div class="w-full">
      <h1 class="mx-auto mb-10 text-center text-3xl font-bold" x-text="'Welcome ' + resData.data.name"></h1>
    </div>

    <template x-if="resData.data.profile">
      <div class="relative rounded-xl bg-gray-1/30 lg:bg-white" x-data="submission" x-init="getSubmission()">
        <ul class="flex gap-3 rounded-t-xl bg-orange-1 px-3 py-4 font-semibold text-navy">
          <li class="w-10 text-center">No</li>
          <li class="w-64">Date</li>
          <div class="hidden gap-3 lg:flex">
            <li class="w-56">Loan Amount</li>
            <li class="w-40">Approved</li>
            <li class="w-40">Rejected</li>
          </div>
        </ul>

        <template x-if="loansData.length == 0">
          <div class="my-10 pb-10 text-center text-2xl font-bold text-navy">
            <template x-if="isLoad">
              <div class="mb-5">
                <div class="flex h-20 w-full items-center justify-center">
                  <div class="loading"></div>
                </div>
              </div>
            </template>
            <h1 class="mb-5" x-text="showMessage"></h1>

            <template x-if="submissionData.status == false">
              <div>
                <a href="{{ route('user.user-submission') }}"
                  class="rounded-lg bg-orange-1 px-4 py-2 font-bold text-white transition-all duration-150 hover:-translate-y-1 hover:bg-orange-2/30 hover:shadow-sm hover:shadow-orange-1">Go
                  to
                  Submission!
                </a>
              </div>
            </template>
          </div>
        </template>

        <template x-if="submissionData.data">
          <template x-for="(item, i) of loansData">
            @livewire('components.list-submission')
          </template>
        </template>

        <template x-if="loansData.length > 0">
          {{-- Start pagination --}}
          @livewire('components.paginate')
          {{-- End Pagination --}}
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
