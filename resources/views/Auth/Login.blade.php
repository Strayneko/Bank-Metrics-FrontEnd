@extends('Template.main')
@section('title', 'Login Page')
@section('containt')

<div class="container">
    <div class="flex pt-[56px] justify-between">
        <div class="">
            <div class="">
                <a href="">
                    <img src="{{ asset ('./assets/Logo.png') }}" alt="" class="mx-auto mb-10 md:mb-0 md:mx-0">
                </a>
            </div>
            <div class="lg:hidden bg-[#FCC997] rounded-2xl m-5 lg:p-0">
                <img src="{{ asset('assets/IconLogin.png')}}" alt="" class="p-5 w-[596px] mx-auto  md:pt-14">
            </div>
            <div class="mt-5 lg:mt-20">
                <h1 class="font-poppins font-semibold text-lg lg:text-[32px] text-center items-center text-[#0F0742]">Sign In</h1>
            </div>
            <div class="mt-5 lg:mt-10">
                <form method="" action="" enctype="multipart/form-data">
                    <div class="m-5 lg:mb-6">
                        <label for="email" class="block mb-2 text-sm font-medium text-[#0F0742] font-poppins dark:text-white">Email</label>
                        <input type="email" id="email" class="w-full lg:w-[380px] border border-[#FCC997] p-2.5 rounded-lg" placeholder="Insert you email address" required>
                    </div>
                    <div class="m-5 lg:mb-6">
                        <label for="password" class="block mb-2 text-sm font-medium text-[#0F0742] font-poppins dark:text-white">Password</label>
                        <input type="password" id="email" class="w-full lg:w-[380px] border border-[#FCC997] p-2.5 rounded-lg" placeholder="Insert you password" required>
                    </div>
                    <div class="text-right m-5">
                        <a href="" class=" font-poppins text-[#0F0742] hover:text-[#4d36e4]">Forgot Password?</a>
                    </div>
                    <div class="flex justify-between m-5 mb-24 gap-5 lg:mb-0 lg:m-0 lg:gap-0 ">
                        <button type="submit" class="mt-5 lg:mt-10 bg-[#FCC997] px-5 py-2.5 rounded-lg font-poppins font-bold text-white w-full lg:w-[175px] hover:text-[#0F0742] hover:bg-[#f4f4f4] hover:border hover:border-[#FCC997]">Login</button>
                    <a href="" class="mt-5 lg:mt-10 border border-[#FCC997] p-2.5 rounded-lg font-poppins font-bold text-[#0F0742] w-full lg:w-[175px] text-center hover:bg-[#ff972f]  hover:text-white">Sign Up</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="w-[793px] h-[650px] bg-[#FCC997] rounded-2xl hidden lg:block">
            <img src="{{ asset('assets/IconLogin.png')}}" alt="" class="p-5 w-[596px] mx-auto  md:pt-14">
        </div>

    </div>
</div>


@endsection
