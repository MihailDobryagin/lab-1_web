<?php

function check($x, $y, $r)
{
    return check1($x, $y, $r) || check3($x, $y, $r) || check4($x, $y, $r);
}

function check1($x, $y, $r)
{
    return $y >= 0 && $x >= 0 && ($y <= -2 * $x + $r);
}

function check3($x, $y, $r)
{
    return -$r / 2.0 <= $y && $y <= 0 && -$r <= $x && $x <= 0;
}

function check4($x, $y, $r)
{
    return $y <= 0 && ($y * $y + $x * $x <= $r * $r);
}

//echo '{"oo" : ["O", "OO"]}';
//echo '{"results" : [{"x" : "1", "y" : "1", "r" : "1", "curTime" : "11", "execTime" : "11", "result" : "+"}]}';


function checkX($x)
{
    $x =(double)$x;
    return is_double($x) && ($x == -2 || $x == -1.5 || $x == -1 || $x == -0.5 || $x == 0 || $x == 0.5 || $x == 1 || $x == 1.5 || $x == 2 || $x == 2.5);
}

function checkR($r)
{
    $r = (double)$r;
    return is_double($r) && ($r == 1 || $r == 1.5 || $r == 2 || $r == 2.5 || $r == 3);
}

function checkY($y)
{
    $y = (double)$y;
    return is_double($y) && $y >= -5 && $y <= 5;
}

function checkXArr($X)
{
    foreach ($X as $x) {
        if(!checkX($x))
            return false;
    }

    return true;
}

$X = $_GET["x"];
$y = $_GET["y"];
$r = $_GET["r"];

try {
    if (!(checkXArr($X) && checkY($y) && checkR($r)))
        die(header("HTTP/1.0 400 Bad Request"));
}catch (Exception $e)
{
    die(header("HTTP/1.0 400 Bad Request"));
}

$curTime = date("H:i:s", time() - $_GET["curTime"] * 60);


$results = '';


foreach ($X as $x)
{
    $result_bool = check($x, $y, $r);

    $executionTime = round(microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"], 7);

    $newRow = '<tr>';
    $newRow .= '<td class="input_data_column">' . $x . '</td>';
    $newRow .= '<td class="input_data_column">' . $y . '</td>';
    $newRow .= '<td class="input_data_column">' . $r . '</td>';
    $newRow .= '<td class="time_column">' . $curTime . '</td>';
    $newRow .= '<td class="time_column">' . $executionTime . '</td>';
    $newRow .= '<td class="result_column"> <img src="img/' . ($result_bool == '+' ? 'tick' : 'cross') . '.svg" /> </td>';
    $newRow .= '</tr>';

    $results .= $newRow;

}

echo $results;
