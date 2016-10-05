<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model {

    // user has many news
    public function news()
    {
        return $this->hasMany('App\News','id');
    }

    // Returns the instance of the user who has selected the news
    public function user()
    {
        return $this->belongsTo('App\User','id');
    }

}
