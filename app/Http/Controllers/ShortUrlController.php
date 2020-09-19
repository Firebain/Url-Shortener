<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use App\Notifications\ShortUrlCreated;
use Illuminate\Http\Request;

class ShortUrlController extends Controller
{
    public function index()
    {
        $urls = auth()->user()->short_urls;

        return view("url_list", [
            "short_urls" => $urls
        ]);
    }

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

        $user = $request->user();

        $short_url = ShortUrl::firstOrCreate(["url" => $request->link]);

        $user->short_urls()->syncWithoutDetaching($short_url);

        $user->notify(new ShortUrlCreated($short_url));

        return [
            "url" => $short_url->path
        ];
    }

    public function show(ShortUrl $shortUrl)
    {
        $shortUrl->increment("hits");

        return redirect($shortUrl->url);
    }
}