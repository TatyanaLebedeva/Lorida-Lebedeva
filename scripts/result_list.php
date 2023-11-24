<?php

require_once 'Databases.php';
$database = new Databases();


echo 'Последние вычисления: <br>';
$res = $database->getListAction();
foreach ($res as $value) {
    $numberOne = rtrim(rtrim($value['number_one'], '0'), '.');
    $numberTwo = rtrim(rtrim($value['number_two'], '0'), '.');
    $result = rtrim(rtrim($value['result'], '0'), '.');
    echo "$numberOne {$value['operation']} $numberTwo = $result <br>";
}
