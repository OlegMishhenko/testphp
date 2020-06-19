
<?php
  //Удаляем, если что
  if (isset($_GET['del_post'])) {
		$sql = mysqli_query($link, "DELETE FROM `posts` WHERE `id` = {$_GET['del_post']}");
		$sql2 = mysqli_query($link, "DELETE FROM `comments` WHERE `post_id` = {$_GET['del_post']}");
    if ($sql) {
      echo "<script>window.location.href='/'</script>";
    } else {
      echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
    }
  }
?>

<?php
  //Если переменная comment передана
  if (isset($_POST["title"])) {
		$sql = mysqli_query($link, "INSERT INTO `posts` (`title`, `content`, `category_id`, `added`) VALUES ('{$_POST['title']}', '{$_POST['content']}','{$_POST['category_id']}', '{$_SESSION['login']}')");
    //Если вставка прошла успешно
    if ($sql) {
      echo "<script>window.location.href='".$_SERVER['REQUEST_URI']."'</script>";
    } else {
      echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
		}
  }
?>

<?php
if (isset($_POST["restitle"])) {
	if (isset($_GET['red_post'])) {
	$sql = mysqli_query($link, "UPDATE `posts` SET `title` = '{$_POST['restitle']}', `content` = '{$_POST['rescontent']}', `category_id` = '{$_POST['rescategory_id']}' WHERE `id`={$_GET['red_post']}");
	echo "<script>window.location.href='/post.php?post_id=".$post['id']."'</script>";
};};
?>

<?php
//Если передана переменная red_id, то надо обновлять данные. Для начала достанем их из БД
    if (isset($_GET['red_post'])) {
      $sql = mysqli_query($link, "SELECT `id`, `title`, `content`, `category_id`, `added` FROM `posts` WHERE `id`={$_GET['red_post']}");
			$product = mysqli_fetch_array($sql);
    }
?>