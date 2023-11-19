<?php
function connectToDB()
{
    $mysqli = new mysqli("localhost", "root", "", "calculator");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }
    return $mysqli;
}

function calc($number1, $number2, $operation)
{
    $result = '';
    if ($operation === 'addition') {
        $action = '+';
        $result = $number1 + $number2;
        addAction($number1, $action, $number2, $result);
    } else if ($operation === 'subtraction') {
        $action = '-';
        $result = $number1 - $number2;
        addAction($number1, $action, $number2, $result);
    } else if ($operation === 'multiplication') {
        $action = '*';
        $result = $number1 * $number2;
        addAction($number1, $action, $number2, $result);
    } else if ($operation === 'division') {
        if ($number2 == 0) {
            $result = 'На 0 делить нельзя';
        } else {
            $action = '/';
            $result = $number1 / $number2;
            addAction($number1, $action, $number2, $result);
        }
    }
    return $result;
}

function addAction($number1, $action, $number2, $result)
{
    $connection = connectToDB();
    $sql = "INSERT INTO calc (number_one, operation, number_two, result) values ($number1, '$action', $number2, $result)";
    $connection->query($sql);
}

function getListAction()
{
    $connection = connectToDB();
    $res = $connection->query("select number_one, operation, number_two, result 
                                        from calc 
                                        order by id desc
                                        limit 7");
    foreach ($res as $value) {
        echo "{$value['number_one']} {$value['operation']} {$value['number_two']} = {$value['result']} <br>";
    }
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
<?php
if (isset($_REQUEST['number1']) && isset($_REQUEST['number2'])) {
    if (!is_numeric($_REQUEST['number1'])) {
        echo "Первое значение не является числом!<br>";
    }
    if (!is_numeric($_REQUEST['number2'])) {
        echo "Второе значение не является числом!<br>";
    }
    if (is_numeric($_REQUEST['number1']) && is_numeric($_REQUEST['number2'])) {
        echo "Результат: " . calc($_REQUEST['number1'], $_REQUEST['number2'], $_REQUEST['operation']) . '<br>';
    }
}
echo 'Последние вычисления: <br>';
getListAction();
?>
</body>
</html>