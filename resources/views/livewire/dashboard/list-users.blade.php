<script>
  Alpine.data('listUserDashboard', () => ({
    showMessage: 'Please wait...',
    showSidebar: false,
    token: localStorage.getItem('token'),
    isLoading: true,
    resData: [],
    roleId: 0,
    // redirect to login page if user is not logged in
    checkLogin() {
      /**
       * Redirect to login page if there is no token in localstorage
       */
      if (!this.token) {
        window.location.href = `{{ route('login') }}`
        // console.log('hello')
      }

      const reqTime = Date.now()
      const path = '/api/user/me'
      const apiKey = generateKey(path, reqTime)

      /**
       * Get profile
       */
      fetch(`{{ env('API_URL') }}${path}`, {
        method: 'GET',
        headers: {
          'Content-type': 'application/json;charset=UTF-8',
          'Authorization': this.token,
          'Request-Time': reqTime,
          'D-App-Key': apiKey
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

        /**
         * Redirect to home if user role is not 2 (admin)
         */
        if (this.roleId != 2) {
          window.location.replace(`{{ route('home') }}`)
          // console.log(this.roleId)
        }

        this.isLoading = false
      })
    }
  }))

  Alpine.data('listUser', () => ({
    showMessage: 'Please wait...',
    users: [],
    pageNumber: 0,
    size: 5,
    total: '',
    listUsers: [],
    startAt: 0,
    pages: [],
    getUsers() {
      const reqTime = Date.now()
      const path = '/api/user'
      const apiKey = generateKey(path, reqTime)

      /**
       * Get list user
       */
      fetch(`{{ env('API_URL') }}${path}`, {
        method: 'GET',
        headers: {
          'Content-type': 'application/json;charset=UTF-8',
          'Authorization': localStorage.getItem('token'),
          'Request-Time': reqTime,
          'D-App-Key': apiKey
        }
      }).then(async res => {
        data = await res.json()
        this.users = data.data
        // console.log(this.users)

        const start = this.pageNumber * this.size
        const end = start + this.size
        this.total = this.users.length

        this.listUsers = this.users.slice(start, end)
        // console.log(this.listUsers)

        this.pages = Array.from({
          length: Math.ceil(this.total / this.size)
        }, (val, i) => i)
        // console.log(this.pages)

        this.showMessage = 'No data user found!'
      })
    },
    async viewPage(index) {
      // console.log(this.submissionData)
      this.listUsers = []
      this.pageNumber = index

      const start = this.pageNumber * this.size
      const end = start + this.size
      // console.log(start, end)

      this.startAt = start
      this.listUsers = await this.users.slice(start, end)
      // console.log(this.listUsers)

      if (this.listUsers.length == 0) {
        this.showMessage = 'No data Submissions found!'
      }
    }
  }))
</script>
<main class="container relative flex justify-end font-poppins" x-data="listUserDashboard" x-init="checkLogin()">
  <template x-if="isLoading">
    @livewire('components.loading')
  </template>

  @livewire('partials.nav-mobile')

  @livewire('partials.sidebar')

  <section class="mt-20 w-full py-10 lg:mt-0 lg:w-[80%]">
    <div class="mx-auto w-11/12 rounded-xl pb-6 lg:mx-0 lg:w-full lg:bg-gray-1 lg:p-6 lg:pt-12">
      <div class="relative mx-auto mb-12 flex w-max flex-col items-center justify-center gap-3">
        <h1 class="text-3xl font-bold text-orange-2">List <span class="text-navy">User</span></h1>
        <div
          class="relative h-2 w-52 rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
        </div>
      </div>

      <div class="relative rounded-xl bg-white" x-data="listUser" x-init="getUsers()">
        <ul class="flex gap-3 rounded-t-xl bg-orange-1 px-3 py-4 font-semibold text-navy">
          <li class="w-10 text-center">No</li>
          <li class="w-56 lg:w-80">Name</li>
          <li class="hidden w-80 lg:block">Email</li>
          <li class="hidden w-24 lg:block">Action</li>
        </ul>
        <!-- Loading -->
        <template x-if="users.length == 0">
          <div class="my-10 pb-10 text-center text-2xl font-bold text-navy">
            <h1 x-text="showMessage"></h1>
          </div>
        </template>
        <!-- call table list from template -->
        <template x-for="(user, i) of listUsers">
          @livewire('components.list-user-action')
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

    </div>
  </section>
</main>
