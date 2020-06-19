<?php

require_once 'database.php';

$countView = 5; // количество материалов на странице
// номер страницы
if(isset($_GET['page'])){
    $pageNum = (int)$_GET['page'];
}else{
	
    $pageNum = 1;
}
$startIndex = ($pageNum-1)*$countView; // с какой записи начать выборку
// запрос к бд
$sql = mysqli_query($link, "
    SELECT SQL_CALC_FOUND_ROWS * FROM `posts` LIMIT $startIndex, $countView
") or die(mysqli_error());
$newsData = array();
while($result = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
    $newsData[] = $result;
}
// получение полного количества новостей
$sql2 = mysqli_query($link, "SELECT FOUND_ROWS()");
$result2 = mysqli_fetch_array($sql2, MYSQLI_ASSOC);
$countAllNews = $result2["FOUND_ROWS()"];
// номер последней страницы
$lastPage = ceil($countAllNews/$countView);