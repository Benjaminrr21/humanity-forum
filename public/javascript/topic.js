var likes = document.getElementsByClassName("ri-thumb-up-line");
        var dislikes = document.getElementsByClassName("ri-thumb-down-line");
        var labels = document.getElementsByClassName("ll");

        for (let i = 0; i < likes.length; i++) {
            likes[i].addEventListener('click',(e)=>{
                
                    e.currentTarget.style.color = 'blue';
                    document.getElementById("l").innerHTML= parseInt(document.getElementById("l").innerHTML)+1;
                   
           // alert(e.parentElement);
            })
        }
         for(let i = 0; i < dislikes.length; i++) {
            dislikes[i].addEventListener('click',(e)=>{
            //e.currentTarget.style.transform = 'scaleY(2.8)';
            document.getElementById("d").innerHTML= parseInt(document.getElementById("d").innerHTML)+1;
            
                    e.currentTarget.style.color = 'blue';
                
            })
         }
         for(let i = 0; i < labels.length; i++) {
            labels[i].addEventListener('click',(e)=>{
            //e.currentTarget.style.transform = 'scaleY(2.8)';
            e.currentTarget.style.transition = '0.5s';
            })
        } 
        /* document.getElementById('like').addEventListener("click",(e)=>{
            //e.currentTarget.style.transform = 'scaleY(2.8)';
            e.currentTarget.style.color = 'blue';
        })
        document.getElementById('dislike').addEventListener("click",(e)=>{
            //e.currentTarget.style.transform = 'scaleY(2.8)';
            e.currentTarget.style.color = 'blue';
        }) */
        function sendRequestFromJS(method,route){
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
        }
        function likeComment(el) {
            //console.log(el.style.color)
            var commentId = el.parentElement.dataset.commentId;
            sendRequestFromJS("POST",`/like-comment/${commentId}`,true);
        
      
        }
        function dislikeComment(el) {
            var commentId = el.parentElement.dataset.commentId;
            sendRequestFromJS("POST",`/dislike-comment/${commentId}`,true);
        
      
        }
        
        
        
        
        
        
        
            //alert(commentId);
            /*var xhr = new XMLHttpRequest();
            xhr.open("POST",`/like-comment/${commentId}`,true);
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
        
            // Pozivanje AJAX funkcije sa commentId
            // ...
        */
       

    