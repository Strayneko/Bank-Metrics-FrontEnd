<script>
  Alpine.data('listUserDashboard', () => ({
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
        if (this.roleId != 2) {
          // window.location.replace(`{{ route('home') }}`)
          console.log(this.roleId)
        }
      })

    },
  }))

  Alpine.data('listUser', () => ({
    users: [],
    getUsers() {
      fetch(`{{ env('API_URL') }}/api/user`, {
          method: 'GET',
          headers: {
            'Content-type': 'application/json;charset=UTF-8',
            'Authorization': localStorage.getItem('token')
          }
        })
        .then(async res => {
          data = await res.json()
          this.users = data.data
          // console.log(this.users)
        })
    }
  }))
</script>
<main class="container relative flex justify-end font-poppins" x-data="listUserDashboard" x-init="checkLogin();
getProfile()">
  @livewire('partials.nav-mobile')

  @livewire('partials.sidebar')

  <section class="mt-20 w-full py-10 lg:mt-0 lg:w-[80%]">
    <div class="mx-auto w-11/12 rounded-xl pb-6 lg:mx-0 lg:w-full lg:bg-gray-1 lg:p-6">
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
        <template x-for="(user, i) of users">
          @livewire('components.list-user-action')
        </template>
      </div>

    </div>
  </section>
</main>
