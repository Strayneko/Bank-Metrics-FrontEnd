<script>
  Alpine.data('homeDashboard', () => ({
    token: localStorage.getItem('token'),
    showSidebar: false,
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
        data = await res.json()
        this.resData = data.data
        this.roleId = this.resData.role_id
        console.log(this.roleId)
      })
    }
  }))
</script>
<main class="container relative flex justify-end font-poppins" x-data="homeDashboard" x-init="getProfile()">
  @livewire('partials.nav-mobile')

  @livewire('partials.sidebar')

  <template x-if="roleId == 1">
    @livewire('user.home')
  </template>

  <template x-if="roleId == 2">
    @livewire('admin.home')
  </template>
</main>
