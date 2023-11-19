<?php
if (isset($_REQUEST['n1']) && isset($_REQUEST['n2'])) {
    if (!is_numeric($_REQUEST['n1'])) {
        echo "Первое значение не является числом!<br>";
    }
    if (!is_numeric($_REQUEST['n2'])) {
        echo "Второе значение не является числом!<br>";
    }
    if (is_numeric($_REQUEST['n1']) && is_numeric($_REQUEST['n2'])) {
        echo calc($_REQUEST['n1'], $_REQUEST['n2'], $_REQUEST['op']) . '<br>';
    }
}
echo 'Последние вычисления: <br>';
getListAction();

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
