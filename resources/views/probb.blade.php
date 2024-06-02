<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/reg.css') }}">
    <title>PIA</title>
</head>
<body> 
    @extends('layout.index')
    @section('content')
    <div id='reg-container-new'>

       <div id="whole">
        <div class="titlee">
            <div id="logoimg"></div>
            <div id="hh"><h1>Registracija</h1></div>
        </div>
        <div class="leftright">
            <div class="left">
                
                    <form action="{{ route('register_user') }}" method='post' enctype="multipart/form-data">
                            @csrf
                       <div class='dupli'>
                        <div class='labelinput'>
                                <i class='bx bxs-user-rectangle' ></i>
                                <input class="reg" type='text' placeholder='Ime' id='firstname' name='firstname'></input>
                        </div>
                        <div class='labelinput'>
                                
                                <input class="reg" type='text'placeholder='Prezime' id='lastname' name='lastname'></input>
                        </div>
                       </div>
                       <div class='labelinput'>
                                <i class='bx bx-envelope' ></i>
                                <input class="reg" type='email'placeholder='Email' id='email' name='email'></input>
                        </div>
                        <div class='dupli'>
                            <div class='labelinput'>
                                    <i class='bx bx-location-plus' ></i>
                                    <select  style="width: 100%;" name="country" id="country">
                                        <option value="" disabled>Izaberi zemlju</option>
                                        <option value="Srbija">Srbija</option>
                                        <option value="BiH">Bosna i Hercegovina</option>
                                        <option value="Hrvatska">Hrvatska</option>
                                        <option value="Severna Makedonija">Severna Makedonija</option>
                                        <option value="Crna Gora">Crna Gora</option>
                                    </select>
    {{--                                 <input type='text' placeholder='Drzava rodjenja' id='country' name='country'></input> --}}
                            </div>
                        
                            <div class='labelinput'>
                                <select  style="width: 100%;" name="city" id="city">
                                    <option value="" disabled>Izaberi grad</option>
                                    <option value="Beograd" >Beograd</option>
                                    <option value="Novi Pazar" >Novi Pazar</option>
                                    <option value="Nis" >Nis</option>
                                   
                                </select>
                            </div>
                           </div>
                           <div class='labelinput'>
                            <i class="ri-calendar-event-line"></i>
                                <input type="date" placeholder='Datum rodjenja' id='dateofbirth' name='dateofbirth'></input>
                       </div>
                       <div class='dupli'>
                        <i class="ri-men-line"></i>
                         <div class='labelinput'>
                                 <input class='radio' type='radio' value='Muški pol' name='gender'><label>Muški pol</label></input>
                         </div>
                         <div class='labelinput'>
                                 <input class='radio' type='radio'value='Ženski pol' name='gender'>Ženski pol</input>
                         </div>
                        </div>
                        <div class='labelinput'>
                            <i class="ri-command-line"></i>
                                <input class="reg" type='text'placeholder='JMBG' name='JMBG'></input>
                       </div>
                       <div class='labelinput'>
                        <i class='bx bx-phone' ></i>
                            <input type='text'placeholder='Broj telefona' name='phone'>
                               
                            </input>
                   </div> 
                    
            </div>
            <div class="right">
                
               
                   
                   
                    
                    <div style="flex-direction: column;" class='labelinput'>
                         
                             <input class="reg" type='password'placeholder='Lozinka' name='password'>
                             </input>
                             <small>Lozinka mora sadrzati najmanje jedno veliko slovo, jedan broj i jedan specijalan znak. </small>
                    </div>
                   
                     <div id="imgs" class='labelinput'>
                        <div >
                            <label for="photo" id='label-photo'><i id='photo2' class='bx bx-add-to-queue'></i>Dodaj svoju fotografiju
                             <input onchange="displayImagePreview()" id="photo" type='file' placeholder='Fotografija' name='photo'></input>
                             </label>
                         </div>
                             <div style="width: 150px; height:150px; border:1px solid black; margin-left:1rem;">
                                 <p id="pp"></p>
                             </div>
                             
                     </div>
                     <div class='labelinput'>
                         <label for="role">Registrujem se kao: </label>

                             <select onchange="change()" id="role" class="role"  name='role' value=''>
                                 <option value="Moderator">Moderator</option>
                                 <option value="Korisnik">Korisnik</option>
                             </select>
                    </div>
                    <div class='labelinputt' id="par">
                        <small id="moderator-text"></small>
                    </div>
                     
                    <div id="loading">
                     <div class="lds-ring"><div></div><div></div><div></div><div>
                            
                     </div></div>
                     <div><p><i>Registracija u toku...</i></p></div> 
                 </div>
                
        </div>
        
                    
            
       </div>
       
       <div id="btn-wrapper">
        
        <button id="registerr" onclick="reg()" type='submit'>Registruj se</button>
        
    </form>
     </div>
    </div>
        <script src="{{asset('javascript/regex.js')}}">

        /* function change(){
            
        }
           function displayImagePreview() {
    var fileInput = document.getElementById('photo');
    var file = fileInput.files[0];
    
    if (file) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            var img = document.createElement('img');
            img.src = e.target.result;
            img.width = 150; // Adjust image width as needed
            img.height = 150; // Adjust image height as needed
            
            var p = document.getElementById('pp');
            p.innerHTML = ''; // Clear existing content
            p.appendChild(img);
        };
        
        reader.readAsDataURL(file);
    }
} */
        </script>
        @endsection
     </body>
    </html> 