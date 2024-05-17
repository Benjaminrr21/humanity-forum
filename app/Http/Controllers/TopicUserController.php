<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TopicUser;

class TopicUserController extends Controller
{
    //
    public function follow($idTopic,$idUser){
        $topicUser = new TopicUser();
        $topicUser->topic_id = $idTopic; 
        $topicUser->user_id = $idUser; 
        $topicUser->save();
    }
}
