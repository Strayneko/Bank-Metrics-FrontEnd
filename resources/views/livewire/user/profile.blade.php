<script>
  Alpine.data('userProfile', () => ({
    showSidebar: false,
    token: localStorage.getItem('token'),
    checkLogin() {
      if (!this.token) {
        window.location.href = `{{ route('login') }}`
        // console.log('hello')
      }
    },

    userData: [],
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
        this.roleId = this.resData.data.role_id
        this.userData = this.resData.data
        console.log(this.userData)

        if (this.roleId != 1) {
          window.location.replace(`{{ route('home') }}`)
        }
      })
    },

    updateProfile() {
      const body = new FormData(this.$refs.userForm)
      // console.log(this.$refs.userForm)

      fetch(`{{ env('API_URL') }}/api/user/me`, {
        method: 'POST',
        headers: {
          'Authorization': this.token
        },
        body: body
      }).then(async res => {
        const data = await res.json()
        // console.log(data.message)
      })
    }
  }))
</script>
<main class="container relative flex justify-end font-poppins" x-data="userProfile" x-init="checkLogin();
getProfile()">
  @livewire('partials.nav-mobile')

  @livewire('partials.sidebar')

  {{-- Start User Profile --}}
  <section class="mt-20 w-full py-10 lg:mt-0 lg:w-[80%]">
    <div class="relative mx-auto w-11/12 rounded-xl pb-6 lg:mx-0 lg:w-full lg:bg-gray-1 lg:p-6 lg:pt-12">
      <div class="w-full" x-data="{ isUpdate: false }">
        <div class="relative inset-x-0 mx-auto mb-10 w-[575px]">
          <div class="relative rounded-xl bg-white py-8">
            <div class="relative mx-auto mb-20 flex w-max flex-col items-center justify-center gap-3">
              <h1 class="text-3xl font-bold text-navy">User <span class="text-orange-2">Profile</span></h1>
              <div
                class="relative h-2 w-[190px] rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
              </div>
            </div>
            <div class="w-full" x-show="isUpdate" x-transition.duration.500ms>
              @livewire('components.modal.user-modal')
            </div>
            <div class="mb-3 flex flex-col items-center justify-center text-gray-2">
              <div class="mb-3 h-24 w-24 overflow-hidden rounded-full">
                <img class="w-full" src="{{ asset('assets/image1.jpeg') }}" alt="profile" />
              </div>
            </div>
            <div class="mx-10 rounded-xl bg-orange-1 font-medium text-navy">
              <ul class="p-10">
                <li class="flex gap-10">
                  <span class="w-48">Name</span>
                  <span class="w-full" x-text="userData.name"></span>
                </li>
                <li class="flex gap-10">
                  <span class="w-48">Email</span>
                  <span class="w-full" x-text="userData.email"></span>
                </li>

                <template x-if="!userData.profile">
                  <li class="mt-6 text-center">ajsfagsfjhsafj</li>
                </template>

                <template x-if="userData.profile">
                  <div>
                    <li class="flex gap-10">
                      <span class="w-48">Address</span>
                      <h1 class="w-full">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate, totam.
                      </h1>
                    </li>
                    <li class="flex gap-10">
                      <span class="w-48">Date of Birth</span>
                      <h1 class="w-full">2002-05-22</h1>
                    </li>
                    <li class="flex gap-10">
                      <span class="w-48">Gender</span>
                      <h1 class="w-full">Female</h1>
                    </li>
                    <li class="flex gap-10">
                      <span class="w-48">Nationality</span>
                      <h1 class="w-full">America</h1>
                    </li>
                    <li class="flex gap-10">
                      <span class="w-48">Marital Status</span>
                      <h1 class="w-full">Married Only</h1>
                    </li>
                    <li class="flex gap-10">
                      <span class="w-48">Employment</span>
                      <h1 class="w-full">Full-Time</h1>
                    </li>
                  </div>
                </template>

              </ul>
            </div>
            <div class="mx-10 mt-5 flex justify-between pb-12">
              <button x-on:click="isUpdate = !isUpdate" type="submit"
                class="relative z-10 w-full rounded-lg border-2 border-orange-1 bg-transparent px-20 py-3 font-bold text-navy outline-none transition-all duration-300 before:absolute before:left-0 before:top-0 before:-z-10 before:block before:h-full before:w-0 before:bg-orange-1 before:transition-all before:duration-300 hover:text-white hover:before:w-full lg:w-max">Update
                Profile</button>
              {{-- <a x-on:click="isAddActive = false"
                class="relative z-10 w-full rounded-lg border-2 border-orange-1 bg-transparent px-20 py-3 font-bold text-navy outline-none transition-all duration-300 before:absolute before:left-0 before:top-0 before:-z-10 before:block before:h-full before:w-0 before:bg-orange-1 before:transition-all before:duration-300 hover:text-white hover:before:w-full lg:w-max">Back</a> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  {{-- End User Profile  --}}
</main>
