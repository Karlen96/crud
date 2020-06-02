<?php

	$str = $_GET['checked_li'];

	$arr = explode(' ',$str);

	require_once('conectdb.php');

	for($i=0;$i<count($arr);$i++){
		$query = "DELETE FROM `tasks` WHERE id=".$arr[$i];
		mysqli_query($link,	$query);
	}
	mysqli_close($link);
	echo 'success';