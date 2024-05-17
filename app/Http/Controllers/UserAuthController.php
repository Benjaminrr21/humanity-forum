<?php

namespace App\Http\Controllers;
use App\Models\User;
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

use App\Mail\EmailMessager;

use App\Models\Newss;

class UserAuthController extends Controller
{
    //
    public function getAllUsers(){
        $users = User::all();
        return view('users.getAll')->with('users',$users);
    }
    public function RegForm()
    {
        return view('register');
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
        $admin = User::find(1);
        
        $requestData = $request->all();
        
        $fileName = time().$request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('images', $fileName, 'public');
        $requestData["photo"] = '/storage/'.$path;
        $requestData['password'] = Hash::make($requestData['password']);
        //$requestData['role_id'] = 1;

            if ($request->role == "Moderator") {
            $requestData['role_id'] = 2;
        } elseif ($request->role == "Korisnik") {
            $requestData['role_id'] = 3;
        } else {
            // Log if an unexpected role is encountered
            \Log::warning('Unexpected role encountered: ' . $request->role);
        }   

        
        \Log::info('Final User Data: ' . json_encode($requestData));

        User::create($requestData);

        //emituj ovaj dogadjaj
      event(new RegisterUser($requestData['email']));
       //Notification::send($admin,new news($requestData['firstname'],$requestData['email'],$requestData['lastname']));
        //return redirect('employee')->with('flash_message', 'Employee Addedd!');
 
        //return back();
        return view('login')->with('msg',"Vas zahtev je poslat administratoru. Uskoro ce vam stici korisnicko ime kojim mozete da se prijavite.");
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
             return view('topics.addTopic');
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
        return back()->with('find', "Uspena promena.");
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
        $requests = User::where('isAccepted',null)->get();
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
        return view('news')->with('news',$news);
    }

}
