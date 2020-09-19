<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use App\Notifications\ShortUrlCreated;
use Illuminate\Http\Request;

class ShortUrlController extends Controller
{
    public function create()
    {
        return view("home");
    }

    public function store(Request $request)
    {
        $request->validate([
            "link" => [
                "required",
                "max:255",
                "url",
                "starts_with:http,https"
            ]
        ]);

        $short_url = ShortUrl::firstOrCreate(["url" => $request->link]);

        $request->user()->notify(new ShortUrlCreated($short_url));

        return [
            "url" => $short_url->path
        ];
    }

    public function show(ShortUrl $shortUrl)
    {
        return redirect($shortUrl->url);
    }
}