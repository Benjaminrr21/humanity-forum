<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Topic;
use App\Models\User;

class CommentController extends Controller
{
    //
    public function addComment(Request $r,$idTopic,$idUser){
        $comment = new Comment();
        $comment->content = $r->comment;
        $comment->topic_id = $idTopic;
        $comment->user_id = $idUser;
        $comment->username = User::find($idUser)->email;
        $comment->save();


        return back();
    }
    public function like($commentId){
        $c = Comment::find($commentId);
        if ($c) {
            $c->likes = $c->likes + 1;
            $c->save();
            return 'ok';
        }
        return 'Comment not found';
    }
    
    public function dislike($commentId){
        $c = Comment::find($commentId);
        if ($c) {
            $c->dislikes = $c->dislikes + 1;
            $c->save();
            return 'ok';
        }
        return 'Comment not found';
    }
}
