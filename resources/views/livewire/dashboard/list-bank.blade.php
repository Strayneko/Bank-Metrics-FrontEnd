<script>
  Alpine.data('listBankDashboard', () => ({
    showSidebar: false,
    showMessage: 'Please wait...',
    isShow: false,
    token: localStorage.getItem('token'),
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

      /**
       * Get profile
       */
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

        /**
         * Redirect to home if user role is not 2 (admin)
         */
        if (this.roleId != 2) {
          window.location.replace(`{{ route('home') }}`)
        }
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
      // data.append('name', this.bank.name)
      // data.append('loaning_percentage', this.bank.loaning_percentage)
      // data.append('max_age', this.bank.max_age)
      // data.append('min_age', this.bank.min_age)
      // data.append('marital_status', this.bank.marital_status)
      // data.append('nationality', this.bank.nationality)
      // data.append('employment', this.bank.employment)

      this.isSubmit = true

      /**
       * Fetch api to update data bank
       */
      fetch(`{{ env('API_URL') }}/api/bank/edit/${id}`, {
          method: "POST",
          body: data,
          headers: {
            'Authorization': localStorage.getItem('token')
          }
        })
        .then(async (response) => {
          this.isSubmit = false

          let responsdata = await response.json()
          let status = responsdata.status
          this.message = responsdata.message

          if (status == false) {
            alert(this.message)
            window.location.replace('')
            return
          }
          window.location.replace(`{{ env('APP_URL') }}/dashboard/bank`)
        });
    },

    deleteBank(id){
       /**
       * Fetch api to delete data bank
       */
       fetch(`{{ env('API_URL') }}/api/bank/delete/${id}`, {
          method: "POST",
          headers: {
            'Authorization': localStorage.getItem('token')
          }
        })
        .then(async (response) => {

          let data = await response.json()
          let status = data.status
          this.message = data.message

          if (status == false) {
            alert(this.message)
            window.location.replace('')
            return
          }
          window.location.replace(`{{ env('APP_URL') }}/dashboard/bank`)
        });
    },
    

    // redirect to login page if user is not logged in for modal
    checkLogged() {
      if (!this.token) {
        window.location.href(`{{ route('home') }}`)
      }
    },
    // fetch api for get bank list from database
    getBanks() {
      /**
       * Get data banks
       */
      fetch(`{{ env('API_URL') }}/api/bank`, {
        method: 'GET',
        headers: {
          'Authorization': localStorage.getItem('token')
        }
      }).then(async res => {
        this.banks = await res.json()
        // console.log(this.banks)
      })
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

      /**
       * Fetch api to create new data bank
       */
      fetch(`{{ env('API_URL') }}/api/bank/create`, {
          method: "POST",
          body: data,
          headers: {
            'Authorization': localStorage.getItem('token')
          }
        })
        .then(async (response) => {
          this.isSubmit = false

          let data = await response.json()
          let status = data.status
          this.message = data.message

          if (status == false) {
            alert(this.message)
            window.location.replace('')
            return
          }
          window.location.replace(`{{ env('APP_URL') }}/dashboard/bank`)
        });
    },

    // redirect to login page if user is not logged in for modal
    checkLogged() {
      if (!this.token) {
        window.location.href(`{{ route('home') }}`)
      }
    }
  }))

  Alpine.data("detailBank", () => ({
    banks: [],
    // fetch api to get data bank with certain id
    getBank() {
      /**
       * Get detail bank
       */
      fetch(`{{ 'API_URL' }}/api/bank/show/{id}`, {
          method: "GET",
          headers: {
            "Authorization": localStorage.getItem("token")
          }
        })
        .then(async res => {
          data = await res.json()
          this.banks = data.data
        })
    }
  }))
</script>
<main class="container relative flex justify-end font-poppins" x-data="listBankDashboard" x-init="checkLogin()">
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
      <div x-show="isAddActive" x-transition.duration.500ms x-data="createBank" x-init="checkLogged()">
        @livewire('components.modal.add-bank')
      </div>

      <div class="mb-6">
        <a x-on:click="isAddActive = !isAddActive"
          class="inline-block cursor-pointer rounded-md bg-white px-6 py-2 font-semibold text-navy shadow-md shadow-navy/30 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-navy/40">Create
          Bank</a>
      </div>

      <div class="overflow-hidden rounded-xl bg-gray-1/30 lg:bg-white" x-data="listBank" x-init="getBanks()">
        <ul class="flex gap-3 bg-orange-1 px-3 py-4 font-semibold text-navy">
          <li class="w-10 text-center">No</li>
          <li class="w-96">Name Bank</li>
          <li class="hidden w-64 lg:block">Max Loan</li>
          <li class="hidden w-48 lg:block">Action</li>
        </ul>
        <!-- Loading -->
        <template x-if="banks.length == 0">
          <div class="my-10 pb-10 text-center text-2xl font-bold text-navy">
            <h1 x-text="showMessage"></h1>  
          </div>
        </template>

        <!-- call table list template -->
        <template x-for="(bank, i) of banks.data">
          @livewire('components.list-bank')
        </template>
      </div>
    </div>
  </section>
</main>
