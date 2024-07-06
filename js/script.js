navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
   navbar.style.backgroundColor = '#222';
   navbar.style.textAlign = 'center';
   

// ==========================================================

   
   navbar.style.display = 'block';
   navbar.style.flexDirection = 'col'; 
   navbar.style.justifyContent = 'center'; 
 
  
}

profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');

}

window.onscroll = () =>{
   navbar.classList.remove('active');
   profile.classList.remove('active');
}

function loader(){
   document.querySelector('.loader').style.display = 'none';
}

function fadeOut(){
   setInterval(loader, 2000);
}

window.onload = fadeOut;

document.querySelectorAll('input[type="number"]').forEach(numberInput => {
   numberInput.oninput = () =>{
      if(numberInput.value.length > numberInput.maxLength) numberInput.value = numberInput.value.slice(0, numberInput.maxLength);
   };
});


// slider script

let circle = document.querySelector('.circle');
let slider = document.querySelector('.slider');
let list = document.querySelector('.list');
let prev = document.getElementById('prev'); 
let next = document.getElementById('next'); 
let items = document.querySelectorAll('.list .item');
let count = items.length; // Change acount to count
let active = 1;
let leftTransform = 0;
let width_item = items[active].offsetWidth;

next.onclick = () => {
    active = active >= count - 1 ? count - 1 : active + 1;
    runCarousel();
}

prev.onclick = () => {
    active = active <= 0 ? 0 : active - 1;
    runCarousel();
}

function runCarousel() {
    prev.style.display = active == 0 ? 'none' : 'block';
    next.style.display = active == count - 1 ? 'none' : 'block';
    let old_active = document.querySelector('.item.active');
    if (old_active) old_active.classList.remove('active');
    items[active].classList.add('active');
    leftTransform = width_item * (active - 1) * -1;
    list.style.transform = `translateX(${leftTransform}px)`; // Change leftTransform to transform
}

runCarousel();

let textCircle = circle.innerText.split('');
circle.innerText = '';
textCircle.forEach((value, key) => {
  let newSpan = document.createElement('span');
  newSpan.innerText = value;
  let rotateThisSpan = (360 / textCircle.length) * (key + 1);
  newSpan.style.setProperty('--rotate', rotateThisSpan + 'deg');
  circle.appendChild(newSpan); 
});











// cursore snow animation

document.querySelector('.heading').onmousemove = (e) => {
   let headingDiv = document.querySelector('.heading');
   let snow = document.createElement('h4');
   snow.classList.add('h4-snow');  
   let x = e.pageX - headingDiv.offsetLeft;
   let y = e.pageY - headingDiv.offsetTop;
   let size = Math.random() * 50;

   snow.style.left = x + 'px';
   snow.style.top = y + 'px';
   snow.style.width = size + 'px';
   snow.style.height = size + 'px';
   headingDiv.appendChild(snow);

   setTimeout(() => {
       snow.remove();
   }, 2000);
};





//================================


//     function resetForm() {
//         document.querySelector('form').reset();
//     }
// //========================================

  

