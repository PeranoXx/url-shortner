@extends('layouts.app')

@section('main')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 text-center">
    <div class="min-h-screen sm:py-12">
        <div class="p-10 xs:p-0 mx-auto md:w-full md:max-w-md">
            <!-- <h1 class="font-bold text-center text-2xl mb-5">Your Logo</h1> -->
            <div class="bg-white shadow w-full rounded-md divide-y divide-gray-200">
                <div class="px-5 py-7">
                    <form action="{{ route('auth.customRegistration') }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label class="font-semibold text-sm text-gray-600 pb-1 block">Full Name</label>
                            <input type="text" name="name" class="border rounded-md px-3 py-2 mt-1  text-sm w-full" required />
                        </div>
                        <div class="mb-5">
                            <label class="font-semibold text-sm text-gray-600 pb-1 block">E-mail</label>
                            <input type="email" name="email" class="border rounded-md px-3 py-2 mt-1  text-sm w-full" required />
                            @error('email')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label class="font-semibold text-sm text-gray-600 pb-1 block">Password</label>
                            <input type="password" name="password" class="border rounded-md px-3 py-2 mt-1  text-sm w-full" required />
                            @error('password')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="transition duration-200 bg-blue-500 hover:bg-blue-600 focus:bg-blue-700 focus:shadow-sm focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 text-white w-full py-2.5 rounded-md text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block">
                            <span class="inline-block mr-2">Register</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </button>
                    </form>
                </div>
                <div class="py-5">
                    <div class="grid grid-cols-2 gap-1">
                        <div class="text-center sm:text-left whitespace-nowrap">
                            <a href="{{route('auth.index')}}" class="transition duration-200 mx-5 px-5 py-4 cursor-pointer font-normal text-sm rounded-md text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-200 focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 ring-inset">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block align-text-bottom	">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <span class="inline-block ml-1">Login</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection