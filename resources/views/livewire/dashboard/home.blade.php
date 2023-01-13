<script>
  Alpine.data('homeDashboard', () => ({
    showMessage: 'Please wait...',
    showSidebar: false,
    token: localStorage.getItem('token'),
    resData: [],
    roleId: 0,
    checkLogin() {
      if (!this.token) {
        window.location.href = `{{ route('login') }}`
        // console.log('hello')
      }

      /** 
       * Get profile user
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
      })
    },
  }))
</script>
<main class="container relative flex justify-end font-poppins" x-data="homeDashboard" x-init="checkLogin()">

  @livewire('partials.nav-mobile')

  @livewire('partials.sidebar')

  <template x-if="roleId == 1">
    @livewire('user.home')
  </template>

  <template x-if="roleId == 2">
    @livewire('admin.home')
  </template>
</main>
