// Definišemo niz regex šablona
var regexPatterns = [
    /^[A-ZŠĐČĆŽ][a-zšđčćž]+$/, // Ime
    /^[A-ZŠĐČĆŽ][a-zšđčćž]+(-[A-ZŠĐČĆŽ][a-zšđčćž]+)*$/, // Prezime
    /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/, // Email
    /^\d{13}$/, // JMBG
    /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/

];
var global = true;

//alert(regexPatterns.length)
var regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/

// Pronalazimo sva input polja koja imaju klasu 'reg'
var regexElements = document.querySelectorAll(".reg");

for (let i = 0; i < regexElements.length; i++) {
    regexElements[i].addEventListener("input", function(e) {
        // Pronalazimo odgovarajući regex šablon za trenutni input
        //var index = parseInt(e.currentTarget.getAttribute('data-regex-index'), 10);
        var regex = regexPatterns[i];

        // Validacija vrednosti input polja
        if (!regex.test(e.currentTarget.value)) {
            e.currentTarget.style.backgroundColor = 'rgb(243, 176, 176)';
            global = false;
        } else {
            e.currentTarget.style.backgroundColor = 'rgb(152, 199, 152)';
            global = true;
        }
    });
    regexElements[i].addEventListener("focusout", function(e) {
        e.currentTarget.style.backgroundColor='white';
    })
}
/*regexElements.forEach(function(element) {
    element.addEventListener("input", function(e) {
        // Pronalazimo odgovarajući regex šablon za trenutni input
        var index = parseInt(e.currentTarget.getAttribute('data-regex-index'), 10);
        var regex = regexPatterns[index];

        // Validacija vrednosti input polja
        if (!regex.test(e.currentTarget.value)) {
            e.currentTarget.style.backgroundColor = 'red';
        } else {
            e.currentTarget.style.backgroundColor = 'green';
        }
    });
});*/
var c = document.querySelector("#country");
var c2 = document.querySelector("#city");
var role = document.querySelector("#role");
role.addEventListener("change",function(){
    console.log("Promenjena rola.");
})

c.addEventListener("change",function(){
    while (c2.options.length) {
        c2.remove(0);
    }
    switch(this.value){
        case "Srbija":
        var opt1 = new Option("Beograd","Beograd");
        var opt2 = new Option("Novi Pazar","Novi Pazar");
        var opt3 = new Option("Nis","Nis");
        c2.add(opt1); c2.add(opt2); c2.add(opt3);
        break;
        case "BiH":
        var opt1 = new Option("Sarajevo","Sarajevo");
        var opt2 = new Option("Tuzla","Tuzla");
        var opt3 = new Option("Mostar","Mostar");
        c2.add(opt1); c2.add(opt2); c2.add(opt3);

        break;
        case "Hrvatska":
        var opt1 = new Option("Zagreb","Zagreb");
       
        c2.add(opt1); 

        break;
        case "Crna Gora":
        var opt1 = new Option("Podgorica","Podgorica");
        var opt2 = new Option("Ulcinj","Ulcinj");
        var opt3 = new Option("Rozaje","Rozaje");
       
        c2.add(opt1); c2.add(opt2); c2.add(opt3);
        

        break;

    default:
        break;
    }
});
function validateForm() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var jmbg = document.getElementById("jmbg");
    var password = document.getElementById("password");
    var isValid = true;
    var form = document.getElementById("form");
    var inputs = form.querySelectorAll('input');
    inputs.forEach(function(input) {
        if (input.value.trim() === '' && input.hasAttribute('name')) {
            isValid = false;
            input.style.backgroundColor = 'rgb(243, 176, 176)';
        }
      
        else {
            input.style.backgroundColor = 'white';
        }
    });
    return isValid;
}


function change(c){
    console.log("Change event detected on countrySelect");

    while (c2.options.length) {
        c2.remove(0);
    }
switch (c.value) {
    case "Srbija":
        var opt1 = new Option("Beograd","Beograd");
        var opt2 = new Option("Novi Pazar","Novi Pazar");
        var opt3 = new Option("Nis","Nis");
        c2.add(opt1); c2.add(opt2); c2.add(opt3);
        break;
    case "Hrvatska":
        var opt1 = new Option("Sarajevo","Sarajevo");
        var opt2 = new Option("Tuzla","Tuzla");
        var opt3 = new Option("Mostar","Mostar");
        c2.add(opt1); c2.add(opt2); c2.add(opt3);

        break;

    default:
        break;
}
}

document.getElementById('form').addEventListener("submit",function(e){
    if(!validateForm()){
        document.getElementById("inc").style.display = "flex";

        return;
    }
    else{
        document.getElementById("loading").style.display='flex';
        document.getElementById("form").submit;
    }
});

function reg(){
     if(!validateForm() || global == false){
         alert(global)

         document.getElementById("form").addEventListener("submit",function(e){
            e.preventDefault();
            document.getElementById("inc").style.display = "flex";
        document.getElementById("loading").style.display='none';

         })
      
    }
    else{
        document.getElementById("loading").style.display='flex';
        document.getElementById("inc").style.display = "none";

        document.getElementById("form").submit();
    }
    
    
    
    
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