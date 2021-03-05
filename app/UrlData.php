<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UrlData extends Model
{
    protected $table = 'url_data';
    protected $primaryKey = 'url_data_id';
    protected $fillable = ['url_id', 'title', 'description', 'image', 'url'];

    public function url()
    {
        return $this->belongsTo('App\Url', 'url_id');
    }
}
