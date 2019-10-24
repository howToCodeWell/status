<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }

    /**
     * @return Model|HasMany|object|null
     */
    public function getLatestResult()
    {
        return $this->results()->latest()->first();
    }

    /**
     * @return bool
     */
    public function hasPassed():bool
    {
        $passed = false;
        $result = $this->getLatestResult();
        if($result){
            $passed = $this->getLatestResult()->passed;
        }
        return $passed;
    }
}
