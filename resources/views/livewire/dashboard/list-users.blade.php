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
    isLoad: false,
    showMessage: 'Please wait...',
    users: [],
    pageNumber: 0,
    size: 5,
    total: '',
    listUsers: [],
    startAt: 0,
    pages: [],
    search: '',
    getUsers() {
      this.isLoad = true
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
        this.isLoad = false
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

      if (this.search != '') {
        this.listUsers = []
        this.listUsers = await this.users.filter(user => {
          // console.log('hello');
          return user.name.toLowerCase().includes(this.search.toLowerCase())
        })
      }

      if (this.listUsers.length == 0) {
        this.showMessage = 'No data users found!'
      }
    }
  }))

  Alpine.data('submission', () => ({
    showUser: false,
    width: (window.innerWidth > 0) ? window.innerWidth : screen.width,
    showDetail: false,

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

      <div x-data="listUser" x-init="getUsers()">
        <div class="relative mb-4 flex w-full justify-end pr-16">
          <div class="relative w-full lg:w-72">
            <input type="text" name="search" id="search" x-model="search" x-on:keyup="viewPage(0)"
              placeholder="Search User..."
              class="relative rounded-lg border-2 border-transparent bg-gray-1/40 py-2 pl-9 outline-none transition-all duration-200 hover:border-orange-1 focus:border-orange-1 active:border-orange-1 lg:bg-white">
            <div class="absolute inset-y-0 left-3 mt-[14px] w-4">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="fill-gray-2">
                <path
                  d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352c79.5 0 144-64.5 144-144s-64.5-144-144-144S64 128.5 64 208s64.5 144 144 144z" />
              </svg>
            </div>
          </div>
        </div>

        <div class="relative rounded-xl bg-white">
          <ul class="flex gap-3 rounded-t-xl bg-orange-1 px-3 py-4 font-semibold text-navy">
            <li class="w-10 text-center">No</li>
            <li class="w-56 lg:w-80">Name</li>
            <li class="hidden w-80 lg:block">Email</li>
            <li class="hidden w-24 lg:block">Action</li>
          </ul>
          <!-- Loading -->
          <template x-if="listUsers.length == 0">
            <div class="my-10 pb-10 text-center text-2xl font-bold text-navy">
              <template x-if="isLoad">
                <div class="mb-5">
                  <div class="flex h-20 w-full items-center justify-center">
                    <div class="loading"></div>
                  </div>
                </div>
              </template>
              <h1 x-text="showMessage"></h1>
            </div>
          </template>
          <!-- call table list from template -->
          <template x-for="(user, i) of listUsers">
            @livewire('components.list-user-action')
          </template>

          <template x-if="listUsers.length > 0">
            {{-- Start pagination --}}
            @livewire('components.paginate')
            {{-- End Pagination --}}
          </template>

        </div>
      </div>
    </div>
  </section>
</main>
