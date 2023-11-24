<?php

require_once 'Databases.php';
require_once 'Calculator.php';
session_start();

$database = new Databases();
$calculator = new Calculator();
if (isset($_REQUEST['n1']) && isset($_REQUEST['n2'])) {
    if (!is_numeric($_REQUEST['n1'])) {
        $_SESSION['result'] = "Первое значение не является числом!<br>";
        echo "Первое значение не является числом!<br>";
    }
    if (!is_numeric($_REQUEST['n2'])) {
        $_SESSION['result'] = "Второе значение не является числом!<br>";
        echo "Второе значение не является числом!<br>";
    }
    if (is_numeric($_REQUEST['n1']) && is_numeric($_REQUEST['n2'])) {
        $_SESSION["n1"] = $_REQUEST["n1"];
        $_SESSION["n2"] = $_REQUEST["n2"];
        $_SESSION["op"] = $_REQUEST["op"];
        list($action, $result) = $calculator->calculate($_REQUEST['n1'], $_REQUEST['n2'], $_REQUEST['op']);
        $_SESSION['result'] = $result;
        echo $result . '<br>';
        if ($action) {
            $database->addAction($_REQUEST['n1'], $action, $_REQUEST['n2'], $result);
        }
    }
}
