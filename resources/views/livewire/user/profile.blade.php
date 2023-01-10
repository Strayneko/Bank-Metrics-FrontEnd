<script>
  Alpine.data('listAdminDashboard', () => ({
    showSidebar: false,
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

        if (this.roleId != 1) {
          window.location.replace(`{{ route('home') }}`)
        }
      })
    },

    logout() {
      const confirmLogout = confirm('Yakin?')

      if (confirmLogout) {
        fetch(`{{ env('API_URL') }}/api/auth/logout`, {
          method: 'POST',
          headers: {
            'Authorization': this.token
          }
        }).then(async res => {
          const data = await res.json()

          if (data.status) {
            localStorage.removeItem('token')
            window.location.replace(`{{ route('login') }}`)
          }
        })
      }
    }
  }))

  Alpine.data('listAdmin', () => ({
    admins: [],
    getAdmins() {
      fetch(`{{ env('API_URL') }}/api/admin`, {
          method: 'GET',
          headers: {
            'Content-type': 'application/json;charset=UTF-8',
            'Authorization': localStorage.getItem('token')
          }
        })
        .then(async res => {
          data = await res.json()
          this.admins = data.data
        })
    }
  }))

  Alpine.data('createAdmin', () => ({
    newAdmin: {
      name: "",
      email: "",
      password: ""
    },
    message: '',
    create() {
      const data = new FormData()
      data.append('name', this.newAdmin.name)
      data.append('email', this.newAdmin.email)
      data.append('password', this.newAdmin.password)

      fetch(`{{ env('API_URL') }}/api/admin`, {
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
            console.log(this.message)
            alert(this.message)
            window.location.replace('')
            return
          }
          window.location.replace(`{{ env('APP_URL') }}/dashboard/listadmin`)
        });
    },
    checkLogged() {
      if (!this.token) {
        window.location.href(`{{ route('home') }}`)
      }
    }
  }))
</script>
<main class="container relative flex justify-end font-poppins" x-data="listAdminDashboard" x-init="checkLogin();
getProfile()">
  @livewire('partials.nav-mobile')

  @livewire('partials.sidebar')

  {{-- Start User Profile --}}
  <section class="relative mx-auto w-11/12 rounded-xl pb-6 lg:mx-0 lg:w-[80%] lg:bg-gray-1 lg:p-6 lg:pt-12">
    <div class="w-full" x-data="{ isUpdate: false }">
      <div class="relative inset-x-0 z-40 mx-auto mb-10 w-[575px]">
        <div class="relative rounded-xl bg-white py-8">
          <div class="relative mx-auto mb-20 flex w-max flex-col items-center justify-center gap-3">
            <h1 class="text-3xl font-bold text-navy">User <span class="text-orange-2">Profile</span></h1>
            <div
              class="relative h-2 w-[190px] rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
            </div>
          </div>
          <div class="w-full" x-show="isUpdate" x-transition.duration.500ms x-init="checkLogged()">
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
                <h1 class="w-full">Firman Sufirman</h1>
              </li>
              <li class="flex gap-10">
                <span class="w-48">Email</span>
                <h1 class="w-full">ciman@gmail.com</h1>
              </li>
              <li class="flex gap-10">
                <span class="w-48">Address</span>
                <h1 class="w-full">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate, totam.</h1>
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
            </ul>
          </div>
          <div class="mx-10 mt-5 flex justify-between pb-12">
            <button x-on:click="isUpdate = !isUpdate" type="submit"
              class="rounded-lg bg-[#f1f0f0] px-14 py-3 font-bold text-navy outline outline-orange-1 hover:bg-orange-1 hover:text-white">Update
              Profile</button>
            <a x-on:click="isAddActive = false"
              class="rounded-lg bg-[#f1f0f0] px-24 py-3 font-bold text-navy outline outline-orange-1 hover:bg-orange-1 hover:text-white">Back</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  {{-- End User Profile  --}}

</main>
