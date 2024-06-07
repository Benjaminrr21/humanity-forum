<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');
/* Auth::routes(
    [
        'verify'=>true
    ]
    ); */
/* Route::get('/registration', function () {
    return view('registration');
})->name('registration'); */

Route::get('registration',[UserAuthController::class, 'RegForm'])->name('registration');
Route::get('/probb',function(){
    return view("probb");
});
Route::post('/register',[UserAuthController::class,'register_user'])->name('register_user');
Route::post('/change-password/{id}',[UserAuthController::class,'updatePassword'])->name('changeP');
Route::delete('/deleteuser/{id}',[UserAuthController::class,'deleteuser'])->name('deleteuser');
Route::post('/acceptuser/{id}',[UserAuthController::class,'acceptuser'])->name('acceptuser');
Route::post('/accepttopic/{id}',[UserAuthController::class,'acceptTopic'])->name('acceptTopic');
Route::post('/checkcode/{c}',[UserAuthController::class,'checkCode'])->name('checkcode');
Route::get('/wait',[UserAuthController::class,"waitPage"])->name('wait');
Route::get('/login',[UserAuthController::class, 'LoginForm'])->name('login');
Route::post('/login_user',[UserAuthController::class,'login_user'])->name('login_user');
Route::get('logout',[UserAuthController::class,'logout'])->name('logout');
Route::get('change-password',[UserAuthController::class,'changePassword'])->name('change-password');
Route::delete('/delete-user/{idUser}/{idTopic}',[UserAuthController::class,'delete'])->name('delete-user');
Route::get('/all-users',[UserAuthController::class,'getAllUsers'])->name('all-users');
Route::get('/check-email',[UserAuthController::class,'checkEmail'])->name('check-email');

Route::get('/registrations',[UserAuthController::class,'getRegistrationsView'])->name('registrations');


Route::get('/topics',[TopicController::class,'getAll']);
Route::get('/add-topic',[TopicController::class,'topicIndex']);
Route::post('/add-topic-create/{id}',[TopicController::class,'create'])->name('add-topic-create');
Route::get('/topics/{id}',[TopicController::class,'getById'])->name('topic-id');
Route::get('/close-topic/{id}',[TopicController::class,'closeTopic'])->name('close-topic');
Route::get('/open-topic/{id}',[TopicController::class,'openTopic'])->name('open-topic');
Route::post('/follow-topic/{idTopic}/{idUser}',[TopicController::class,'followTopic'])->name('follow-topic');
Route::get('/my-topics/{idUser}',[TopicController::class,'myTopics'])->name('my-topics');
Route::get('/topics-by-moderator/{idModerator}',[TopicController::class,'topicsOfModerator'])->name('topics-by-moderator');
Route::delete('/delete-topic/{id}',[TopicController::class,'deleteTopic'])->name('deletetopic');
Route::get('/alert',[TopicController::class,'alert'])->name('alert');

Route::get('/search',[TopicController::class,'search'])->name('search');
Route::post('/addnews2/{id}',[TopicController::class,'addNews'])->name('add-news2');

Route::get('/add-poll/{id}',[TopicController::class,'addPollIndex'])->name('add-poll');
Route::post('/create-poll/{idT}/{idM}',[TopicController::class,'createPoll'])->name('create-poll');
Route::post('/add-answers/{id}',[TopicController::class,'addAnswers'])->name('add-answers');
Route::get('/poll/{id}',[TopicController::class,'pollWithId'])->name('poll');
Route::delete('/delete-poll/{id}',[TopicController::class,'deletePoll'])->name('delete-poll');

Route::post('/vote',[TopicController::class,'vote'])->name('vote');
Route::post('/addnews',[UserAuthController::class,'addNews'])->name('add-news');
Route::get('/addnews',[UserAuthController::class,'addNewsIndex'])->name("news");
Route::get('/addnews2/{id}',[TopicController::class,'addNewsIndex2'])->name("news2");
Route::get('/news',[UserAuthController::class,'viewNews']);

Route::get('/my-users/{id}',[TopicController::class,'myUsers'])->name('my-users');
//Route::delete('/my-users/{id}', [UserController::class, 'delete']);

Route::post('/add-comment/{idTopic}/{idUser}',[CommentController::class,'addComment'])->name('add-comment');
Route::post('/like-comment/{commentId}',[CommentController::class,'like']);
Route::post('/dislike-comment/{commentId}',[CommentController::class,'dislike']);
Route::post('/add-reply/{cid}/{uid}/{tid}',[CommentController::class,'addReply'])->name('add-reply');
Route::delete('/delete-comment/{id}',[CommentController::class,'delete'])->name('delete-comment');
Route::get('/request-send',[UserAuthController::class,'requestIsSend'])->name('request-is-send');

Route::get('/statistic/{id}',[TopicController::class,'openStatistic'])->name('statistic');