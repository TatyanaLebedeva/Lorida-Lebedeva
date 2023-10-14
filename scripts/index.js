let menuBtn = document.querySelector('.burger__btn');
let menu = document.querySelector('.menu');
menuBtn.addEventListener('click', function(){
    menu.classList.toggle('active');
})

let menuActive = document.querySelector('.menu__section');
menuActive.addEventListener('click', function() {
    menu.classList.toggle('active');
})
