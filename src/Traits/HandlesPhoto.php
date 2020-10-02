<?php

namespace Helium\LaravelHelpers\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

trait HandlesPhoto
{
    public function setPhotoUrlAttribute($value)
    {
        $path = Storage::putFile("users/{$this->getKey()}/profile", $value);
        $this->attributes['photo_url'] = $path;
    }

    public function getPhotoUrlAttribute()
    {
        return Storage::temporaryUrl($this->attributes['photo_url'], Carbon::now()->addMinute());
    }
}