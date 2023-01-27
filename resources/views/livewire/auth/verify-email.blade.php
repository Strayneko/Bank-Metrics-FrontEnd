<script>
  Alpine.data("VerifyEmail", () => ({
    isLoad: true,
    /**
     * Function to verify email
     */
    verify() {
      const url = window.location.pathname
      const confirmation_code = url.replace('/verifyEmail/', '')
      fetch(`{{ env('API_URL') }}/api/auth/verifications/${confirmation_code}`, {
        method: "GET",
      }).then(async (response) => {
        let data = await response.json()
        let status = data.status
        this.msg = data.message
        // console.log(data)
        if (status == false) {
          let msg = ``
          for (m of this.msg) {
            msg += m
          }
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: msg
          })
          // window.location.replace('')
          return
        }
        // success alert
        Swal.fire(
          'Success!',
          'Email Verified!!',
          'success'
        ).then(res => {
          window.location.replace(`{{ env('APP_URL') }}/login`)
        })
      }).catch(err => {
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: 'Internal Server Error! Please Try Again Later.',
        })
      })
    }
  }));
</script>
<div x-data="VerifyEmail" x-init="verify()">
  <template x-if="isLoad">
    <div class="fixed inset-0 z-[100] bg-white/10 backdrop-blur-sm">
      <div class="flex h-screen w-full items-center justify-center bg-gray-1/30">
        <div class="loading"></div>
      </div>
    </div>
  </template>
</div>
