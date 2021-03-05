<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Url extends Model
{
    const API_KEY = '9dcafd17f2b1337a202b7a00b66bf1ad';
    
    protected $table = 'url';
    protected $primaryKey = 'url_id';
    protected $fillable = ['url', 'name'];

    public function data()
    {
        return $this->hasOne('App\UrlData', 'url_id', 'url_id');
    }
}
