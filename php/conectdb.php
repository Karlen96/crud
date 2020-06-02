<?php 

$link = mysqli_connect('localhost','root','','crud');
					
if(mysqli_connect_errno()){
	echo 'error to conect database('.mysqli_connect_errno().'):'.mysqli_connect_error();
	exit();
}