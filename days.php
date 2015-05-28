<?php

$year = $_GET["year"];
$month = $_GET["month"];
$day = $_GET["day"];

echo $year."年 ".$month."月 ".$day."日 ";

function getDays() {

	global $year, $month, $day;

	if ($month == 1 || $month == 2) {
		$year -= 1;
		$month += 13;
	} else {
		$month += 1;
	}

	$x = (int)(365.25*$year) + (int)(30.6*$month) + (int)($year/400) + $day - (int)($year/100) - 429;
	$x -= (int)($x/7) * 7;

	$days = ["月曜日","火曜日","水曜日","木曜日","金曜日","土曜日","日曜日"];
	
	return $days[$x];
}

echo getDays();

?>