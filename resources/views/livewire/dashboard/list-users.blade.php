<script>
  Alpine.data('listUserDashboard', () => ({
    showSidebar: false,
    token: localStorage.getItem('token'),
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
</script>
<main class="container relative flex justify-end font-poppins" x-data="listUserDashboard" x-init="getProfile()">
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

      <div class="overflow-hidden rounded-xl bg-white">
        <ul class="flex gap-3 bg-orange-1 px-3 py-4 font-semibold text-navy">
          <li class="w-10 text-center">No</li>
          <li class="w-80">Nama</li>
          <li class="w-80">Email</li>
        </ul>

        @livewire('components.list-user-action')
      </div>

    </div>
  </section>
</main>
