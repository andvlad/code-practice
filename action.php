<?php
include("dbconnect.php");
header("Content-type: text/html; charset=windows-1251");

if($_GET['answer']){
	$answer = $_GET['answer'];
	$answer = addslashes($answer);
	$answer = htmlspecialchars($answer);
	$answer = stripslashes($answer);
	$answer = mysql_real_escape_string($answer);
	
	$arrayips = $mysqli->query("SELECT * FROM ip WHERE ip = '$_SERVER[REMOTE_ADDR]'",$db);
	$ip = $mysqli->fetch_array($arrayips);
	
	if(empty($_COOKIE['opros']) || ($_COOKIE['opros']) == '' || empty($ip['id'])){
	
	$result = $mysqli->query("UPDATE answers SET result = result+1 WHERE id='$answer'",$db);
		if($result == true){
			setcookie("opros", $answer, time()+9999999);
			$mysqli->query("INSERT INTO ip (ip) VALUES ('$_SERVER[REMOTE_ADDR]')",$db);
			echo 1; //»зменени€ сохранены			
		}
		else{
			echo 0; //не сохранены
		}
	}else{
		echo 0; //не сохранены
	}
}
?>