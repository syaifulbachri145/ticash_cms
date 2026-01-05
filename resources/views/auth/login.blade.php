@extends('layouts.auth', ['title' => 'Login - Admin'])

@section('content')

<div class="flex justify-center items-center bg-gray-100 font-[sans-serif] h-full md:min-h-screen p-4">
      <div class="grid justify-center max-w-md mx-auto">
        <div>
          <img src="{{ asset('assets/img/login_banner.png') }}" class="w-full object-cover rounded-2xl" alt="login-image" />
        </div>

        @if (session('status'))
        <div class="bg-green-500 p-3 rounded-md shadow-sm mt-3">
            {{ session('status') }}
        </div>
        @endif
        <form class="bg-white rounded-2xl p-6 -mt-24 relative z-10 shadow-[0_2px_16px_-3px_rgba(6,81,237,0.3)]" action="{{ route('login') }}" method="POST">
        @csrf
        
        <div class="mb-12">

        
        <button id="#" class="flex items-center focus:outline-none mr-3">
                                <img class="w-10 h-10 mr-2" src="{{ asset('assets/img/favicon.png') }}" alt="Avatar of User">
                                <a class="text-white-600 text-base xl:text-2xl no-underline hover:no-underline" href="{{ route('admin.dashboard.index') }}">
                                ticash</a>
                            </button>
    </div>

          <div class="relative flex items-center">
          <input type="email" name="email" value="{{ old('email') }}"
                    class="form-input mt-1 block w-full rounded-md focus:outline-none" placeholder="Alamat Email">
                @error('email')
                <div class="inline-flex max-w-sm w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                    <div class="px-4 py-2">
                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                    </div>
                </div>
                @enderror
            <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-2" viewBox="0 0 682.667 682.667">
              <defs>
                <clipPath id="a" clipPathUnits="userSpaceOnUse">
                  <path d="M0 512h512V0H0Z" data-original="#000000"></path>
                </clipPath>
              </defs>
              <g clip-path="url(#a)" transform="matrix(1.33 0 0 -1.33 0 682.667)">
                <path fill="none" stroke-miterlimit="10" stroke-width="40" d="M452 444H60c-22.091 0-40-17.909-40-40v-39.446l212.127-157.782c14.17-10.54 33.576-10.54 47.746 0L492 364.554V404c0 22.091-17.909 40-40 40Z" data-original="#000000"></path>
                <path d="M472 274.9V107.999c0-11.027-8.972-20-20-20H60c-11.028 0-20 8.973-20 20V274.9L0 304.652V107.999c0-33.084 26.916-60 60-60h392c33.084 0 60 26.916 60 60v196.653Z" data-original="#000000"></path>
              </g>
            </svg>
          </div>

          <div class="mt-6">
            <div class="relative flex items-center">
            <input type="password" name="password" class="form-input mt-1 block w-full rounded-md"
                    placeholder="Password">
                @error('password')
                <div class="inline-flex max-w-sm w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                    <div class="px-4 py-2">
                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                    </div>
                </div>
                @enderror
              <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-2 cursor-pointer" viewBox="0 0 128 128">
                <path d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z" data-original="#000000"></path>
              </svg>
            </div>
          </div>

          <div class="flex flex-wrap items-center justify-between gap-4 mt-6">
            <div class="flex items-center">
              <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
              <label for="remember-me" class="text-gray-800 ml-3 block text-sm">
                Remember me
              </label>
            </div>
            <div>
              <a href="/forgot-password" class="text-blue-600 text-sm font-semibold hover:underline">
                Forgot Password?
              </a>
            </div>
          </div>


          
        <div class="mt-12">
            <button type="submit"  class="w-full py-2.5 px-4 text-sm font-semibold tracking-wider rounded-2xl text-white bg-blue-800 hover:bg-blue-700 focus:outline-none">
              Sign in
            </button>
            <!--
            <p class="text-sm text-center mt-6">Don't have an account <a href="javascript:void(0);" class="text-blue-600 font-semibold hover:underline ml-1 whitespace-nowrap">Register here</a></p>
            --> 
        </div>

          </form>
          <hr class="my-6 border-gray-300" />

          <div class="space-x-6 flex justify-center">
         
           
          </div>
       
      </div>
    </div>


    @endsection