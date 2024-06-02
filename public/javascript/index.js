document.getElementById("log").addEventListener("click",()=>{
    alert("Sss")
})
function see(){
    document.getElementById("loading").style.display='flex';
    
}

var email = document.getElementById("email");
const regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

if(!regex.test(email.value)){
email.style.border = '1px solid red';
}

/*var allElements = document.querySelectorAll('input');
///alert(allElements[2].getAttribute('name'));
allElements.forEach(element => {
    element.addEventListener('input',function(e){
        if(regex.test(e.currentTarget.value)) {
        //console.log(e.currentTarget.style.borderBottom);
        e.currentTarget.style.border = 'none';
         e.currentTarget.style.border='4px solid green';
        }
        else{ */
        //console.log(e.currentTarget.style.borderBottom);
       
      /*    e.currentTarget.style.border = '4px solid red';
        }
        })
});

var links = document.querySelectorAll('.nav-bar ul li a');
//alert(links.length);
for (let i = 0; i < links.length; i++) {
    links[i].addEventListener('click',function(){
        links[i].classList.add('active');
        console.log(links[i].classList);
    })
    
} */
    alert("Aa")

document.getElementById('menu-toggle').addEventListener('click', function() {
    
document.querySelector('.nav-bar').classList.toggle('active');
})

