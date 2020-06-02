<?php

	if(!isset($_GET['task'])){
		header('location:../index.php');
		exit();
	}

	$task = trim($_GET['task']);

	require_once('conectdb.php');

	$query = "SELECT task FROM `tasks`";

	$result = mysqli_query($link, $query);
	if ($result) {
		$rows = mysqli_num_rows($result); 
		for($i = 0;$i<$rows;$i++){
			$arr = mysqli_fetch_row($result);
			if($arr[0] == $task){
				echo 'такая запись существует';
				exit();
			}
		}
	}

	$sql = "INSERT INTO tasks (task) VALUES ('$task')";
	if (mysqli_query($link, $sql)) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($link);
	}
	mysqli_close($link);


?>