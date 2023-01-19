<section class="absolute inset-x-0 -top-32 mx-auto w-full pb-12">

  <script>
    Alpine.data('submission', () => ({
      showMessage: 'Please wait...',
      submissionData: [],
      pageNumber: 0,
      size: 5,
      total: '',
      listSubmissions: [],
      startAt: 0,
      pages: [],
      getSubmission(id) {
        const reqTime = Date.now()
        const path = `/api/loan/list`
        const apiKey = generateKey(path, reqTime)

        /** 
         * Get loan list by user id
         */
        fetch(`{{ env('API_URL') }}${path}?user_id=${id}`, {
          method: 'GET',
          headers: {
            'Content-type': 'application/json;charset=UTF-8',
            'Authorization': localStorage.getItem('token'),
            'Request-Time': reqTime,
            'D-App-Key': apiKey
          }
        }).then(async res => {
          this.submissionData = await res.json()
          // console.log(this.submissionData)

          if (this.submissionData.data) {
            const start = this.pageNumber * this.size
            const end = start + this.size
            this.total = this.submissionData.data.loans.length

            this.listSubmissions = this.submissionData.data.loans.slice(start, end)
            // console.log(this.listSubmissions)

            this.pages = Array.from({
              length: Math.ceil(this.total / this.size)
            }, (val, i) => i)
            // console.log(this.pages)
          }


          this.showMessage = 'No data submission found!'
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
        this.listSubmissions = []
        this.pageNumber = index

        const start = this.pageNumber * this.size
        const end = start + this.size
        // console.log(start, end)

        this.startAt = start
        this.listSubmissions = await this.submissionData.data.loans.slice(start, end)
        // console.log(this.listSubmissions)

        if (this.listSubmissions.length == 0) {
          this.showMessage = 'No data Submissions found!'
        }
      }
    }))
  </script>

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
        <span class="flex-1" x-text="user.name"></span>
      </li>
      <li class="flex flex-col justify-between lg:flex-row">
        <span class="inline-block w-40 text-base font-normal lg:text-lg lg:font-semibold">Email</span>
        <span class="flex-1" x-text="user.email"></span>
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
            <span class="flex-1" x-text="user.user_profile.address"></span>
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

    <div class="relative mx-auto w-full rounded-xl bg-gray-1/30" x-data="submission" x-init="getSubmission(user.id)">
      <ul class="flex gap-3 rounded-t-xl bg-orange-1 px-3 py-4 font-semibold text-navy">
        <li class="w-10 text-center">No</li>
        <li class="w-32 lg:w-64">Date</li>
        <li class="w-24 lg:w-56">Status</li>
      </ul>

      <template x-if="listSubmissions.length == 0">
        <div class="my-10 text-center text-2xl font-bold text-navy">
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
      </template>

    </div>
  </div>

  <div class="fixed inset-0 z-10 bg-white/10 backdrop-blur-sm" x-on:click="showDetail = false"></div>
</section>
