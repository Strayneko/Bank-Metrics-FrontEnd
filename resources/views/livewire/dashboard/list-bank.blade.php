<script>
  Alpine.data('listBankDashboard', () => ({
    showMessage: 'Please wait...',
    showSidebar: false,
    isShow: false,
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

  Alpine.data('listBank', () => ({
    banks: [],
    updatedbank: {
      name: "",
      loaning_percentage: "",
      max_age: "",
      min_age: "",
      marital_status: 0,
      nationality: 0,
      employment: 0
    },
    isupdate: false,
    message: "",
    isSubmit: false,


    // consume api for update bank data to database
    updatedBank(id) {
      /**
       * Create form data
       */
      const data = new FormData(this.$refs.updateBankForm)

      this.isSubmit = true

      const reqTime = Date.now()
      const path = `/api/bank/edit/${id}`
      const apiKey = generateKey(path, reqTime)

      /**
       * Fetch api to update data bank
       */
      fetch(`{{ env('API_URL') }}${path}`, {
        method: "POST",
        body: data,
        headers: {
          'Authorization': localStorage.getItem('token'),
          'Request-Time': reqTime,
          'D-App-Key': apiKey
        }
      }).then(async (response) => {
        this.isSubmit = false

        let responsdata = await response.json()
        let status = responsdata.status
        this.message = responsdata.message

        let msg = ``
        for (m of this.message) {
          msg += `<p>${m}</p>`
        }

        /**
         * Show error message if response status is false
         */
        if (status == false) {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: msg
          })
          // window.location.replace('')
          return
        }

        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: 'Update Bank Success!'
        }).then(res => {
          window.location.replace(`{{ env('APP_URL') }}/dashboard/bank`)
        })
      }).catch(err => {
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: 'Internal Server Error! Please Try Again Later.',
        })
      })
    },

    deleteBank(id) {
      /**
       * Generate api key from time request and endpoint api
       */
      const reqTime = Date.now()
      const path = `/api/bank/delete/${id}`
      const apiKey = generateKey(path, reqTime)

      /**
       * Show modal confirm
       */
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          /**
           * Fetch api to delete data bank
           */
          fetch(`{{ env('API_URL') }}${path}`, {
              method: "POST",
              headers: {
                'Content-type': 'application/json;charset=UTF-8',
                'Authorization': localStorage.getItem('token'),
                'Request-Time': reqTime,
                'D-App-Key': apiKey
              }
            })
            .then(async (response) => {
              let data = await response.json()
              let status = data.status
              this.message = data.message

              let msg = ``
              for (m of this.message) {
                msg += `<p>${m}</p>`
              }

              /**
               * Show error message if response status is false
               */
              if (status == false) {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  html: msg
                })
                // window.location.replace('')
                return
              }

              Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Delete Bank Success!'
              }).then(res => {
                window.location.replace(`{{ env('APP_URL') }}/dashboard/bank`)
              })
            }).catch(err => {
              Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Internal Server Error! Please Try Again Later.',
              })
            })
        }
      })
    },



    isLoad: false,
    pageNumber: 0,
    size: 5,
    total: '',
    bankLists: [],
    startAt: 0,
    pages: [],
    search: '',
    checkLogged() {
      // redirect to login page if user is not logged in
      if (!this.token) {
        window.location.href(`{{ route('home') }}`)
      }
    },

    showMessages: 'Please wait...',
    // fetch api for get bank list from database
    getBanks() {
      this.isLoad = true
      const reqTime = Date.now()
      const path = '/api/bank'
      const apiKey = generateKey(path, reqTime)

      /**
       * Get data banks
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
        this.banks = await res.json()
        // console.log(this.banks)
        this.showMessages = 'No data Bank found!'
        // console.log(this.pageNumber)

        /**
         * Set number start and end for slice data
         */
        const start = this.pageNumber * this.size
        const end = start + this.size
        // console.log(start, end)

        this.total = this.banks.data.length
        // console.log(this.total)

        /**
         * Slice the data and insert into variable
         */
        this.bankLists = await this.banks.data.slice(start, end)
        // console.log(this.bankLists)

        /**
         * Generate number of pages from total data.
         */
        this.pages = Array.from({
          length: Math.ceil(this.total / this.size)
        }, (val, i) => i)
        // console.log(this.pages)
        this.isLoad = false
        this.showMessage = 'No data bank found!'

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
       * Reset list banks and set page number
       */
      this.bankLists = []
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
      this.total = await this.banks.data.length
      // console.log(this.total)

      /**
       * Generate number of pages from list users data.
       */
      this.pages = Array.from({
        length: Math.ceil(await this.total / this.size)
      }, (val, i) => i)

      /**
       * Slice the data and insert into variable 
       */
      this.bankLists = await this.banks.data.slice(start, end)
      // console.log(this.bankLists)

      /**
       * If there a search value, reset list banks
       * and then slice the data with filter
       */
      if (this.search != '') {
        this.bankLists = []
        const bankFilter = await this.banks.data.filter(bank => {
          return bank.name.toLowerCase().includes(this.search.toLowerCase())
        })

        this.total = bankFilter.length
        this.pages = Array.from({
          length: Math.ceil(await this.total / this.size)
        }, (val, i) => i)

        this.bankLists = bankFilter.slice(start, end)
      }
    }
  }))

  Alpine.data('createBank', () => ({
    newBank: {
      name: "",
      loaning_percentage: "",
      max_age: "",
      min_age: "",
      marital_status: 0,
      nationality: 0,
      employment: 0
    },
    message: "",
    isSubmit: false,
    // consume api for add new bank data to database
    createNewBank() {
      /**
       * Create form data
       */
      const data = new FormData()
      data.append('name', this.newBank.name)
      data.append('loaning_percentage', this.newBank.loaning_percentage)
      data.append('max_age', this.newBank.max_age)
      data.append('min_age', this.newBank.min_age)
      data.append('marital_status', this.newBank.marital_status)
      data.append('nationality', this.newBank.nationality)
      data.append('employment', this.newBank.employment)

      this.isSubmit = true

      const reqTime = Date.now()
      const path = '/api/bank/create'
      const apiKey = generateKey(path, reqTime)

      /**
       * Fetch api to create new data bank
       */
      fetch(`{{ env('API_URL') }}${path}`, {
        method: "POST",
        body: data,
        headers: {
          'Authorization': localStorage.getItem('token'),
          'Request-Time': reqTime,
          'D-App-Key': apiKey
        }
      }).then(async (response) => {
        this.isSubmit = false

        let data = await response.json()
        let status = data.status
        this.message = data.message

        let msg = ``
        for (m of this.message) {
          msg += `<p>${m}</p>`
        }

        /**
         * Show error message if response status is false
         */
        if (status == false) {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: msg
          })
          // window.location.replace('')
          return
        }

        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: 'Add Bank Success!'
        }).then(res => {
          window.location.replace(`{{ env('APP_URL') }}/dashboard/bank`)
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

  Alpine.data('listDeletedBank', () => ({
    banks: [],
    isLoad: false,
    showMessages: 'Please Wait...',
    pageNumber: 0,
    size: 5,
    total: '',
    bankLists: [],
    startAt: 0,
    pages: [],
    search: '',
    getDeletedBanks() {
      this.isLoad = true

      /**
       * Generate api key from time request and endpoint api
       */
      const reqTime = Date.now()
      const path = '/api/bank/trash'
      const apiKey = generateKey(path, reqTime)

      fetch(`{{ env('API_URL') }}${path}`, {
        method: 'GET',
        headers: {
          'Authorization': localStorage.getItem('token'),
          'Request-Time': reqTime,
          'D-App-Key': apiKey
        }
      }).then(async res => {
        this.showMessages = 'No data Bank found!'
        const response = await res.json()
        this.isLoad = false
        // console.log(response)
        if (!response.data) return

        this.banks = await response.data

        /**
         * Set number start and end for slice data
         */
        const start = this.pageNumber * this.size
        const end = start + this.size
        this.total = await this.banks.length

        /**
         * Slice the data and insert into variable 
         */
        this.bankLists = await this.banks.slice(start, end)

        /**
         * Generate number of pages from list users data.
         */
        this.pages = Array.from({
          length: Math.ceil(this.total / this.size)
        }, (val, i) => i)

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
       * Reset list banks and set page number
       */
      this.bankLists = []
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
      this.total = await this.banks.length
      // console.log(this.total)

      /**
       * Generate number of pages from list users data.
       */
      this.pages = Array.from({
        length: Math.ceil(await this.total / this.size)
      }, (val, i) => i)

      /**
       * Slice the data and insert into variable 
       */
      this.bankLists = await this.banks.slice(start, end)
      // console.log(this.bankLists)

      /**
       * If there a search value, reset list banks
       * and then slice the data with filter
       */
      if (this.search != '') {
        this.bankLists = []
        const bankFilter = await this.banks.filter(bank => {
          return bank.name.toLowerCase().includes(this.search.toLowerCase())
        })

        this.total = bankFilter.length
        this.pages = Array.from({
          length: Math.ceil(await this.total / this.size)
        }, (val, i) => i)

        this.bankLists = bankFilter.slice(start, end)
      }
    },
    restoreBank(id) {
      /**
       * Generate api key from time request and endpoint api
       */
      const reqTime = Date.now()
      const path = `/api/bank/restore/${id}`
      const apiKey = generateKey(path, reqTime)

      /**
       * Show modal confirmation
       */
      Swal.fire({
        title: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, restore!'
      }).then((result) => {
        /**
         * Fetch to delete restore bank if the result is true
         */
        if (result.isConfirmed) {
          fetch(`{{ env('API_URL') }}${path}`, {
            method: 'GET',
            headers: {
              'Authorization': localStorage.getItem('token'),
              'Request-Time': reqTime,
              'D-App-Key': apiKey
            }
          }).then(async res => {
            const response = await res.json()
            // console.log(response);
            Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: 'Restore Bank Success!',
            }).then(() => {
              window.location.replace(`{{ route('bank.list') }}`)
            })
          }).catch(err => {
            Swal.fire({
              icon: 'error',
              title: 'Error!',
              text: 'Internal Server Error! Please Try Again Later.',
            })
          })
        }
      })
    }
  }))
</script>
<main class="container relative flex justify-end font-poppins" x-data="listBankDashboard" x-init="checkLogin()">
  <template x-if="isLoading">
    @livewire('components.loading')
  </template>
  @livewire('partials.nav-mobile')

  @livewire('partials.sidebar')

  <!-- list bank section -->
  <section class="mt-20 w-full py-10 lg:mt-0 lg:w-[80%]">
    <div class="relative mx-auto w-11/12 rounded-xl pb-6 lg:mx-0 lg:w-full lg:bg-gray-1 lg:p-6 lg:pt-12"
      x-data="{ isAddActive: false, isUpdate: false }">
      <div class="relative mx-auto mb-12 flex w-max flex-col items-center justify-center gap-3">
        <h1 class="text-3xl font-bold text-orange-2">List <span class="text-navy">Bank</span></h1>
        <div
          class="relative h-2 w-40 rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
        </div>
      </div>
      <div x-show="isAddActive" x-transition.duration.200ms x-data="createBank" x-init="checkLogged()">
        @livewire('components.modal.add-bank')
      </div>

      <div x-data="listBank" x-init="getBanks()" class="mb-24">
        <div class="flex flex-col lg:flex-row lg:justify-between">
          <div class="mb-6">
            <a x-on:click="isAddActive = !isAddActive"
              class="inline-block cursor-pointer rounded-md bg-white px-6 py-2 font-semibold text-navy shadow-md shadow-navy/30 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-navy/40">Create
              Bank</a>
          </div>

          <div class="relative mb-4 flex w-full justify-end lg:w-max">
            <div class="relative w-full lg:w-72">
              <input type="text" name="search" id="search" x-model="search" x-on:keyup="viewPage(0)"
                placeholder="Search Bank..."
                class="relative w-full rounded-lg border-2 border-transparent bg-gray-1/40 py-2 pl-9 outline-none transition-all duration-200 hover:border-orange-1 focus:border-orange-1 active:border-orange-1 lg:bg-white">
              <div class="absolute inset-y-0 left-3 mt-[14px] w-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="fill-gray-2">
                  <path
                    d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352c79.5 0 144-64.5 144-144s-64.5-144-144-144S64 128.5 64 208s64.5 144 144 144z" />
                </svg>
              </div>
            </div>
          </div>
        </div>

        <div class="overflow-hidden rounded-xl bg-gray-1/30 lg:bg-white">
          <ul class="flex gap-3 bg-orange-1 px-3 py-4 font-semibold text-navy">
            <li class="w-10 text-center">No</li>
            <li class="w-96">Name Bank</li>
            <li class="hidden w-64 lg:block">Max Loan</li>
            <li class="hidden w-48 lg:block">Action</li>
          </ul>
          <!-- Loading -->
          <template x-if="bankLists.length == 0">
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
          <template x-for="(bank, i) of bankLists">
            @livewire('components.list-bank')
          </template>

          <template x-if="bankLists.length > 0">
            {{-- Start pagination --}}
            @livewire('components.paginate')
            {{-- End Pagination --}}
          </template>

        </div>

      </div>

      {{-- Deleted Bank --}}
      <div class="relative mx-auto mb-12 flex w-max flex-col items-center justify-center gap-3">
        <h1 class="text-3xl font-bold text-orange-2">Deleted <span class="text-navy">Bank</span></h1>
        <div
          class="relative h-2 w-40 rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
        </div>
      </div>

      <div x-data="listDeletedBank" x-init="getDeletedBanks()">
        <div class="relative mb-4 flex w-full justify-end">
          <div class="relative w-full lg:w-72">
            <input type="text" name="search" id="search" x-model="search" x-on:keyup="viewPage(0)"
              placeholder="Search Bank..."
              class="relative w-full rounded-lg border-2 border-transparent bg-gray-1/40 py-2 pl-9 outline-none transition-all duration-200 hover:border-orange-1 focus:border-orange-1 active:border-orange-1 lg:bg-white">
            <div class="absolute inset-y-0 left-3 mt-[14px] w-4">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="fill-gray-2">
                <path
                  d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352c79.5 0 144-64.5 144-144s-64.5-144-144-144S64 128.5 64 208s64.5 144 144 144z" />
              </svg>
            </div>
          </div>
        </div>

        <div class="overflow-hidden rounded-xl bg-gray-1/30 lg:bg-white">
          <ul class="flex gap-3 bg-orange-1 px-3 py-4 font-semibold text-navy">
            <li class="w-10 text-center">No</li>
            <li class="w-96">Name Bank</li>
            <li class="hidden w-72 lg:block">Deleted At</li>
            <li class="hidden w-24 lg:block">Action</li>
          </ul>
          <!-- Loading -->
          <template x-if="bankLists.length == 0">
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
          <template x-for="(bank, i) of bankLists">
            @livewire('components.list-deleted-bank')
          </template>

          <template x-if="bankLists.length > 0">
            {{-- Start pagination --}}
            @livewire('components.paginate')
            {{-- End Pagination --}}
          </template>
        </div>
      </div>
      {{-- End Deleted Bank --}}

    </div>
  </section>
</main>
