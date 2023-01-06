<script>
    Alpine.data("Login", () => ({
        user : {email : "",
            password : ""
        },
        dataResponse : [],
        login(){
            const data = new FormData()
            data.append('email', this.user.email)
            data.append('password', this.user.password)

            fetch(`{{ env('API_URL') }}/api/user/login`, {
                method : "POST",
                body : data
            })
            .then(async(response) => {
                this.dataResponse = await response.json()
                console.log(this.dataResponse.message)

                if (this.dataResponse.status == false){
                    alert(this.dataResponse.message)
                    // window.location.replace('')
                }
                else{
                window.location.replace(`{{ env('APP_URL') }}`)

                }
            });
        }
    }));
</script>
<div class="container" x-data="Login">
    <div class="flex pt-[56px] justify-between">
        <div class="">
            <div class="">
                <a href="">
                    <img src="{{ asset ('./assets/Logo.png') }}" alt="" class="mx-auto mb-10 md:mx-auto lg:mb-0 lg:mx-0">
                </a>
            </div>
            <div class="md:hidden bg-[#FCC997] rounded-2xl m-5 lg:p-0">
                <img src="{{ asset('assets/IconLogin.png')}}" alt="" class="p-5 w-[596px] mx-auto  lg:pt-14">
            </div>
            <div class="mt-5 lg:mt-20">
                <h1 class="font-poppins font-semibold text-lg lg:text-[32px] text-center items-center text-[#0F0742]">Sign In</h1>
            </div>
            <div class="mt-5 lg:mt-10">
                <form x-on:submit.prevent="login()" method="" action="" enctype="multipart/form-data">
                    <div class="m-5 lg:m-0 lg:mb-6">
                        <label for="email" class="block mb-2 text-sm font-medium text-[#0F0742] font-poppins dark:text-white">Email</label>
                        <input x-model="user.email" type="email" id="email" name="email" class="w-full md:w-[280px] lg:w-[380px] border border-[#FCC997] p-2.5 rounded-lg" placeholder="Insert you email address" required>
                    </div>
                    <div class="m-5 lg:m-0 lg:mb-6">
                        <label for="password" class="block mb-2 text-sm font-medium text-[#0F0742] font-poppins dark:text-white">Password</label>
                        <input x-model="user.password" type="password" id="password" name="password" class="w-full lg:w-[380px] border border-[#FCC997] p-2.5 rounded-lg" placeholder="Insert you password" required>
                    </div>
                    <div class="m-5 text-right">
                        <a href="" class=" font-poppins text-[#0F0742] hover:text-[#4d36e4]">Forgot Password?</a>
                    </div>
                    <div class="flex justify-between gap-5 m-5 mb-20 lg:mb-0 lg:m-0 lg:gap-0 ">
                        <button type="submit" class="mt-5 lg:mt-0 bg-[#FCC997] px-5 py-2.5 rounded-lg font-poppins font-bold text-white w-full lg:w-[175px] hover:text-[#0F0742] hover:bg-[#f4f4f4] hover:border hover:border-[#FCC997]">Login</button>
                    <a href="{{url('/Register')}}" class="mt-5 lg:mt-0 border border-[#FCC997] px-5 p-2.5 rounded-lg font-poppins font-bold text-[#0F0742] w-full lg:w-[175px] text-center hover:bg-[#ff972f]  hover:text-white">Sign Up</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="md:w-[430px] md:h-[490px] md:mx-10 lg:m-0 lg:w-[793px] lg:h-[540px] bg-[#FCC997] rounded-2xl hidden md:block">
            <img src="{{ asset('assets/IconLogin.png')}}" alt="" class="md:pt-24 md:w-[420px] md:p-5 lg:w-[550px] mx-auto  lg:pt-8">
        </div>
    </div>
</div>
