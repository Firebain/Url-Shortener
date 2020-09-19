<?php

namespace App\Models;

use App\Facades\UrlShortener;
use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    protected $fillable = ["url"];

    public function resolveRouteBinding($value, $field = null)
    {
        if (!UrlShortener::validate($value)) {
            return null;
        }

        return $this
            ->where($field ?? $this->getRouteKeyName(), UrlShortener::decode($value))
            ->first();
    }

    public function getPathAttribute()
    {
        return route("redirect", ["shortUrl" => UrlShortener::encode($this->id)]);
    }
}