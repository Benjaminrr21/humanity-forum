<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Topic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;



use App\Notifications\news;
use App\Events\RegisterUser;
use App\Events\messageUser;
use App\Events\MessageFromAdmin;
use App\Events\TopicAccepted;

use App\Mail\EmailMessager;
use App\Mail\SendCode;
use App\Mail\Deleted;

use App\Models\Newss;
use App\Models\Newss2;
use App\Models\follower;

class UserAuthController extends Controller
{
    //
    public function getAllUsers(){
        $users = User::all();
        return view('users.getAll')->with('users',$users);
    }
    public function RegForm()
    {
        return view('probb');
    }
 
    public function register_user(Request $request)
    {
        /*$user = new User();
 
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->JMBG = $request->JMBG;
        $user->dateofbirth = $request->dateofbirth;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->gender = $request->gender;
        $user->photo = $request->photo;
        $user->phone = $request->phone;
        $user->role_id = 1;

        //if ($request->hasFile('photo')) {
            $fileName = time().$request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('images', $fileName, 'public');
            $user->photo = '/storage/'.$path;
        
 
        $user->save();*/
        //$admin = User::find(1);
        
        $requestData = $request->all();
        
        $fileName = time().$request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('images', $fileName, 'public');
        $requestData["photo"] = '/storage/'.$path;
        $requestData['password'] = Hash::make($requestData['password']);
        //$requestData['role_id'] = 1;

        $code = mt_rand(100000,999999);

        Mail::to($requestData['email'])->send(new SendCode([
            'code'=>$code
        ]));

            if ($request->role == "Moderator") {
            $requestData['role_id'] = 2;
        } elseif ($request->role == "Korisnik") {
            $requestData['role_id'] = 3;
        } else {
            // Log if an unexpected role is encountered
            \Log::warning('Unexpected role encountered: ' . $request->role);
        }   

        
        \Log::info('Final User Data: ' . json_encode($requestData));

        //User::create($requestData);

        //emituj ovaj dogadjaj
      //event(new RegisterUser($requestData['email']));
       //Notification::send($admin,new news($requestData['firstname'],$requestData['email'],$requestData['lastname']));
        //return redirect('employee')->with('flash_message', 'Employee Addedd!');
        $user = new User();
        $user->firstname = $requestData['firstname'];
        $user->lastname = $requestData['lastname'];
        $user->JMBG = $requestData['JMBG'];
        $user->dateofbirth = $requestData['dateofbirth'];
        $user->country = $requestData['country'];
        $user->city = $requestData['city'];
        $user->email = $requestData['email'];
        $user->password = $requestData['password'];
        $user->gender = $requestData['gender'];
        $user->photo = $requestData['photo'];
        $user->phone = $requestData['phone'];
        $user->role_id = $requestData['role_id'];
    
        // Čuvanje korisnika u bazi
        $user->save();
        //return back();
        //return view('login')->with(['msg'=>"Vas zahtev je poslat administratoru. Uskoro ce vam stici korisnicko ime kojim mozete da se prijavite.","code"=>$code]);
        return view("wait")->with(['msg'=>"Poslat je šestocifreni kod za registraciju.","code"=>$code,"user"=>$user]);
    }
    public function waitPage(){
        return view("wait");
    }
 
    public function LoginForm()
    {
        return view('login');
    }
 
    public function login_user(Request $request)
    {
        $credetials = [
            'username' => $request->username,
            'password' => $request->password,
        ];
 
        if (Auth::attempt($credetials)) {
            //return redirect('/home')->with('success', 'Login Success');
           if(Auth::user()->role_id==2)
             return view('topics.addTopic')->with("num",Auth::user()->myTopics()->count());
            return view('home');
            
        }
 
        return back()->with('message',"Korisničko ime ili lozinka nisu pravilno uneti.");
        //return back()->with('error', 'Error Email or Password');
    }
 
    /*public function logout()
    {
        Auth::logout();
 
        return redirect()->route('login');
    }*/
    public function logout(){
        Session::flush();
        Auth::logout();

        return redirect('home');
    }
    public function delete($idUser,$idTopic){
        $user = User::find($idUser);
        $user->following()->detach($idTopic);
        //$user->delete();
        $user->save();
        return redirect()->route('delete-user');        
    }
    public function delete_all($idUser,$idModerator){
        $user = User::find($idUser);
        foreach ($user->following as $t) {
            if($t->owner_id == $idModerator){
                $user->following()->detach($t->id);
            }
        }
        //$user->delete();
        $user->save();
        return back();       
    }
    public function changePassword(){
        return view('changePassword');
    }
    public function updatePassword(Request $request, $id){
        //$u = User::where('email',$request->email)->first();
        User::whereId($id)->update([
            'password' => Hash::make($request->newPassword)
        ]);
        /*if($u) {
            return back()->with('find',$u->id);
        }*/
        return view('login')->with('find', "Uspešna promena. Unesite podatke za prijavu.");
        /* $user = User::find($id);
        $user->password = Hash::make($r->newPassword);
        $user->save();
        return back()->with('success','Uspesna promena lozinke.'); */
    }
    public function checkEmail(Request $request){
        $u = User::where('email',$request->email)->first();
       
        if($u) {
            return back()->with('find',$u->id);
        }
        return back()->with('not-found','Žao nam je, nismo pronašli vaš email. Pokušajte ponovo.'); // Redirect back with a message

    }


    //FOR ADMIN
    public function getRegistrationsView(){
        $requests = Topic::where('isAccepted',0)->get();
        return view('admin.registrations')->with('requests',$requests);
    }
    public function requestIsSend(){
        return view('login')->with('msg','Vas zahtev je poslat administratoru na odobravanje. Uskoro ce vam stici korisnicko ime kojim cete moci da se ulogujete na sistem.');
    }
    public function deleteuser($id){
        $u = User::find($id);
        //$notification = DatabaseNotification::where('data->email', $email)->first();
       // $notification->delete();
        $u->delete();

        Mail::to($u->email)->send(new EmailMessager([
            'name' => "Vas zahtev za registraciju je odbijen."
        ]));
        return back()->with('success',"Zahtev je odbijen.");

    }
    
    public function acceptuser($id){
         $u = User::find($id);
        $niz = ["#", "_"];
        $ime = Str::lower($u->firstname);
        $randomNumber = mt_rand(0, 1000);
        $randomSpecialCharIndex = mt_rand(0, count($niz) - 1);
        $randomSpecialChar = $niz[$randomSpecialCharIndex];
    
        $loginname = $ime . $randomSpecialChar . $randomNumber;
    
        $u->isAccepted = 1;
        $u->username = $loginname;
        $u->save();
    
        //event(new messageUser("Vaš zahtev je prihvaćen."));
        Mail::to($u->email)->send(new EmailMessager([
            'name' => $u->name,
            'username' => $loginname
        ]));

        return back()->with('success',"Zahtev je odobren.");

    }
    public function acceptTopic($id){
        $t = Topic::find($id);
        $t->isAccepted = 1;
        $t->save();
        //event(new TopicAccepted($t->name,"Vasa tema je odobrena."));
        
        $moderatorId = $t->owner_id; // Pretpostavljam da imate moderator_id kolonu u tabeli topics
        event(new TopicAccepted($t->name, "Vasa tema" .$t->name. "je odobrena.", $t->owner_id));

        return back()->with('success',"Zahtev je odobren.");

    }
    public function addNews(Request $r){
        $n = new Newss();
        $n->content = $r->name;
        $n->owner = "Admin";
        $n->save();
        event(new MessageFromAdmin($n->content));

        return back()->with('correct',"Poslato je svim korisnicima.");

    }
    public function addNews2(Request $r){
        $n = new Newss();
        $n->content = $r->name;
        $n->owner = "Moderator";
        $n->save();
        event(new MessageFromModerator($n->content));

        return back()->with('correct',"Poslato je svim korisnicima.");

    }
    public function addNewsIndex(){
        return view('admin.addNews');
    }
    public function viewNews(){
        $news = Newss::all();
        $news2 = Newss2::all();
        $topics = Topic::all();
        $followers = follower::all();
        return view('news')->with(['news'=>$news,'news2'=>$news2,'topics'=>$topics,'followers'=>$followers]);
    }
    public function get_users_view(){
        $users = User::all();
        return view('all_users')->with('users',$users);
    }
    public function delete_user_classic($id){
        $u = User::find($id);
        $u->delete();
        Mail::to($u->email)->send(new Deleted());
        return back();
    }

}
