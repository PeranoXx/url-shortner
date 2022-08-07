@extends('layouts.app')

@section('main')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 text-center">
    <h1 class="text-5xl font-bold">URL Shortner</h1>
    @if (Auth::user())
    <div class="mt-5">
        <a href="{{route('states.index')}}" class="mt- text-white bg-slate-700 hover:bg-slate-800 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-6 py-2">Activities <i class="fa-solid fa-rocket"></i></a>
    </div>
    @else
    <div class="mt-5">
        <strong class="text-slate-700"> Note: </strong> <span class="text-slate-500"> You Can not see your activities. Please login to see your activities </span>
    </div>
    @endif

    <form id="url-form">
        @csrf
        <label for="default-search" class="mb-2 text-sm font-medium text-slate-900 sr-only dark:text-slate-300">Search</label>
        <div class="max-w-3xl mx-auto">
            <div class="relative">
                <input type="text" name="url" id="enterd-url" class="mt-10 block p-4 pr-36 w-full text-sm text-slate-900 bg-slate-50 rounded-lg border border-slate-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Enetr Url" required>
                <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-slate-700 hover:bg-slate-800 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-6 py-2">Shorten URL</button>
            </div>
            <p class="text-left pl-1 text-sm text-rose-500" id="url_error"></p>

            <div id="display_url"></div>
    </form>
</div>
@endsection