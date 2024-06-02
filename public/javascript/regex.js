// Definišemo niz regex šablona
var regexPatterns = [
    /^[A-ZŠĐČĆŽ][a-zšđčćž]+$/, // Ime
    /^[A-ZŠĐČĆŽ][a-zšđčćž]+(-[A-ZŠĐČĆŽ][a-zšđčćž]+)*$/, // Prezime
    /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/, // Email
    /^\d{13}$/, // JMBG
    /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/

];

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
        } else {
            e.currentTarget.style.backgroundColor = 'rgb(152, 199, 152)';
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



function reg(){
    document.getElementById("loading").style.display='flex';
    
}