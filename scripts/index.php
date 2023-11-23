<?php
$database = new Databases();
if (isset($_REQUEST['n1']) && isset($_REQUEST['n2'])) {
    if (!is_numeric($_REQUEST['n1'])) {
        echo "Первое значение не является числом!<br>";
    }
    if (!is_numeric($_REQUEST['n2'])) {
        echo "Второе значение не является числом!<br>";
    }
    if (is_numeric($_REQUEST['n1']) && is_numeric($_REQUEST['n2'])) {
        list($action, $result) = new Calculator($_REQUEST['n1'], $_REQUEST['n2'], $_REQUEST['op']);
        echo $result . '<br>';
        if ($action) {
            $database->addAction($_REQUEST['n1'], $action, $_REQUEST['n2'], $result);
        }
    }
}
echo 'Последние вычисления: <br>';
$res = $database->getListAction();
foreach ($res as $value) {
    echo "{$value['number_one']} {$value['operation']} {$value['number_two']} = {$value['result']} <br>";
}

class Calculator
{
    public function __construct($number1, $number2, $operation)
    {
        return $this->calculate($number1, $number2, $operation);
    }

    private function calculate($number1, $number2, $operation)
    {
        $result = '';
        $action = '';
        if ($operation === 'addition') {
            $action = '+';
            $result = $number1 + $number2;
        } else if ($operation === 'subtraction') {
            $action = '-';
            $result = $number1 - $number2;
        } else if ($operation === 'multiplication') {
            $action = '*';
            $result = $number1 * $number2;
        } else if ($operation === 'division') {
            if ($number2 == 0) {
                $result = 'На 0 делить нельзя';
            } else {
                $action = '/';
                $result = $number1 / $number2;
            }
        }
        return [$action, $result];
    }
}


class Databases
{
    public function addAction($number1, $action, $number2, $result)
    {
        $connection = $this->connectToDB();
        $sql = "INSERT INTO calc (number_one, operation, number_two, result) values ($number1, '$action', $number2, $result)";
        $connection->query($sql);
    }

    public function getListAction()
    {
        $connection = $this->connectToDB();
        return $connection->query("select number_one, operation, number_two, result
                                        from calc
                                        order by id desc
                                        limit 7");
    }

    private function connectToDB()
    {
        $mysqli = new mysqli("localhost", "root", "", "calculator");
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }
        return $mysqli;
    }
}
