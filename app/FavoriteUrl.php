<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavoriteUrl extends Model
{
    protected $table = 'favorite_url';
    protected $primaryKey = 'favorite_url_id';
    protected $fillable = ['url_id', 'user_id'];

    public function url()
    {
        return $this->belongsTo('App/Url', 'url_id');
    }

    public function user()
    {
        return $this->belongsTo('App/User', 'user_id');
    }
}
