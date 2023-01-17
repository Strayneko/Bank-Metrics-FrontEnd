<script>
  Alpine.data('userProfile', () => ({
    showMessage: 'Please wait...',
    showSidebar: false,
    token: localStorage.getItem('token'),
    isLoading: true,
    userData: [],
    resData: [],
    roleId: 0,
    checkLogin() {
      if (!this.token) {
        window.location.href = `{{ route('login') }}`
        // console.log('hello')
      }

      const reqTime = Date.now()
      const path = '/api/user/me'
      const apikey = generateKey(path, reqTime)

      fetch(`{{ env('API_URL') }}${path}`, {
        method: 'GET',
        headers: {
          'Content-type': 'application/json;charset=UTF-8',
          'Authorization': this.token,
          'Request-Time': reqTime,
          'D-App-Key': apikey
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
        // console.log(this.userData)

        this.roleId = this.resData.data.role_id
        this.userData = this.resData.data

        if (this.roleId != 1) {
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
    },

    dataCountry: [],
    getCountry() {
      const reqTime = Date.now()
      const path = '/api/countries'
      const apikey = generateKey(path, reqTime)

      fetch(`{{ env('API_URL') }}${path}`, {
        method: 'GET',
        headers: {
          'Content-type': 'application/json;charset=UTF-8',
          'Authorization': this.token,
          'Request-Time': reqTime,
          'D-App-Key': apikey
        },
      }).then(async res => {
        const data = await res.json()
        // console.log(data)
        this.dataCountry = data.data
      })
    },

    isSubmit: false,
    updateProfile() {
      const body = new FormData(this.$refs.userForm)
      // console.log(this.$refs.userForm)

      this.isSubmit = true

      const reqTime = Date.now()
      const path = '/api/user/me'
      const apikey = generateKey(path, reqTime)

      fetch(`{{ env('API_URL') }}${path}`, {
        method: 'POST',
        headers: {
          'Content-type': 'application/json;charset=UTF-8',
          'Authorization': this.token,
          'Request-Time': reqTime,
          'D-App-Key': apikey
        },
        body: body
      }).then(async res => {
        this.isSubmit = false

        const data = await res.json()
        // console.log(data)

        let msg = ``
        for (m of data.message) {
          msg += `<p>${m}</p>`
        }
        if (data.status == false) {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: msg
          })
          return
        }
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: data.message
        }).then(res => {
          window.location.replace(`{{ env('APP_URL') }}/user/profile`)
        })
      }).catch(err => {
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: 'Internal Server Error! Please Try Again Later.',
        })
      })

    }
  }))
</script>
<main class="container relative flex justify-end font-poppins" x-data="userProfile" x-init="checkLogin()">
  <template x-if="isLoading">
    @livewire('components.loading')
  </template>

  @livewire('partials.nav-mobile')

  @livewire('partials.sidebar')

  {{-- Start User Profile --}}
  <section class="mt-20 w-full py-10 lg:mt-0 lg:w-[80%]">
    <div class="relative mx-auto w-11/12 rounded-xl pb-6 lg:mx-0 lg:w-full lg:bg-gray-1 lg:p-6 lg:pt-12">
      <div class="w-full" x-data="{ isUpdate: false }">
        <div class="relative inset-x-0 mx-auto mb-10 w-full lg:w-[575px]">
          <div class="relative rounded-xl bg-white py-8">
            <div class="relative mx-auto mb-8 flex w-max flex-col items-center justify-center gap-3">
              <h1 class="text-3xl font-bold text-navy">User <span class="text-orange-2">Profile</span></h1>
              <div
                class="relative h-2 w-[190px] rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
              </div>
            </div>
            <div class="w-full" x-show="isUpdate" x-transition.duration.200ms x-init="getCountry()">
              @livewire('components.modal.user-modal')
            </div>
            <div class="mb-3 flex flex-col items-center justify-center text-gray-2">
              <div
                class="mb-3 flex h-32 w-32 items-center justify-center overflow-hidden rounded-full bg-gray-1 lg:h-48 lg:w-48">
                <img class="w-full"
                  :src="userData.profile ? userData.profile.photo : `{{ asset('assets/profile.svg') }}`"
                  :alt="userData.name" />
              </div>
            </div>

            <div class="rounded-xl bg-orange-1 font-medium text-navy lg:mx-10">
              <ul class="flex flex-col justify-center gap-1 p-6 lg:p-10">

                <!-- loading -->
                <template x-if="userData.length == 0">
                  <div class="my-10 text-center text-2xl font-bold text-navy">
                    <h1 x-text="showMessage"></h1>
                  </div>
                </template>

                <li :class="userData.length == 0 ? 'hidden' : ' '" class="flex gap-10">
                  <span class="w-48">Name</span>
                  <span class="w-full" x-text="userData.name"></span>
                </li>
                <li :class="userData.length == 0 ? 'hidden' : ' '" class="flex gap-10">
                  <span class="w-48">Email</span>
                  <span class="w-full" x-text="userData.email"></span>
                </li>

                <template x-if="!userData.profile">
                  <li :class="userData.length == 0 ? 'hidden' : ' '" class="mt-6 text-center">Please Update Your
                    Profile!</li>
                </template>

                <template x-if="userData.profile">
                  <div class="flex flex-col gap-1">
                    <li class="flex gap-10">
                      <span class="w-48">Address</span>
                      <span class="w-full" x-text="userData.profile.address"></span>
                    </li>
                    <li class="flex gap-10">
                      <span class="w-48">Date of Birth</span>
                      <span class="w-full" x-text="userData.profile.dob"></span>
                    </li>
                    <li class="flex gap-10">
                      <span class="w-48">Gender</span>
                      <span class="w-full" x-text="userData.profile.gender == 1 ? 'Male' : 'Female'"></span>
                    </li>
                    <li class="flex gap-10">
                      <span class="w-48">Nationality</span>
                      <span class="w-full" x-text="userData.profile.country.country_name"></span>
                    </li>
                    <li class="flex gap-10">
                      <span class="w-48">Marital Status</span>
                      <span class="w-full" x-text="userData.profile.marital_status == 1 ? 'Married' : 'Single'"></span>
                    </li>
                    <li class="flex gap-10">
                      <span class="w-48">Employment</span>
                      <span class="w-full"
                        x-text="userData.profile.employement == 1 ? 'Full-Time' : 'Half-Time'"></span>
                    </li>
                  </div>
                </template>

              </ul>
            </div>
            <div class="mt-5 flex justify-between pb-4 lg:mx-10">
              <button x-on:click="isUpdate = !isUpdate" type="submit"
                class="relative z-10 w-full rounded-lg border-2 border-orange-1 bg-transparent px-20 py-3 font-bold text-navy outline-none transition-all duration-300 before:absolute before:left-0 before:top-0 before:-z-10 before:block before:h-full before:w-0 before:bg-orange-1 before:transition-all before:duration-300 hover:text-white hover:before:w-full lg:w-max">Update
                Profile</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  {{-- End User Profile  --}}
</main>
