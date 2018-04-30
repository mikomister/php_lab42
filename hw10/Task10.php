<?php
/**
 * Created by PhpStorm.
 * User: Michael Konkov
 * Date: 29.04.18
 * Time: 23:48
 */

require_once "Month.php";
$m = 4;
$y = 2018;
$month = new Month($m, $y);
echo "<b>Day of Week by Number:</b><br>{$month->getDayOfWeekByDayNumber(2)}<br>";

echo "<b>Show $m month:</b>";
$month->showMonth();
echo "<br>";

echo "<b>Show Calendar of the specified year:</b><br>";
$month->showCalendar();
echo "<br>";



