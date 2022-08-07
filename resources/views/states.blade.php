@extends('layouts.app')

@section('main')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 text-center">
    <h1 class="text-5xl font-bold mb-10 flex justify-center">
        <a href="{{route('url.index')}}" class="pr-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        URL Shortner States
    </h1>
    <!-- {{$user->short_urls}} -->
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                        <th class="px-4 py-3">Short Url</th>
                        <th class="px-4 py-3">Destination Url</th>
                        <th class="px-4 py-3">Clicks</th>
                        <th class="px-4 py-3">Website</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($user->short_urls as $url)
                    <tr class="text-gray-700">
                        <td class="px-4 py-3 border">
                            <div class="flex items-center text-sm">
                                <a href="{{$url->default_short_url}}" target="_blank"> {{$url->default_short_url}}</a>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-ms font-semibold border">
                            {{$url->destination_url}}
                        </td>
                        <td class="px-4 py-3 text-xs border">
                            <span class="px-2 py-1"> {{$url->short_url_visits->count()}} </span>
                        </td>
                        <td class="px-4 py-3 text-sm border">{{parse_url($url->destination_url, PHP_URL_HOST)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection