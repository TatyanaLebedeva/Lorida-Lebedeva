<?php

class Calculator
{
    public function calculate($number1, $number2, $operation)
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