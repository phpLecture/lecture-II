<?php

//値渡し
function connecter_call_by_value($str) {

	//値渡しの場合
	$connecter = function() use ($str) {
		//makeCounterで定義された$countは初期値 = 0
		//静的スコープ(レキシカルスコープ)解決な為、毎回$count = 0が渡され、インクリメントが反映されない
		$str = $str.$str;
		return $str;
	};//$counterという変数を定義しているので、最後に「;」が必要

	return $connecter;
}



//参照渡し
function connecter_call_by_reference($str) {

	//クロージャは引数以外の変数を、動的スコープでなく静的スコープで解決する
	//レキシカルスコープでファーストクラスオブジェクトの関数
	//ファーストクラスオブジェクトの関数 = オブジェクトとして持ち運べる関数
	//$func = function() {};
	//Rubyでいうと、Procがclosure、Karnel#lambdaがラムダ

	//参照渡しの場合
	$connecter = function() use (&$string, $str) {
		$string = $string.$str;//インクリメント
		return $string;
	};

	return $connecter;
}

function factorial($number) {

	$fact = function() use (&$number,&$num) {
		return $number *= ++$num;
	};

	return $fact;
}

//makeCounter関数を2回実行し、$counterと$counter2に保持
$connecter = connecter_call_by_reference("参照渡し1");
$connecter2 = connecter_call_by_reference("参照渡し2");

//値渡しの実行例
$connecter3 = connecter_call_by_value("値渡し");

$fact = factorial(1);

$N = 5;
// for ($i = 0;$i < $N;$i ++) {
// 	echo "connecter : ".$connecter()."</br>";
// }

// echo "</br>";

// for ($i = 0;$i < $N;$i ++) {
// 	echo "connecter2 : ".$connecter2()."</br>";
// }

// echo "</br>";

// for ($i = 0;$i < $N;$i ++) {
// 	echo "connecter3 : ".$connecter3()."</br>";
// }

// echo "</br>";

// for ($i = 0;$i < $N + 1;$i ++) {
// 	echo "fact : ".$fact()."</br>";
// }

$funcArray = [$connecter, $connecter2, $connecter3, $fact];

for ($i = 0;$i < $N;$i ++) {
	foreach ($funcArray as $row => $func) {
		echo $func()."</br>";
	}
}


//値をそれぞれが保持している = オブジェクトの挙動に似てる

?>