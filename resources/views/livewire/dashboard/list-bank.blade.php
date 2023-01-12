<script>
  Alpine.data('listBankDashboard', () => ({
    showSidebar: false,
    isShow: false,
    token: localStorage.getItem('token'),
    checkLogin() {
      if (!this.token) {
        window.location.href = `{{ route('login') }}`
        // console.log('hello')
      }
    },

    resData: [],
    roleId: 0,
    getProfile() {
      fetch(`{{ env('API_URL') }}/api/user/me`, {
        method: 'GET',
        headers: {
          'Content-type': 'application/json;charset=UTF-8',
          'Authorization': this.token
        }
      }).then(async res => {
        this.resData = await res.json()
        // this.resData = data.data
        this.roleId = this.resData.data.role_id
        // console.log(this.resData)

        if (this.roleId != 2) {
          window.location.replace(`{{ route('home') }}`)
        }
      })
    },
  }))

  Alpine.data('listBank', () => ({
    banks: [],
    getBanks() {
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
    createNewBank() {
      const data = new FormData()
      data.append('name', this.newBank.name)
      data.append('loaning_percentage', this.newBank.loaning_percentage)
      data.append('max_age', this.newBank.max_age)
      data.append('min_age', this.newBank.min_age)
      data.append('marital_status', this.newBank.marital_status)
      data.append('nationality', this.newBank.nationality)
      data.append('employment', this.newBank.employment)

      fetch(`{{ env('API_URL') }}/api/bank/create`, {
          method: "POST",
          body: data,
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
    checkLogged() {
      if (!this.token) {
        window.location.href(`{{ route('home') }}`)
      }
    }
  }))

  Alpine.data("detailBank", () => ({
    banks: [],
    getBank() {
      fatch(`{{ 'API_URL' }}/api/bank/show/{id}`, {
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
<main class="container relative flex justify-end font-poppins" x-data="listBankDashboard" x-init="checkLogin();
getProfile()">
  @livewire('partials.nav-mobile')

  @livewire('partials.sidebar')

  <section class="mt-20 w-full py-10 lg:mt-0 lg:w-[80%]">
    <div class="relative mx-auto w-11/12 rounded-xl pb-6 lg:mx-0 lg:w-full lg:bg-gray-1 lg:p-6 lg:pt-12"
      x-data="{ isAddActive: false }">
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

        <template x-for="(bank, i) of banks.data">
          @livewire('components.list-bank')
        </template>
      </div>
    </div>
  </section>
</main>
