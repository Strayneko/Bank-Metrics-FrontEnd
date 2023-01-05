
<div class="container">
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
                <form method="" action="" enctype="multipart/form-data">
                    <div class="m-5 lg:m-0 lg:mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-[#0F0742] font-poppins dark:text-white">Name</label>
                        <input type="text" id="name" name="name" class="w-full md:w-full lg:w-[380px] border border-[#FCC997] p-2.5 rounded-lg" placeholder="Insert your name" required>
                    </div>
                    <div class="m-5 lg:m-0 lg:mb-6">
                        <label for="email" class="block mb-2 text-sm font-medium text-[#0F0742] font-poppins dark:text-white">Email</label>
                        <input type="email" id="email" name="email" class="w-full md:w-full lg:w-[380px] border border-[#FCC997] p-2.5 rounded-lg" placeholder="Insert your email address" required>
                    </div>
                    <div class="m-5 lg:m-0 lg:mb-6">
                        <label for="password" class="block mb-2 text-sm font-medium text-[#0F0742] font-poppins dark:text-white">Password</label>
                        <input type="password" id="password" name="password" class="w-full md:w-full lg:w-[380px] border border-[#FCC997] p-2.5 rounded-lg" placeholder="Insert your password" required>
                    </div>
                    <div class="flex justify-between m-5 mb-20 gap-5 lg:mb-0 lg:m-0 lg:gap-0 ">
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