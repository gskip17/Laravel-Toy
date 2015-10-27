<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CommentRequestForm;
use App\Http\Controllers\Controller;
use App\Comment;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newComment(CommentRequestForm $request){

      $comment = new Comment([
          'post_id' => $request->get('post_id'),
          'content' => $request->get('content')
        ]);

        $comment->save();

        return redirect()->back()->with('status', 'Your comment has been created!');

    }
}
