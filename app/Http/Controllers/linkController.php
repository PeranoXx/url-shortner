<?php

namespace App\Http\Controllers;

use App\Models\shortUrl as ModelsShortUrl;
use App\Models\shortUrlVistit;
use AshAllenDesign\ShortURL\Facades\ShortURL;
use Jenssegers\Agent\Facades\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class linkController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function createShortUrl(Request $request)
    {
        try {
            $rules = [
                'url' => 'required|url',
            ];
            $validatedData = Validator::make($request->all(), $rules);

            if ($validatedData->fails()) {
                $res = [
                    "status" => "error",
                    "message" => $validatedData->errors()->first(),
                    "data" => ""
                ];
                return response($res, 200);
            }
            $shortUrlData = ModelsShortUrl::where('destination_url', $request->url);
            if (Auth::user()) {
                $shortUrlData = $shortUrlData->where('user_id', Auth::user()->id);
            }
            $shortUrlData = $shortUrlData->first();
            if ($shortUrlData) {
                $res = $this->sendUrlResponse($shortUrlData->default_short_url, $shortUrlData->destination_url, $shortUrlData->url_key);
                return response($res, 200);
            } else {
                $shortURLObject = ShortURL::destinationUrl($request->url)
                    ->trackVisits()
                    ->trackIPAddress()
                    ->trackBrowser()
                    ->trackBrowserVersion()
                    ->trackOperatingSystem()
                    ->trackOperatingSystemVersion()
                    ->trackDeviceType()
                    ->trackRefererURL()
                    ->make();
                $shortURL = $shortURLObject->default_short_url;
                $shortUrlIp = ModelsShortUrl::where('destination_url', $request->url)->first();
                $shortUrlIp->user_id = Auth::user() ? Auth::user()->id : null;
                $shortUrlIp->save();
                $res = $this->sendUrlResponse($shortURL, $request->url, $shortURLObject->url_key);
                return response($res, 200);
            }
        } catch (\Throwable $th) {
            $res = [
                "status" => "error",
                "message" => $th->getMessage()
            ];
            return response($res, 200);
        }
    }

    public function linkVisit(Request $request, $shortURLKey)
    {
        try {
            $shortURL = ModelsShortUrl::where('url_key', $shortURLKey)->first();
            if (!$shortURL) {
                abort(404);
            }
            $visit = new shortUrlVistit();
            $visit->short_url_id = $shortURL->id;
            if ($shortURL->track_ip_address) {
                $visit->ip_address = $request->ip();
            }

            if ($shortURL->track_operating_system) {
                $visit->operating_system = Agent::platform();
            }

            if ($shortURL->track_operating_system_version) {
                $visit->operating_system_version = Agent::version(Agent::platform());
            }

            if ($shortURL->track_browser) {
                $visit->browser = Agent::browser();
            }

            if ($shortURL->track_browser_version) {
                $visit->browser_version = Agent::version(Agent::browser());
            }

            if ($shortURL->track_referer_url) {
                $visit->referer_url = $request->headers->get('referer');
            }
            if ($visit->save()) {
                return Redirect::to($shortURL->destination_url);
            }
        } catch (\Throwable $th) {
            $res = [
                "status" => "error",
                "message" => $th->getMessage()
            ];
            return response($res, 200);
        }
    }

    public function sendUrlResponse($shortURL, $url, $key)
    {
        $data = [
            'short_url' => $shortURL,
            'domain' => parse_url($url, PHP_URL_HOST),
            'url' => $url,
            'key' => $key
        ];
        $res = [
            "status" => "success",
            "message" => 'Shorten URL successfully',
            "data" => $data
        ];

        return $res;
    }
}
