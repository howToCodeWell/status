<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    /**
     * @var string
     */
    protected $table = 'site';
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'url'
    ];

}
