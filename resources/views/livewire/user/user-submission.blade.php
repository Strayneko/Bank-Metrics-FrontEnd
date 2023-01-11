<script>
  Alpine.data('userSubmissionDashboard', () => ({
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
      })
    },

    createSubmission() {
      const body = new FormData(this.$refs.subForm)
      // console.log(this.$refs.subForm)

      fetch(`{{ env('API_URL') }}/api/loan/get_loan`, {
        method: 'POST',
        headers: {
          'Authorization': this.token
        },
        body
      }).then(async res => {
        const data = await res.json()
        console.log(data)

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
          window.location.replace(`{{ env('APP_URL') }}`)
          // console.log(res)
        })
      })
    }
  }))
</script>
<main class="container relative flex h-screen items-center justify-end bg-gray-1 font-poppins lg:h-max lg:bg-transparent"
  x-data="userSubmissionDashboard" x-init="checkLogin();
  getProfile()">
  @livewire('partials.nav-mobile')

  @livewire('partials.sidebar')

  {{-- Start User Profile --}}
  <section class="mt-20 w-full py-10 lg:mt-0 lg:w-[80%]">
    <div class="mx-auto flex w-11/12 justify-center rounded-xl pb-6 lg:mx-0 lg:w-full lg:bg-gray-1 lg:py-32">
      <div class="w-full lg:w-[575px]">
        <div class="relative rounded-xl bg-white pt-8">
          <div class="relative mx-auto mb-12 flex w-max flex-col items-center justify-center gap-3">
            <h1 class="mb-2 text-3xl font-bold text-navy"><span class="text-orange-2">Form</span> Submission</h1>
            <div
              class="relative h-2 w-[285px] rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
            </div>
          </div>
          <form class="flex cursor-pointer flex-col px-10" x-ref="subForm" x-on:submit.prevent="createSubmission()">
            <label for="loan_amount" class="relative mb-3 w-full pb-3">
              <p class="font-bold text-navy">Submission</p>
              <input type="number" name="loan_amount" id="loan_amount" class="peer mt-2 w-full outline-none"
                placeholder="Insert your loaning amount">
              <div
                class="absolute inset-x-0 bottom-0 mx-auto block h-0.5 w-0 rounded-lg bg-navy transition-all duration-300 peer-hover:w-full">
              </div>
            </label>
            <div class="mt-5 flex justify-between pb-12">
              <button type="submit"
                class="relative z-10 w-full rounded-lg border-2 border-orange-1 bg-transparent px-20 py-3 font-bold text-navy outline-none transition-all duration-300 before:absolute before:left-0 before:top-0 before:-z-10 before:block before:h-full before:w-0 before:bg-orange-1 before:transition-all before:duration-300 hover:text-white hover:before:w-full lg:w-max">Send</button>
              {{-- <a x-on:click="isUpdate = false" class="text-navy font-bold bg-[#f1f0f0] outline outline-orange-1 hover:bg-orange-1 hover:text-white px-24 py-3 rounded-lg">Back</a> --}}
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  {{-- End User Profile  --}}
</main>
