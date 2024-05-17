
var p1 = document.getElementById('p1');
var p2 = document.getElementById('p2');
var pb = document.getElementById("progress-bar");
var mt = document.getElementById('match-text');

p2.addEventListener('input',(e)=>{
    //alert('aaa');
    pb.style.display = 'none';
    if(e.currentTarget.value != p1.value){
        e.currentTarget.style.backgroundColor = '#ff8164';
        mt.style.display = 'block';
        mt.innerHTML = 'Lozinke se ne poklapaju.';
    }
    else
       e.currentTarget.style.backgroundColor = '#abf7b1';
       mt.style.display = 'none';
       
})
p1.addEventListener('input',(e)=>{
    pb.style.visibility = 'visible';
    
    if(e.currentTarget.value.length <= 3){
         pb.style.backgroundColor = '#660000';
         pb.innerHTML = 'Slabo';
    }
    if(e.currentTarget.value.length >= 4 || e.currentTarget.value <= 7){
         pb.style.backgroundColor = '#ff7f50';
         pb.innerHTML = 'Srednje';

    }
         if(e.currentTarget.value.length >= 8){
              pb.style.backgroundColor = 'green';
              pb.innerHTML = 'Jako';

         }
            })