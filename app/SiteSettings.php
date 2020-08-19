<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteSettings extends Model
{
    protected $fillable = ['site_name', 'phone', 'facebook_link', 'twitter_link', 'github_link', 'address', 'key_words',
        'description', 'alternate_image', 'main_slider','copy_right'
    ];
}
