<?php

namespace TwillRedirects\Twill\Capsules\Redirects\Models;

use A17\Twill\Models\Model;
use Illuminate\Support\Facades\Cache;

class Redirect extends Model
{
    protected $fillable = [
        'published',
        'title',
        'redirects',
    ];

    protected $casts = [
        'redirects' => 'array',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('twill_redirects'));
        static::deleted(fn () => Cache::forget('twill_redirects'));
    }
}
