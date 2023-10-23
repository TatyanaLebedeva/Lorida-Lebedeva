let menuBtn = document.querySelector('.burger__btn');
let menu = document.querySelector('.menu');
menuBtn.addEventListener('click', function(){
    menu.classList.toggle('active');
})

let menuActive = document.querySelector('.menu__section');
menuActive.addEventListener('click', function() {
    menu.classList.toggle('active');
})
// window.addEventListener('scroll', function() {
//     menu.classList.toggle('active');
// })

function calculate(message) {
    let number1 = parseFloat(document.getElementById('number1').value);
    let number2 = parseFloat(document.getElementById('number2').value);
    let operation = document.getElementById('operation').value;
    let result;

    if (operation === 'addition') {
        result = number1 + number2;
    } else if (operation === 'subtraction') {
        result = number1 - number2;
    } else if (operation === 'multiplication') {
        result = number1 * number2;
    } else if (operation === 'division') {
        result = number1 / number2;
    }

    alert("Результат: " + result);
}