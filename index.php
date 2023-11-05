<?php
if (isset($_REQUEST['number1']) && isset($_REQUEST['number2'])) {
    if (!is_numeric($_REQUEST['number1'])) {
        echo "Первое значение не является числом!\n";
    }
    if (!is_numeric($_REQUEST['number2'])) {
        echo "Второе значение не является числом!\n";
    }
    if (is_numeric($_REQUEST['number1']) && is_numeric($_REQUEST['number2'])) {
        echo(calc($_REQUEST['number1'], $_REQUEST['number2'], $_REQUEST['operation']));
    }
    }
function calc($number1, $number2, $operation)
{
    $result = '';
    if ($operation === 'addition') {
        $result = $number1 + $number2;
    } else if ($operation === 'subtraction') {
        $result = $number1 - $number2;
    } else if ($operation === 'multiplication') {
        $result = $number1 * $number2;
    } else if ($operation === 'division') {
        if ($number2 == 0) {
            $result = 'на 0 делить нельзя';
        } else {
            $result = $number1 / $number2;
        }
    }
    return $result;
}
?>
<html lang="ru">
<head>
    <title>Калькулятор</title>
</head>
<body>
<form method="POST">
    <br>
    <label>
        <input type="text" placeholder="Введите первое число" name="number1">
    </label>
    <br>
    <br>
    <label>
        <select name="operation">
            <option value="multiplication">Умножить</option>
            <option value="division">Разделить</option>
            <option value="addition">Сложить</option>
            <option value="subtraction">Вычесть</option>
        </select>
    </label>
    <br>
    <br>
    <label>
        <input type="text" placeholder="Введите второе число" name="number2">
    </label>
    <br>
    <br>
    <div>
        <input type="submit" value="Вычислить">
    </div>
</form>
</body>
</html>