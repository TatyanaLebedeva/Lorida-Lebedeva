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

function resultList() {
    fetch("scripts/result_list.php")
        .then(response => response.text())
        .then(textString => {
            let resultField = document.querySelector(".result");
            resultField.innerHTML = textString
        })
}
