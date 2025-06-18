<?php

namespace TwillRedirects\Twill\Capsules\Redirects\Models;

use A17\Twill\Models\Model;

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
}
