<?php

$link = mysqli_connect('localhost','root','1238AaW1i87','my_blog');

if(mysqli_connect_errno())
{
	echo 'Ошибка подключения к базе данных ('.mysqli_connect_errno().'): '.mysqli_connect_error();
	exit();
}