<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Topic;
use App\Models\User;
use App\Models\Comment;
use App\Models\Poll;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Events\RegisterUser;
use App\Notifications\news;
use App\Models\Newss2;
use App\Models\follower;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageFromModerator;
use App\Events\NewFollower;
use Illuminate\Support\Facades\Mail;
use App\Mail\Alert;




use Illuminate\Notifications\DatabaseNotification;

use App\Models\Answer;

class TopicController extends Controller
{
    //
    public function getAll(){
        $topics = Topic::all(); 
        return view('topics.list')->with('topics',$topics);
    }
    public function topicIndex(){
        return view('topics.addTopic')->with("num",Topic::where("owner_id",Auth::user()->id)->count());
    }
    public function create(Request $r,$id){
        $topic = new Topic();

        $topics = Topic::where('owner_id',$id)->where('isOpen',1)->get();
        if($topics->count()==2) 
        return back()->with("message",'Neuspelo. Imate više od dve otvorene teme.');

        else{
        $topic->name = $r->name;
        $topic->numOfFollowers = 0;
        $topic->isOpen = 1;
        $topic->owner_id = $id; 
        $topic->content = $r->content;
        $topic->isAccepted = 0;

        if ($r->hasFile('file')) {
            $fileName = time() . $r->file('file')->getClientOriginalName();
            $path = $r->file('file')->storeAs('files', $fileName, 'public');
            $topic->file_path = '/storage/' . $path;
        }


      event(new RegisterUser($topic->name));
      $admin = User::where("role_id",1)->first();

       Notification::send($admin,new news($topic->name));
       $topic->save();


       return view('home')->with('waiting','Predlog teme je poslat na odobravanje.');
       //return redirect()->route('topic-id',['id'=>$topic->id]);
        }
    }
    public function getById($id){
        $t = Topic::find($id);
        $comments = Comment::where('topic_id',$id)->get();
        if($t) return view('topics.topicById')->with(['id'=>$t->id,'topic'=>$t,'comments'=>$comments]);
        return 'nistaa';
    }
    public function closeTopic($id){
        $t = Topic::find($id);
        $t->isOpen=0;
        $t->save();
        
        return back();
    }
    public function openTopic($id){
        $t = Topic::find($id);
        $t->isOpen=1;
        $t->save();
        
        return back();
    }


    public function followTopic($idTopic,$idUser){
        $topic = Topic::find($idTopic);

    if (!$topic) {
        return "Topic not found.";
    }

    $user = User::find($idUser);

    if (!$user) {
        return "User not found.";
    }
    $topic->numOfFollowers = $topic->numOfFollowers+1;

    $topic->followers()->attach($idUser);
    //$user->following()->attach($idTopic);
    $f = new follower();
    $f->idM = $topic->owner_id;
    $f->content = "Na temi ".$topic->name." imate novog pratioca: ".$user->username." .";
    $f->save();
    event(new NewFollower("Na temi ".$topic->name." imate novog pratioca: ".$user->username." .",$topic->owner_id));

    
    return back();
    }
    public function topicsOfModerator($idModerator){
        ///$us = User::find($idModerator);
        //$topics = Topic::where('owner_id',$idUser)->get();
        $myTopics = Topic::where(['owner_id'=>$idModerator,'isAccepted'=>1])->get();
        return view('topics.topicsByModerator')->with('topics',$myTopics);
    }

    public function myTopics($idUser){
        $user = User::find($idUser);
        //$topics = Topic::where('owner_id',$idUser)->get();
        return view('topics.myTopics')->with('topics',$user->following);
    }
    public function getBadUser($idTopic){
        $t = Topic::find($idTopic);
        $flws = $t->followers()->get();
        $comments = $t->comments()->get();

        $filteredComments = $comments->filter(function($comment) {
            return $comment->dislikes > 5;
        });

        
    // Nađi komentar sa najviše dislajkova među filtriranim komentarima
    $maxDislikesComment = $filteredComments->sortByDesc('dislikes')->first();

    // Izvuci korisnika iz komentara sa najviše dislajkova
    $badUser = $maxDislikesComment ? $maxDislikesComment->user : null;
        
        if ($badUser) {
            Session::put('baduser_id', $badUser->id);
        }

        return $badUser;
    }
    public function myUsers($id){
        $t = Topic::find($id);
        //$myusers = User::where('id',$t->owner_id)->get();
        $myusers = $t->followers;
        $bu = $this->getBadUser($id);

        //return redirect()->route('my-users',['id'=>$id])->with('users',$myusers);
        return view('topics.myUsers')->with(['users'=>$myusers,'topic'=>$t,'baduser'=>$bu]);
    }
    public function alert($id){
        Mail::to($id)->send(new Alert([]));
        return back();
    }
    public function addPollIndex($id){
        $t = Topic::find($id);
        return view('poll')->with('topic',$t);
    }
    public function search(Request $r){
        $query = $r->search;

        $topics = Topic::where('name','LIKE','%{$query}%')->get();
        return view('topics.list')->with('topics',$topics);
    }
    public function createPoll(Request $r,$idT,$idM){
        $poll = new Poll();
        $poll->question = $r->question;
        $poll->topic_id = $idT;
        $poll->moderator_id = $idM;

        $poll->save();

        return view('answers')->with('poll',$poll);
    }
    public function addAnswers(Request $r, $id){
        $a1 = new Answer();
        $a2 = new Answer();
        $a3 = new Answer();
        $a1->content = $r->answer1;
        $a2->content = $r->answer2;
        $a3->content = $r->answer3;
        $a1->poll_id = $id;
        $a2->poll_id = $id;
        $a3->poll_id = $id;
        $a1->votes = 0;
        $a2->votes = 0;
        $a3->votes = 0;

        $a1->save();
        $a2->save();
        $a3->save();
        
        $p = Poll::find($id);
        return view('pollIndex')->with('poll',$p);
        //return view('pollIndex')->with('poll',$p);
    }
    public function pollWithId($id){
        $p = Poll::where('topic_id',$id)->first();
        return view('pollIndex')->with('poll',$p);
    }
    public function vote(Request $r){
        $a = Answer::where('id',$r->ans)->first();
        $p = Poll::where('id',$a->poll_id)->first();
        $t = Topic::where('id',$p->topic_id)->first();
        $a->votes = $a->votes+1;
        $a->save();
        //return view('topics.topicById')->with('topic',$t);
        return back()->with(['poll'=>$a->poll,'isvote'=>'yes']);
    }
    public function deletePoll($id){
        $p = Poll::find($id);
        $p->delete();
        return redirect()->route('topic-id',['id'=>$p->topic->id]);
    }
    public function openStatistic($id){
        // Pronalazak teme
        $t = Topic::find($id);
    
        // Provera da li je tema pronađena
        if (!$t) {
            return 'Tema nije pronađena.';
        }
    
        // Sadašnji datum i vreme
        $now = Carbon::now();
    
        // Dato vreme koje želimo da uporedimo
        $givenDateTime = Carbon::parse($t->created_at);
    
        // Razlika između sadašnjeg datuma i vremena i datog vremena
        $difference = $now->diffForHumans($givenDateTime);
    
        // Broj tema i korisnika
        $topicsAll = Topic::count();
        $topicsMy = Topic::where("owner_id", $t->owner_id)->count();
        $topicAverage = ($topicsAll > 0) ? ($topicsMy / $topicsAll) * 100 : 0;
    
        $usersAll = User::count();
        $usersMy = $t->followers->count();
        $usersAverage = ($usersAll > 0) ? ($usersMy / $usersAll) : 0;
    
        // Povratak view-u sa statistikama
        return view('statistic')->with([
            'topic' => $t,
            'ua' => $usersAverage,
            'ta' => $topicAverage,
            'time' => $difference
        ]);
    }

    public function deleteTopic($id){
        $t = Topic::find($id);
        $t->delete();
        return back()->with('success',"Zahtev je odbijen.");

    }

    public function addNews(Request $r,$id){
        $n = new Newss2();
        $n->content = $r->name;
        $n->owner = "Moderator";
        $n->topic_id = $id;
        $n->save();

        $t = Topic::find($n->topic_id);
        $followers = Topic::find($n->topic_id)->followers()->get();
        foreach ($followers as $f) {
            # code...
        event(new MessageFromModerator("Stigla je nova vest od moderatora teme ".$t->name.".",$f->id));
        }
        

        return back();

    }
    public function addNewsIndex2($id){
        return view('admin.addNews2')->with("t",$id);
    }
    public function getNewsFromMyTopics(){
        $news = Newss2::where("topic_id");
    }

    
    

}
