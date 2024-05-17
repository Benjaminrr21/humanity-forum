function sendRequestFromJS(method,route){
    console.log(route);
    var xhr = new XMLHttpRequest();
    //xhr.open("POST",`/like-comment/${commentId}`,true);
    xhr.open(method,route,true);
    xhr.setRequestHeader("Content-Type","application/json");
    xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
  
  
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Obrada uspešnog odgovora od servera
            var response = JSON.parse(xhr.responseText);
            console.log("Komentar lajkovan. Novi broj lajkova: " + response.likesCount);
            // Možete ažurirati UI da prikažete novi broj lajkova
        } else {
            // Obrada greške
            console.error("Došlo je do greške prilikom lajkovanja komentara.");
        }
    };
    
    // Pripremamo podatke koje ćemo poslati
    var data = JSON.stringify({
        // Možete poslati dodatne informacije ako je potrebno
    });
    
    // Šaljemo zahtev
    xhr.send(data);
  
    location.reload();
  }