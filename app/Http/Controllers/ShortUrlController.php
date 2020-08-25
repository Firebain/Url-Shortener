<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use App\Notifications\ShortUrlCreated;
use Illuminate\Http\Request;

class ShortUrlController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("home");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "link" => [
                "required",
                "url",
                "starts_with:http,https"
            ]
        ]);

        $short_url = ShortUrl::where("url", $request->link)->first();

        if ($short_url !== null) {
            $exists = true;
        } else {
            $exists = false;

            $short_url = ShortUrl::create([
                "url" => $request->link
            ]);
        }

        $request->user()->notify(new ShortUrlCreated($short_url));

        return [
            "exists" => $exists,
            "url" => $short_url->path
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShortUrl  $shortUrl
     * @return \Illuminate\Http\Response
     */
    public function show(ShortUrl $shortUrl)
    {
        return redirect($shortUrl->url);
    }
}