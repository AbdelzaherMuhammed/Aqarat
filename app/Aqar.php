<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aqar extends Model
{
    protected $fillable = ['id', 'bu_name', 'bu_price', 'bu_rent', 'bu_square', 'bu_type', 'bu_small_disc', 'bu_meta',
        'bu_longitude', 'bu_latitude', 'bu_large_disc', 'bu_status', 'user_id' , 'rooms', 'bu_place', 'month', 'year'
    ];


    public function user()
    {
        return $this->belongsTo('App\User');
    }



}
