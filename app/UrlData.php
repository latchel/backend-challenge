<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UrlData extends Model
{
    protected $table = 'url_data';
    protected $primaryKey = 'url_data_id';
    protected $fillable = ['url_id', 'title', 'description', 'image', 'url'];

    protected static function boot()
    {
        static::created(function ($data) {
            $data->getRelationValue('url')->update(['name' => $data->title]);
        });

        parent::boot();
    }

    public function url()
    {
        return $this->belongsTo('App\Url', 'url_id');
    }
}
