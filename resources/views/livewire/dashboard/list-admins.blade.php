<script>
    Alpine.data('logged', () => ({
        token: localStorage.getItem('token')
        , checkLogin() {
            if (!this.token) {
                window.location.href = `{{ route('login') }}`
                // console.log('hello')
            }
        }
        , showSidebar: false
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

</script>
<main class="container relative flex justify-end font-poppins" x-data="logged" x-init="checkLogin()">
    @livewire('partials.nav-mobile')

    @livewire('partials.sidebar')

    <section class="mt-20 w-full py-10 lg:mt-0 lg:w-[80%]">
        <div class="mx-auto w-11/12 rounded-xl  pb-6 lg:mx-0 lg:w-full lg:bg-gray-1 lg:p-6" x-data="{ isAddActive: false }">
            <div class="relative mx-auto mb-12 flex w-max flex-col items-center justify-center gap-3">
                <h1 class="text-3xl font-bold text-orange-2">List <span class="text-navy">Admin</span></h1>
                <div class="relative h-2 w-52 rounded-lg bg-orange-1 after:absolute after:inset-0 after:m-auto after:h-5 after:w-16 after:rounded-xl after:bg-navy">
                </div>
            </div>

            <div class="mb-6">
                <a x-on:click="isAddActive = true" class="inline-block cursor-pointer rounded-md bg-white px-6 py-2 font-semibold text-navy shadow-md shadow-navy/30 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-navy/40">Create
                    Admin</a>
            </div>

            @livewire('components.modal.add-admin') 

            <div class="bg-white rounded-xl overflow-hidden" x-data="listAdmin" x-init="getAdmins()">
                <ul class="flex gap-3 bg-orange-1 px-3 py-4 font-semibold text-navy">
                    <li class="w-10 text-center">No</li>
                    <li class="w-80">Nama</li>
                    <li class="w-80">Email</li>
                </ul>

                <template x-for="(admin, i) of admins">
                    @livewire('components.list-admin')
                </template>
            </div>

        </div>
    </section>
</main>
