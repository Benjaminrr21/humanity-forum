function display(el){
    var btns = document.getElementsByClassName('user-options');
    for (let i = 0; i< btns.length; i++) {
      btns[i].disabled = true;
      ///if(btns[i].disabled) btns[i].style.color = 'green';
    }
    //alert(el.parentElement.dataset.topicId);
    document.getElementById('seriously').style.display = 'block';   
    document.getElementById('seriously').setAttribute("data-user-id",el.parentElement.dataset.userId)   
    document.getElementById('seriously').setAttribute("data-topic-id",el.parentElement.dataset.topicId)   
}
function hide(){
    document.getElementById("seriously").style.display = 'none';
    var btns = document.getElementsByClassName('user-options');
    
    for (let i = 0; i< btns.length; i++) {
        btns[i].disabled = false;
}

}
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

function deleteUser(el){
var uId = el.parentElement.dataset.userId;
var tId = el.parentElement.dataset.topicId;
sendRequestFromJS("DELETE",`/delete-user/${uId}/${tId}`);

}

///document.getElementById("acc").addEventListener("click",())
    