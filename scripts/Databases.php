<?php

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