<script>
    Alpine.data('logged', () => ({
      token: localStorage.getItem('token'),
      checkLogin() {
        if (!this.token) {
          window.location.href = `{{ route('login') }}`
          // console.log('hello')
        }
      },
      showSidebar: false
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
          })
      }
    }))
  </script>

<main class="container relative flex justify-end font-poppins" x-data="logged" x-init="checkLogin()">
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

      <div class="bg-white" x-data="listUser" x-init="getUsers()">
        <ul class="flex gap-3 bg-orange-1 px-3 py-4 font-semibold text-navy">
          <li class="w-10 text-center">No</li>
          <li class="w-80">Nama</li>
          <li class="w-80">Email</li>
        </ul>
        <template x-for="(user, i) of users">
        @livewire('components.list-user-action')
      </div>

    </div>
  </section>
</main>
