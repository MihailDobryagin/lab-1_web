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



$X = $_GET["x"];
$y = $_GET["y"];
$r = $_GET["r"];

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