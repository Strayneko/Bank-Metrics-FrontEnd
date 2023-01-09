<script>
    Alpine.data("Register", () => ({
        user : {
            name : "",
            email : "",
            password : ""
        },
        msg: '',
        register(){
            const data = new FormData()
            data.append('name', this.user.name)
            data.append('email', this.user.email)
            data.append('password', this.user.password)

            fetch(`{{ env('API_URL') }}/api/auth/register`, {
                method: "POST",
                body: data
            })
            .then(async(response) => {
                let data = await response.json()
                let status = data.status
                this.msg = data.message
                // console.log(this.msg.password[0])
                if(status == false){
                    alert(this.msg.password[0])
                    window.location.replace('')
                }
                window.location.replace(`{{ env('APP_URL') }}/login`)


            });
        }
    }));
</script>
<div class="container" x-data="Register">
    <div class="flex pt-[56px] justify-between">
        <div class="">
            <div class="">
                <a href="">
                    <img src="{{ asset ('./assets/Logo.png') }}" alt="" class="mx-auto mb-10 md:mx-auto lg:mb-0 lg:mx-0">
                </a>
            </div>
            <div class="bg-[#FCC997] rounded-2xl m-5 md:m-0 md:block md:w-[685px] md:mx-10 lg:mx-0 lg:hidden lg:p-0">
                <img src="{{ asset('assets/register.png')}}" alt="" class="p-5 w-[596px] mx-auto  md:p-20 md:w-full md:mx-auto lg:pt-14">
            </div>
            <div class="mt-5 md:mt-10 lg:mt-20">
                <h1 class="font-poppins font-semibold text-lg lg:text-[32px] text-center items-center text-[#0F0742]">Sign Up</h1>
            </div>
            <div class="mt-5 md:mx-5 md:mt-8 lg:mt-10">
                <form x-on:submit.prevent="register()" method="" action="" enctype="multipart/form-data">
                    <div class="m-5 lg:m-0 lg:mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-[#0F0742] font-poppins dark:text-white">Name</label>
                        <input x-model="user.name" type="text" id="name" name="name" class="w-full md:w-full lg:w-[380px] border border-[#FCC997] p-2.5 rounded-lg" placeholder="Insert your name" required>
                    </div>
                    <div class="m-5 lg:m-0 lg:mb-6">
                        <label for="email" class="block mb-2 text-sm font-medium text-[#0F0742] font-poppins dark:text-white">Email</label>
                        <input x-model="user.email" type="email" id="email" name="email" class="w-full md:w-full lg:w-[380px] border border-[#FCC997] p-2.5 rounded-lg" placeholder="Insert your email address" required>
                    </div>
                    <div class="m-5 lg:m-0 lg:mb-6">
                        <label for="password" class="block mb-2 text-sm font-medium text-[#0F0742] font-poppins dark:text-white">Password</label>
                        <input x-model="user.password" type="password" id="password" name="password" class="w-full md:w-full lg:w-[380px] border border-[#FCC997] p-2.5 rounded-lg" placeholder="Insert your password" required>
                    </div>
                    <div class="flex justify-between gap-5 m-5 mb-20 lg:mb-0 lg:m-0 lg:gap-0 ">
                        <button type="submit" class="mt-5 lg:mt-5 border border-[#FCC997] px-5 p-2.5 rounded-lg font-poppins font-bold text-[#0F0742] w-full lg:w-[175px] text-center hover:bg-[#ff972f]  hover:text-white">Sign Up</button>
                        <a href="{{url('/Login')}}" class="mt-5 lg:mt-5 bg-[#FCC997] px-5 py-2.5 rounded-lg font-poppins font-bold text-white text-center w-full lg:w-[175px] hover:text-[#0F0742] hover:bg-[#f4f4f4] hover:border hover:border-[#FCC997]">Sign In</a>

                    </div>
                </form>
            </div>
        </div>
        <div class="md:w-[430px] md:h-[538px] md:mx-10 lg:m-0 lg:w-[793px] lg:h-[610px] bg-[#FCC997] rounded-2xl hidden md:hidden lg:block">
            <img src="{{ asset('assets/register.png')}}" alt="" class="md:pt-32 md:w-[620px] md:p-5 lg:w-full mx-auto  lg:pt-1">
        </div>
    </div>
</div>
