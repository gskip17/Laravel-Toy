<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\CommentRequestForm;

class Comment extends Model
{
    protected $guarded = ['id'];

    public function ticket(){
        $this->belongsTo('App\Ticket');
    }
}
