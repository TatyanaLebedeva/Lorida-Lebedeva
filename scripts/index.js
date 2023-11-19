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

function openModal() {
    document.getElementById("result_window").style.display = "flex"
}

function closeModal() {
    document.getElementById("result_window").style.display = "none"
}
function calculate() {
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

    document.getElementById("result").textContent = result;
    openModal();
}

function calc() {
    let number1 = document.getElementById('number1').value;
    let number2 = document.getElementById('number2').value;
    let operation = document.getElementById('operation').value;

    fetch("scripts/index.php?n1=" + number1 + "&n2=" + number2 + "&op=" + operation)
        .then(response => response.text())
        .then(textString => {
            let resultField = document.querySelector(".result");
            resultField.innerHTML = "Результат: " + textString
        })
}
