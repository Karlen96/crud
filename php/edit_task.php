<?php

	if(!isset($_GET['val'])||!isset($_GET['id'])){
		header('location:../index.php');
		exit();
	}

	$value = $_GET['val'];
	$id = $_GET['id'];


	require_once('conectdb.php');

	$query = "UPDATE `tasks` SET `task`= '$value' WHERE `id` = $id";
	$result = mysqli_query($link,	$query);
	if($result){
		mysqli_close($link);
		echo 'success';
		exit();
	}
	echo 'error';


