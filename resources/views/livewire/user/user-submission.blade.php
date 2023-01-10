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

    Alpine.data('listAdmin', () => ({
        admins: []
        , getAdmins() {
            fetch(`{{ env('API_URL') }}/api/admin`, {
                    method: 'GET'
                    , headers: {
                        'Content-type': 'application/json;charset=UTF-8'
                        , 'Authorization': localStorage.getItem('token')
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
            name: ""
            , email: ""
            , password: ""
        }
        , message: ''
        , create() {
            const data = new FormData()
            data.append('name', this.newAdmin.name)
            data.append('email', this.newAdmin.email)
            data.append('password', this.newAdmin.password)

            fetch(`{{ env('API_URL') }}/api/admin`, {
                    method: "POST"
                    , body: data
                    , headers: {
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
        }
        , checkLogged() {
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
        <div class="w-full">
            <div class="w-[575px] mb-48 mx-auto relative inset-x-0 z-40">
                <div class="relative bg-white pt-8 mt-32  rounded-xl">
                    <div class="relative mx-auto mb-12 flex w-max flex-col items-center justify-center gap-3">
                        <h1 class="text-3xl font-bold text-navy"><span class="text-orange-2">Form</span> Submission</h1>
                        <div class="relative h-2 w-[285px] rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
                        </div>
                    </div>
                    <form class="px-[39px] flex flex-col cursor-pointer">
                        <label for="submission" class="relative pb-3 w-full">
                            <p class="font-bold text-navy">Submission</p>
                            <input type="text" name="submission" id="submission" class="peer outline-none mt-2" placeholder="Insert your loaning amount">
                            <div class="absolute inset-x-0 bottom-0 mx-auto block h-1 w-0 bg-navy peer-hover:w-full rounded-lg transition-all duration-500"></div>
                        </label>
                        <div class="flex mt-5  justify-between pb-12">
                            <button type="submit" class="text-navy font-bold bg-[#f1f0f0] outline outline-orange-1 hover:bg-orange-1 hover:text-white px-24 py-3 rounded-lg">Send</button>
                            {{-- <a x-on:click="isUpdate = false" class="text-navy font-bold bg-[#f1f0f0] outline outline-orange-1 hover:bg-orange-1 hover:text-white px-24 py-3 rounded-lg">Back</a> --}}
                        </div>
                    </form>
                </div>
            </div>
            <div class="absolute inset-0 bg-gray-1/40 z-20 backdrop-blur-sm" x-on:click="isUpdate = false"></div>
        </div>
        
    </section>
    {{-- End User Profile  --}}

</main>
