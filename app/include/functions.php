<?php

function get_categories() {
	global $link;
	$sql = "SELECT * FROM categories";
	$result = mysqli_query($link, $sql);
  $categories = mysqli_fetch_all($result, 1);
	return $categories;
}

function get_posts($limit, $offset) {
	global $link;
	$sql = "SELECT * FROM posts ORDER BY id DESC LIMIT $limit OFFSET $offset";
	$result = mysqli_query($link, $sql);
	$posts = mysqli_fetch_all($result, 1);
	return $posts;
}

function get_post_by_id ($post_id) {
	global $link;
	$sql = "SELECT * FROM posts WHERE id = ".$post_id;

	$result = mysqli_query($link, $sql);
	$post = mysqli_fetch_assoc($result);

	return $post;
}

function generate_code ($length = 8) {
	$string = '';
	$chars = 'abdefhiknrstyzABDEFGHKNQRSTUZ23456789';
	$num_chars = strlen($chars);
	for ($i=0; $i < $length; $i++){
		$string .= substr($chars, rand(1,$num_chars) - 1, 1);
	}
	return $string;
}

function insert_subscriber($email) {
	global $link;
	$email = mysqli_real_escape_string($link, $email);
	//1.Есть ли подписчик в базе
	$query = "SELECT * FROM subscribers WHERE email = '$email'";
	$result = mysqli_query($link, $query);
	if (!mysqli_num_rows($result)) {
		//2.Если нет, то добавляем
		$subscriber_code = generate_code();
		$insert_query = "INSERT INTO subscribers (email, code) VALUES ('$email', '$subscriber_code')";
		$result = mysqli_query($link, $insert_query);
		if($result) {
			return 'created';
		} else {
			return 'fail';
		}
	} else {
		//2.Если есть, то перенапрявляем на главную
		return 'exist';
	}
}

function get_posts_by_category($category_id) {
	global $link;
	$category_id = mysqli_real_escape_string($link, $category_id);
	$sql = 'SELECT * FROM posts WHERE category_id = "'.$category_id.'" ORDER BY id DESC LIMIT 5 OFFSET 0';
	$result = mysqli_query($link, $sql);
	$posts = mysqli_fetch_all($result, 1);
	return $posts;
}

function get_category_title($category_id) {
	global $link;
	$category_id = mysqli_real_escape_string($link, $category_id);
	$sql = 'SELECT title FROM categories WHERE id = "'.$category_id.'"';
	$result = mysqli_query($link, $sql);
	$category = mysqli_fetch_assoc($result);
	return $category['title'];
}

function get_category_title_index($category_id) {
	global $link;
	$category_id = mysqli_real_escape_string($link, $category_id);
	$sql = 'SELECT title FROM categories WHERE id = "'.$category_id.'"';
	$result = mysqli_query($link, $sql);
	$category = mysqli_fetch_assoc($result);
	return $category['title'];
}

// function get_posts($limit, $offset) {
// 	global $link;
// 	$sql = "SELECT * FROM posts LIMIT $limit OFFSET $offset";
// 	$result = mysqli_query($link, $sql);
// 	$posts = mysqli_fetch_all($result, 1);
// 	return $posts;
// }

// Выводим пост
function generation_post ($link, $post_id) {
    $sql = "SELECT * FROM `posts` WHERE `id` = '$post_id'";
    $res = $link -> query($sql);
 
    if ($res -> num_rows === 1) {
        $resPost = $res -> fetch_assoc()?>
        <h1><?= $resPost['title'] ?></h1>
        <p><?= $resPost['content'] ?></p>
        <?php
    }
}

// Выводим Коментарии
function get_comment ($link, $post_id) {
	global $product;
    $sql = "SELECT * FROM `comments` WHERE `post_id` = '$post_id' ORDER BY id DESC LIMIT 10 OFFSET 0";
    $resSQL = $link -> query($sql);
 
    if ($resSQL -> num_rows > 0) {
      while ($resComment = $resSQL -> fetch_assoc()) {
        ?> 
          <div class="comment">
					<div class="com-text">
						<?php 
						  if(!empty($_SESSION['login']) and $_SESSION['login'] == $resComment['added'] and isset($_GET['red_com']) and $_GET['red_com'] == $resComment['id']) {
						  ?>
							  <form method="POST" action="">
                  <textarea class="Add" name="rescomment" type="text"><?=$product['comment']?></textarea>
                  <p><input type="submit" class="log-reg-btn" name="enter" value="Редактировать"> <input type="reset" class="log-reg-btn" value="Вернуть"></p>
                </form>
						  <?php
						  } else {?><?php
								echo $resComment['comment']; }; ?> </div><div class="com-btn">
								<p><?= $resComment['added'] ?></p><?php if(!empty($_SESSION['login']) and $_SESSION['login'] == $resComment['added']) {
								?><div class="posts-red-com"><a href='/post.php?post_id=<?=$post_id?>&red_com=<?=$resComment['id']?>'>Редактировать</a><a href='/post.php?post_id=<?=$post_id?>&del=<?=$resComment['id']?>'>Удалить</a></div></div><?php
							}?>
          </div>
        <?php
      }
    } else {
      ?>
      <p>Комментариев нет</p>
      <?php
    }
}

function get_posts_by_added($added) {
	global $link;
	$added = mysqli_real_escape_string($link, $added);
	$sql = 'SELECT * FROM posts WHERE added = "'.$added.'" ORDER BY id DESC LIMIT 5 OFFSET 0';
	$result = mysqli_query($link, $sql);
	$posts = mysqli_fetch_all($result, 1);
	return $posts;
}

function get_added_login($added) {
	global $link;
	$added = mysqli_real_escape_string($link, $added);
	$sql = 'SELECT login FROM users WHERE login = "'.$added.'"';
	$result = mysqli_query($link, $sql);
	$added = mysqli_fetch_assoc($result);
	return $added['login'];
}

function get_added_login_index($added) {
	global $link;
	$added = mysqli_real_escape_string($link, $added);
	$sql = 'SELECT login FROM users WHERE id = "'.$added.'"';
	$result = mysqli_query($link, $sql);
	$added = mysqli_fetch_assoc($result);
	return $added['login'];
}