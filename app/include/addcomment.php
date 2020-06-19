
<?php
  //Удаляем, если что
  if (isset($_GET['del'])) {
    $sql = mysqli_query($link, "DELETE FROM `comments` WHERE `id` = {$_GET['del']}");
    if ($sql) {
      echo "<script>window.location.href='/post.php?post_id=".$post['id']."'</script>";
    } else {
      echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
    }
  }
?>

<?php
  //Если переменная comment передана
  if (isset($_POST["comment"])) {
		$sql = mysqli_query($link, "INSERT INTO `comments` (`comment`, `post_id`, `added`) VALUES ('{$_POST['comment']}', '{$_GET['post_id']}', '{$_SESSION['login']}')");
    //Если вставка прошла успешно
    if ($sql) {
      echo '';
    } else {
      echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
		}
  }
?>

<?php
if (isset($_POST["rescomment"])) {
	if (isset($_GET['red_com'])) {
	$sql = mysqli_query($link, "UPDATE `comments` SET `comment` = '{$_POST['rescomment']}' WHERE `id`={$_GET['red_com']}");
	echo "<script>window.location.href='/post.php?post_id=".$post['id']."'</script>";
};};
?>

<?php
//Если передана переменная red_id, то надо обновлять данные. Для начала достанем их из БД
    if (isset($_GET['red_com'])) {
      $sql = mysqli_query($link, "SELECT `id`, `comment`, `added` FROM `comments` WHERE `id`={$_GET['red_com']}");
			$product = mysqli_fetch_array($sql);
    }
?>

<?php
if (!empty($_SESSION['login']) or !empty($_SESSION['id']))
  {
		?>
    <form method="POST" action="">
      <textarea class="Add Add-max" name="comment" required></textarea>
      <p><input type="submit" class="log-reg-btn" name="enter" value="Добавить"> <input type="reset" class="log-reg-btn" value="Очистить"></p>
    </form>
	<?php
	};
?>