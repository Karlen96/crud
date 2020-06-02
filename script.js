$(function () {
	let addTask = $('.add__task');
	let addForm = $('.add__form');
	let formClose = $('.form__close');
	let inputTask = $('.input__task');
	let addTaskList = $('.add__task_list');
	let deleteTask = $('.delete__task');
	let сhooseAllInput = $('.сhoose__all_input');
	let allChecked = false;
	let editTask = $('.edit__task');
	let savaTask = $('.save__task');

	/**
	 * edit task
	 */
	editTask.on('click', function () {
		let allH3 = $('.task__item h3');
		let editTaskCancel = $('.edit__task_cancel');
		let thisTask = $(this);


		$(thisTask).next().css('display', 'flex');

		for (let i = 0; i < allH3.length; i++) {
			if ($(allH3[i]).attr('data-id') == $(thisTask).attr('data-id')) {
				$(allH3[i]).css('display', 'none');
				$(allH3[i]).next().css('display', 'flex');
				$(savaTask[i]).css('display', 'flex');
				editTaskCancel.on('click', function () {
					$(thisTask).next().css('display', 'none');
					$(allH3[i]).css('display', 'flex');
					$(allH3[i]).next().css('display', 'none');
					$(savaTask[i]).css('display', 'none');
				});
			}
		}

	});
	$(savaTask).on('click', function () {
		let inputVal = $('.edit__task_input');

		for (let i = 0; i < inputVal.length; i++) {
			if ($(inputVal[i]).val().length != 0) {
				if ($(inputVal[i]).attr('data-id') == $(this).attr('data-id')) {
					changeInfo($(inputVal[i]).val(), $(inputVal[i]).attr('data-id'));
				}
			}
		}

		function changeInfo(value, id) {
			$.ajax({
				url: 'php/edit_task.php',
				type: 'get',
				data: {
					val: value,
					id: id
				},
				success: function (data) {
					location.reload();
				}
			});
		}
	});

	/**
	 * add task
	 */
	addTask.on('click', () => {
		addForm.css('display', 'flex');
	});
	formClose.on('click', () => {
		addForm.css('display', 'none');
	});
	deleteTask.on('click', () => {
		$('.task__item_checkbox').css('display', 'block');
		$('.delete__task').css('display', 'none');
		$('.buttons .delete').css('display', 'inline-block');
		$('.buttons .cancel').css('display', 'inline-block');
		$('.сhoose__all').css('display', 'inline-block');
	});
	$('.cancel').on('click', () => {
		$('.delete__task').css('display', 'inline-block');
		$('.task__item_checkbox').css('display', 'none');
		$('.buttons .delete').css('display', 'none');
		$('.buttons .cancel').css('display', 'none');
		$('.сhoose__all').css('display', 'none');
	});
	$(сhooseAllInput).on('input', () => {
		if ($(сhooseAllInput).prop('checked')) {
			$('.task__item_checkbox').prop('checked', true);
			allChecked = true;
		} else {
			$('.task__item_checkbox').prop('checked', false);
			allChecked = false;
		}
	});

	/**
	 * delete task
	 */
	$('.delete').on('click', () => {
		if ($(сhooseAllInput).prop('checked')) {
			$.ajax({
				url: 'php/delete_tasks.php',
				type: 'get',
				data: {
					all_checked: allChecked
				},
				success: function (data) {
					if (data == 'success') {
						location.reload();
					}
				}
			});
		} else {
			const checkedDelete = [];
			let liInput = $('.task__item_checkbox');
			for (let i = 0; i < liInput.length; i++) {
				if ($(liInput[i]).prop('checked')) {
					checkedDelete.push($(liInput[i]).attr('data-id'));
				}
			}
			let str = '';
			for (let i = 0; i < checkedDelete.length; i++) {
				str += checkedDelete[i] + ' ';
			}

			$.ajax({
				url: 'php/delete_task.php',
				type: 'get',
				data: {
					checked_li: str
				},
				success: function (data) {
					if (data == 'success') {
						location.reload();
					}
				}
			});
		}

	});

	/**
	 * add task
	 */
	addTaskList.on('click', function () {
		let value = inputTask.val().trim();
		if (value.length != 0) {
			$.ajax({
				url: "php/check_task.php",
				type: "get",
				data: {
					task: value,
				},
				success: function (data) {
					if (data != 'такая запись существует') {
						location.reload();
					} else {
						$('.msg').text(data);
					}
				}
			});
		} else {
			$('.msg').text('это пустая строка введите что небудь');
		}
	});


});