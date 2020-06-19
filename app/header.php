<?php
session_start();
require_once 'include/database.php';
require_once 'include/functions.php';
require_once 'include/pageNum.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Мой блог</title>

    <link href="public/css/style.css" rel="stylesheet">

</head>
<body>
  <div class="header">
    <div class="container">
		  <div class="user">
			  <div class="logo">
			    <h3><a href="/">Блог</a></h3>
				</div>
				<div class="login-reg">
			  <?php 
				  if(empty($_SESSION['login'])) {?>
					  <div class="reg">
			        <?php include_once 'app/reg.php'; ?>
		        </div>
					  <div class="login">
			        <?php include_once 'app/login.php'; ?>
	          </div>
				    <?php
				  } else {
					  echo "<p>Привет, ".$_SESSION['login']."!</p> <a href='/app/exit.php'>Выход</a>";
				  };
			  ?>
				</div>
		  </div>
    </div>
	</div>
		