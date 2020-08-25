<?php

namespace App\Models;

use App\Facades\Bijective;
use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    protected $fillable = ["url"];

    public function resolveRouteBinding($value, $field = null)
    {
        return $this
            ->where($field ?? $this->getRouteKeyName(), Bijective::decode($value))
            ->first();
    }

    public function getPathAttribute() {
        return route("redirect", ["shortUrl" => Bijective::encode($this->id)]);
    }
}