<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Url extends Model
{
    protected $table = 'url';
    protected $primaryKey = 'url_id';
    protected $fillable = ['url', 'name'];

    public function data()
    {
        return $this->hasOne('App\UrlData', 'url_id', 'url_id');
    }
}
