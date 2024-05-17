 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/index.css') }}">
    <title>PIA</title>
</head>
<body> 
    @extends('layout.index')
    @section('content')
        <div id='reg-container'>
            <div id='reg-container-inner'>
                <h1>Registracija</h1>
                <div id='form'>
                    <form action="{{ route('register_user') }}" method='post' enctype="multipart/form-data">
                            @csrf
                       <div class='dupli'>
                        <div class='labelinput'>
                                <i class='bx bxs-user-rectangle' ></i>
                                <input type='text' placeholder='Ime' id='firstname' name='firstname'></input>
                        </div>
                        <div class='labelinput'>
                                
                                <input type='text'placeholder='Prezime' id='lastname' name='lastname'></input>
                        </div>
                       </div>
                       <div class='labelinput'>
                                <i class='bx bx-envelope' ></i>
                                <input type='email'placeholder='Email' id='email' name='email'></input>
                        </div>
                        <div class='dupli'>
                        <div class='labelinput'>
                                <i class='bx bx-location-plus' ></i>
                                <input type='text' placeholder='Drzava rodjenja' id='country' name='country'></input>
                        </div>
                        <div class='labelinput'>
                                <input type='text'placeholder='Grad rodjenja' id='city' name='city'></input>
                        </div>
                       </div>
                       <div class='labelinput'>
                            <i class="ri-calendar-event-line"></i>
                                <input type='text'placeholder='Datum rodjenja' id='dateofbirth' name='dateofbirth'></input>
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
                                <input type='text'placeholder='JMBG' name='JMBG'></input>
                       </div>
                       <div class='labelinput'>
                            <i class='bx bx-phone' ></i>
                                <input type='text'placeholder='Broj telefona' name='phone'></input>
                       </div>
                       
                       <div class='labelinput'>
                            <i class="ri-lock-line"></i>
                                <input type='password'placeholder='Lozinka' name='password'></input>
                       </div>
                      
                        <div class='labelinput'>
                           <div>
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
                        <button type='submit'>Registruj se</button>
                       
                    </form>
                </div>
            </div>
        </div>    
        <script>

        function change(){
            
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
}
        </script>
        @endsection
     </body>
    </html> 