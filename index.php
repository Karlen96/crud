<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>crud</title>
	<link rel="stylesheet" href="style/bootstrap.min.css">
	<link rel="stylesheet" href="style/style.css">
</head>
<body>
	<header class="container-fluid header">
		<div class="container">
			<div class="main__bar">
				<h2>TASKS</h2>
				<div class="buttons">
					<button class="btn btn-success add__task">add task</button>
					<button class="btn btn-success delete__task">delete task</button>
					<button class="btn btn-warning cancel">cancel</button>
					<button class="btn btn-danger delete">delete</button>
					<div class="сhoose__all">сhoose__all:<input class="сhoose__all_input" type="checkbox"></div>
				</div>
			</div>
			<div class="task__list">
				<ul class="task__items">
					<?php
					require_once('php/conectdb.php');

					$query ="SELECT * FROM `tasks`";
					$result = mysqli_query($link, $query);
					if ($result) {
						$rows = mysqli_num_rows($result); // количество полученных строк
						for($i = 0;$i<$rows;$i++){
							$arr = mysqli_fetch_row($result);
							echo show_table($arr,$i);
						}
					} else {
						echo "Error: " . $sql . "<br>" . mysqli_error($link);
					}
					mysqli_close($link);

					function show_table($array,$i){
						$str = "
						<li class='task__item'>
							<div class='task__item_left'>
								<span>".($i+1)."</span>
								<div class='text'>
									<h3 data-id=".($array[0]).">".($array[1])."</h3>
									<input class='form-control edit__task_input' data-id=".($array[0])." type='text' placeholder='enter new task'>
								</div>
							</div>
							<div class='task__item_right'>
								<button class='edit__task btn btn-danger' data-id=".($array[0]).">edit</button>
								<button class='btn btn-warning edit__task_cancel'>cancel</button>
								<button class='save__task btn btn-success' data-id=".($array[0]).">save</button>
								<input class='task__item_checkbox' type='checkbox' data-id=".($array[0]).">
							</div>
						</li>
						";
						return $str;
					}
							
					?>
				</ul>

			</div>
		</div>
	</header>
	<!--modals window-->
	<!--add task-->
	<div class="add__form">
		<form action="">
			<div class="form__header">
				<div class="form__close">
					<img src="images/close.svg" alt="">	
				</div>
			</div>
			<div class="form__main">
				<input class="form-control input__task" type="text" placeholder="enter task">
				<button class="btn btn-success add__task_list" type="button">add</button>
			</div>
			<div class="msg">
				<h3></h3>
			</div>
		</form>
	</div>
	<!--/add task-->
	<!--/modals window-->
	<!--scipts=================-->
	<script src="jquery-3.5.1.min.js"></script>
	<script src="script.js"></script>
	<!--/scipts=================-->
</body>
</html>