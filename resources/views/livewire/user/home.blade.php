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
      getSubmission() {
        this.showMessage = 'Please wait...'

        const reqTime = Date.now()
        const path = '/api/loan/list'
        const apiKey = generateKey(path, reqTime)

        fetch(`{{ env('API_URL') }}${path}`, {
          method: 'GET',
          headers: {
            'Authorization': localStorage.getItem('token'),
            'Request-Time': reqTime,
            'D-App-Key': apiKey
          }
        }).then(async res => {
          this.submissionData = await res.json()
          // console.log(this.submissionData)

          // console.log(this.pageNumber)
          const start = this.pageNumber * this.size
          const end = start + this.size
          // console.log(start, end)

          this.total = this.submissionData.data.loans.length
          // console.log(this.total)

          this.loansData = this.submissionData.data.loans.slice(start, end)
          // console.log(this.loansData)

          this.pages = Array.from({
            length: Math.ceil(this.total / this.size)
          }, (val, i) => i)
          // console.log(this.pages)

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
        // console.log(this.submissionData)
        this.loansData = []
        this.pageNumber = index

        const start = this.pageNumber * this.size
        const end = start + this.size
        // console.log(start, end)

        this.startAt = start
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
      getRejected(id) {
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
    <h1 class="mx-auto mb-10 w-max text-3xl font-bold" x-text="'Welcome ' + resData.data.name"></h1>

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
            <h1 x-text="showMessage"></h1>
          </div>

        </template>

        <template x-if="submissionData.status == false">
          <div class="my-10 flex flex-col gap-5 pb-10 text-center text-2xl font-bold text-navy">
            <h1 x-text="showMessage"></h1>
            <div>
              <a href="{{ route('user.user-submission') }}"
                class="rounded-lg bg-orange-1 px-4 py-2 font-bold text-white transition-all duration-150 hover:-translate-y-1 hover:bg-orange-2/30 hover:shadow-sm hover:shadow-orange-1">Go
                to
                Submission!
              </a>
            </div>
          </div>

        </template>

        <template x-if="submissionData.data">
          <template x-for="(item, i) of loansData">
            @livewire('components.list-submission')
          </template>
        </template>

        {{-- Start pagination --}}
        <div class="flex justify-end py-8 px-10">
          <ul class="flex w-max items-center rounded-md font-semibold text-orange-1 outline outline-2 outline-orange-1">
            <li>
              <button class="group py-1 pl-3 disabled:cursor-not-allowed" type="button" x-on:click="viewPage(0)"
                :disabled="pageNumber == 0">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <path d="M11 4L3 11L11 19" stroke="#FF5927" stroke-width="3.77953" stroke-linejoin="round"
                    class="group-hover:animate-arrowColor1" />
                  <path d="M20 4L12 11L20 19" stroke="#FCC997" stroke-width="3.77953" stroke-linejoin="round"
                    class="group-hover:animate-arrowColor2" />
                </svg>
              </button>
            </li>

            <li>
              <button class="group py-1 pr-4 disabled:cursor-not-allowed" type="button"
                x-on:click="viewPage(pageNumber - 1)" :disabled="pageNumber == 0">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <path d="M20 4L12 11L20 19" stroke="#FCC997" stroke-width="3.77953" stroke-linejoin="round"
                    class="transition-all duration-200 group-hover:stroke-orange-2/60" />
                </svg>
              </button>
            </li>

            <li class="-mr-[.25px]">
              <button type="button" x-on:click="viewPage(0)"
                class="flex h-9 w-6 cursor-pointer items-center justify-center outline outline-1 outline-orange-1"
                :class="pageNumber == 0 ? 'bg-orange-1 text-white' : ''">1</button>
            </li>

            <template x-for="num in pages">
              <li class="-mr-[.25px]" :hidden="pageNumber != num || pageNumber == 0 || pageNumber == pages.length - 1">
                <button type="button" x-on:click="viewPage(num)"
                  class="flex h-9 w-6 cursor-pointer items-center justify-center outline outline-1 outline-orange-1"
                  x-text="num + 1" :class="pageNumber == num ? 'bg-orange-1 text-white' : ''"></button>
              </li>
            </template>

            <li class="-mr-[.25px]" :hidden="pages.length - 1 == 0">
              <button type="button" x-on:click="viewPage(pages.length - 1)"
                class="flex h-9 w-6 cursor-pointer items-center justify-center outline outline-1 outline-orange-1"
                x-text="pages.length" :class="pageNumber == pages.length - 1 ? 'bg-orange-1 text-white' : ''"></button>
            </li>

            <li>
              <button class="group py-1 pl-4 disabled:cursor-not-allowed" type="button"
                x-on:click="viewPage(pageNumber + 1)" :disabled="pageNumber == (pages.length - 1)">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.44653 4L10.4465 11L2.44653 19" stroke="#FCC997" stroke-width="3.77953"
                    stroke-linejoin="round" class="transition-all duration-200 group-hover:stroke-orange-2/60" />
                </svg>
              </button>
            </li>

            <li>
              <button class="group py-1 pr-3 disabled:cursor-not-allowed" type="button"
                x-on:click="viewPage(pages.length - 1)" :disabled="pageNumber == (pages.length - 1)">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <path d="M11.4465 4L19.4465 11L11.4465 19" stroke="#FF5927" stroke-width="3.77953"
                    stroke-linejoin="round" class="group-hover:animate-arrowColor1" />
                  <path d="M2.44653 4L10.4465 11L2.44653 19" stroke="#FCC997" stroke-width="3.77953"
                    stroke-linejoin="round" class="group-hover:animate-arrowColor2" />
                </svg>
              </button>
            </li>
          </ul>
        </div>
        {{-- End Pagination --}}

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
