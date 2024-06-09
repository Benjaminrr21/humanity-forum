<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Topic;
use App\Models\User;
use App\Models\Reply;
use App\Events\NotificationFromTopic;


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
        $t = Topic::find($idTopic);
        $followers = Topic::find($idTopic)->followers()->get();
        foreach ($followers as $f) {
            # code...
            if($f->id != $idUser){
        event(new NotificationFromTopic("Na temi ".$t->name." dodat je novi komentar.",$f->id));
            }    
    }


        return back();
    }
    public function like($commentId){
        $comment = Comment::find($commentId);
        $user = auth()->user();
    
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }
    
        if ($comment->likedByUsers()->where('user_id', $user->id)->exists()) {
            return response()->json(['message' => 'Already liked'], 400);
        }
    
        $comment->likedByUsers()->attach($user->id);
        $comment->likes += 1;
        $comment->save();
    
        return response()->json(['message' => 'ok', 'likesCount' => $comment->likes], 200);
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
    public function addReply(Request $r,$idC,$idU,$idT){
        $reply = new Reply();
        $reply->content = $r->content;
        $reply->comment_id = $idC;
        $reply->user_id = $idU;
        $reply->topic_id = $idT;
        $reply->save();

        return back();

    }
    public function delete($id){
        $c = Comment::find($id);
        $c->delete();
        return back();
    }
}
