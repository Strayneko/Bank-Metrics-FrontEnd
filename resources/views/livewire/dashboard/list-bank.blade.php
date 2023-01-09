<script>
    Alpine.data('listAdminDashboard', () => ({
        showSidebar: false
        , token: localStorage.getItem('token')
        , checkLogin() {
            if (!this.token) {
                window.location.href = `{{ route('login') }}`
                // console.log('hello')
            }
        },

        resData: []
        , roleId: 0
        , getProfile() {
            fetch(`{{ env('API_URL') }}/api/user/me`, {
                method: 'GET'
                , headers: {
                    'Content-type': 'application/json;charset=UTF-8'
                    , 'Authorization': this.token
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
                    method: 'POST'
                    , headers: {
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
<main class="container relative flex justify-end font-poppins" x-data="listAdminDashboard" x-init="checkLogin();
  getProfile()">
    @livewire('partials.nav-mobile')

    @livewire('partials.sidebar')

    <section class="mt-20 w-full py-10 lg:mt-0 lg:w-[80%]">
        <div class="relative mx-auto w-11/12 rounded-xl pb-6 lg:mx-0 lg:w-full lg:bg-gray-1 lg:p-6" x-data="{ isAddActive: false }">
            <div class="relative mx-auto mb-12 flex w-max flex-col items-center justify-center gap-3">
                <h1 class="text-3xl font-bold text-orange-2">List <span class="text-navy">Bank</span></h1>
                <div class="relative h-2 w-40 rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
                </div>
            </div>
            <div x-show="isAddActive" x-transition.duration.500ms>
                @livewire('components.modal.add-bank')
            </div>

            <div class="mb-6">
                <a x-on:click="isAddActive = !isAddActive" class="inline-block cursor-pointer rounded-md bg-white px-6 py-2 font-semibold text-navy shadow-md shadow-navy/30 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-navy/40">Create
                    Bank</a>
            </div>

            <div class="overflow-hidden rounded-xl bg-white" x-data="listAdmin" x-init="getAdmins()">
                <ul class="flex gap-3 bg-orange-1 px-3 py-4 font-semibold text-navy">
                    <li class="w-10 text-center">No</li>
                    <li class="w-80">Name Bank</li>
                    <li class="w-80">Max Loan</li>
                    <li class="w-80 text-center">Action</li>
                </ul>
                <ul class="flex gap-3 px-3 py-4 font-semibold text-navy items-center">
                    <li class="w-10 text-center">1</li>
                    <li class="w-80">Bank of America</li>
                    <li class="w-80">80%</li>
                    <li class="w-80 flex gap-4">
                        <a href="" class="p-3 bg-orange-1 text-white rounded-lg w-full text-center hover:bg-[#EAA765]">Detail</a>
                        <a href="" class="p-3 bg-orange-2 text-white rounded-lg w-full text-center hover:bg-[#D73707]">Delete</a>
                    </li>
                </ul>
            </div>

        </div>
    </section>
</main>
