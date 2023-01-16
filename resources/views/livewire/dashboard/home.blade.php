<script>
  Alpine.data('homeDashboard', () => ({
    showMessage: 'Please wait...',
    showSidebar: false,
    token: localStorage.getItem('token'),
    isLoading: true,
    resData: [],
    roleId: 0,
    checkLogin() {
      /**
       * Redirect to login page if there is no token in localstorage
       */
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
        this.isLoading = false
      })
    },
  }))
</script>
<main class="container relative flex justify-end font-poppins" x-data="homeDashboard" x-init="checkLogin()">
  <template x-if="isLoading">
    @livewire('components.loading')
  </template>

  @livewire('partials.nav-mobile')

  @livewire('partials.sidebar')
<!-- redirect to dashboard user if user's role_id = 1 -->
  <template x-if="roleId == 1">
    @livewire('user.home')
  </template>
  
<!-- redirect to dashboard admin if user's role_id = 2 -->

  <template x-if="roleId == 2">
    @livewire('admin.home')
  </template>
</main>
