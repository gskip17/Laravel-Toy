<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['title', 'content', 'slug', 'status', 'user_id'];
    
    //each ticket belongs to a User
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function getTitle(){
        return $this->title;
    }
    
    public function comments(){
        $this->hasMany('App/Comment', 'post_id');
    }
}
