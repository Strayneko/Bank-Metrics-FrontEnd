<script>
  Alpine.data('listAdminDashboard', () => ({
    showSidebar: false,
    showMessage: 'Please wait...',
    token: localStorage.getItem('token'),
    isLoading: true,
    resData: [],
    roleId: 0,
    // redirect to login page if user is not logged in
    checkLogin() {
      if (!this.token) {
        window.location.href = `{{ route('login') }}`
        // console.log('hello')
      }

      const reqTime = Date.now() // get current timestamp
      const path = '/api/user/me'
      const apiKey = generateKey(path, reqTime) // generate api key

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

        this.roleId = this.resData.data.role_id
        // console.log(this.resData)

        // redirect to dashboard user if logged in user has role_id != 2
        if (this.roleId != 2) {
          window.location.replace(`{{ route('home') }}`)
        }

        this.isLoading = false
      }).catch(err => {
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: 'Internal Server Error! Please Try Again Later.',
        })
      })
    }
  }))

  Alpine.data('listAdmin', () => ({
    showMessage: 'Please wait...',
    isLoad: false,
    admins: [],
    pageNumber: 0,
    size: 5,
    total: '',
    listAdmins: [],
    startAt: 0,
    pages: [],
    search: '',
    // fetch admin list from admin api
    getAdmins() {
      this.isLoad = true
      // console.log(generateKey)

      const reqTime = Date.now()
      const path = '/api/admin'
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
        data = await res.json()

        if (data.status) {
          this.admins = data.data
        }
        // console.log(this.admins)

        // console.log(this.pageNumber)
        const start = this.pageNumber * this.size
        const end = start + this.size
        // console.log(start, end)

        this.total = this.admins.length
        // console.log(this.total)

        this.listAdmins = this.admins.slice(start, end)
        // console.log(this.listAdmins)

        this.pages = Array.from({
          length: Math.ceil(this.total / this.size)
        }, (val, i) => i)
        // console.log(this.pages)

        this.isLoad = false
        this.showMessage = 'No data Admin found!'
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
      this.listAdmins = []
      this.pageNumber = index

      const start = this.pageNumber * this.size
      const end = start + this.size
      // console.log(start, end)

      this.startAt = start
      this.total = this.admins.length
      // console.log(this.total)

      this.pages = Array.from({
        length: Math.ceil(this.total / this.size)
      }, (val, i) => i)

      this.listAdmins = await this.admins.slice(start, end)
      // console.log(this.listAdmins)

      if (this.search != '') {
        this.listAdmins = []
        const adminFilter = await this.admins.filter(admin => {
          return admin.name.toLowerCase().includes(this.search.toLowerCase())
        })

        this.total = adminFilter.length
        this.pages = Array.from({
          length: Math.ceil(this.total / this.size)
        }, (val, i) => i)

        this.listAdmins = adminFilter.slice(start, end)
      }

      if (this.listAdmins.length == 0) {
        this.showMessage = 'No data admin found!'
      }
    }
  }))

  Alpine.data('createAdmin', () => ({
    newAdmin: {
      name: "",
      email: "",
      password: ""
    },
    message: '',
    isSubmit: false,
    // create admin data
    create() {
      const data = new FormData(this.$refs.formAddAdmin)
      // console.log(this.$refs.formAddAdmin)
      const pyld = {}
      data.forEach((val, key) => pyld[key] = val)
      // data.append('name', this.newAdmin.name)
      // data.append('email', this.newAdmin.email)
      // data.append('password', this.newAdmin.password)

      this.isSubmit = true

      const reqTime = Date.now()
      const path = '/api/admin'
      const apiKey = generateKey(path, reqTime)

      fetch(`{{ env('API_URL') }}${path}`, {
        method: "POST",
        body: JSON.stringify(pyld),
        headers: {
          'Content-type': 'application/json;charset=UTF-8',
          'Authorization': localStorage.getItem('token'),
          'Request-Time': reqTime,
          'D-App-Key': apiKey
        }
      }).then(async (response) => {
        this.isSubmit = false

        let data = await response.json()
        let status = data.status
        this.message = data.message

        // console.log(this.message)

        let msg = ``
        for (m of this.message) {
          msg += `<p>${m}</p>`
        }
        if (status == false) {
          // alert for failed creating admin's data
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: msg
          })
          // window.location.replace('')
          return
        }
        // alert for success create admin's data
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: 'Add Admin Success!'
        }).then(res => {
          window.location.replace(`{{ env('APP_URL') }}/dashboard/listadmin`)
        })
      }).catch(err => {
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: 'Internal Server Error! Please Try Again Later.',
        })
      })
    },
    // redirect to login page if user is not logged in for modal
    checkLogged() {
      if (!this.token) {
        window.location.href(`{{ route('home') }}`)
      }
    }
  }))
</script>
<main class="container relative flex justify-end font-poppins" x-data="listAdminDashboard" x-init="checkLogin()">
  <template x-if="isLoading">
    @livewire('components.loading')
  </template>

  <!-- show navbar for mobile -->
  @livewire('partials.nav-mobile')
  <!-- show sidebar -->
  @livewire('partials.sidebar')

  <!-- list admin section -->
  <section class="mt-20 w-full py-10 lg:mt-0 lg:w-[80%]">
    <div class="relative mx-auto w-11/12 rounded-xl pb-6 lg:mx-0 lg:w-full lg:bg-gray-1 lg:p-6 lg:pt-12"
      x-data="{ isAddActive: false }">
      <div class="relative mx-auto mb-12 flex w-max flex-col items-center justify-center gap-3">
        <h1 class="text-3xl font-bold text-orange-2">List <span class="text-navy">Admin</span></h1>
        <div
          class="relative h-2 w-52 rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
        </div>
      </div>

      <div class="w-full" x-show="isAddActive" x-transition.duration.200ms x-data="createAdmin"
        x-init="checkLogged()">
        @livewire('components.modal.add-admin')
      </div>

      <div class="mb-6">
        <a x-on:click="isAddActive = !isAddActive"
          class="inline-block cursor-pointer rounded-md bg-white px-6 py-2 font-semibold text-navy shadow-md shadow-navy/30 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-navy/40">Create
          Admin</a>
      </div>

      <div x-data="listAdmin" x-init="getAdmins()">
        <div class="relative mb-4 flex w-full justify-end">
          <div class="relative w-full lg:w-72">
            <input type="text" name="search" id="search" x-model="search" x-on:keyup="viewPage(0)"
              placeholder="Search Admin..."
              class="relative w-full rounded-lg border-2 border-transparent bg-gray-1/40 py-2 pl-9 outline-none transition-all duration-200 hover:border-orange-1 focus:border-orange-1 active:border-orange-1 lg:bg-white">
            <div class="absolute inset-y-0 left-3 mt-[14px] w-4">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="fill-gray-2">
                <path
                  d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352c79.5 0 144-64.5 144-144s-64.5-144-144-144S64 128.5 64 208s64.5 144 144 144z" />
              </svg>
            </div>
          </div>
        </div>

        <div class="overflow-hidden rounded-xl bg-white">
          <ul class="flex gap-3 bg-orange-1 px-3 py-4 font-semibold text-navy">
            <li class="w-10 text-center">No</li>
            <li class="w-64 lg:w-80">Nama</li>
            <li class="hidden w-80 lg:block">Email</li>
          </ul>

          <template x-if="listAdmins.length == 0">
            <div class="my-10 text-center text-2xl font-bold text-navy">
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
          <!-- call table list template -->
          <template x-for="(admin, i) of listAdmins">
            @livewire('components.list-admin')
          </template>

          <template x-if="listAdmins.length > 0">
            {{-- Start pagination --}}
            @livewire('components.paginate')
            {{-- End Pagination --}}
          </template>

        </div>

      </div>

    </div>
  </section>
</main>
