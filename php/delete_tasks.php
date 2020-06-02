<?php

$allchecked = $_GET['all_checked'];

if($allchecked =='true'){
	require_once('conectdb.php');
	$query ="DELETE FROM tasks";
	$result = mysqli_query($link, $query);
	echo 'success';
}




