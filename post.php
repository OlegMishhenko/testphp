<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'app/header.php';

$post_id = $_GET['post_id'];
if (!is_numeric($post_id)) {
	exit();
}

//Получаем массив поста
$post = get_post_by_id($post_id);
$categories = get_categories();

include_once 'app/include/addpost.php';
?>

<div class="container">
	<div class="one-post">
		<?php if(!empty($_SESSION['login']) and $_SESSION['login'] == $post['added']) {
			?> 
			<div class="posts-red">
			<p><a href='/post.php?post_id=<?=$post['id']?>&red_post=<?=$post['id']?>'>Редактировать</a> 
				 <a href='/?del_post=<?=$post['id']?>'>Удалить</a></p>
				 </div>
				 <?php
				  }?>
			<div class="posts-cat-add">
			<div class="posts-added">
				<a href="/author.php?added=<?=$post['added']?>">
					<?=$post['added']?>
				</a>
			</div>
			<?php if(!empty($_SESSION['login']) and $_SESSION['login'] == $post['added'] and isset($_GET['red_post']) and $_GET['red_post'] == $post['id']) {
				?>
				</div>
				<div class="posts-add">
		    <h3>Редактировать сообщение</h3>
        <form method="POST" action="">
		     <select class="Add" name="rescategory_id" required>
			    <?php foreach($categories as $category): ?>
          <option value="<?=$category['id']?>"><?=$category['title']?></option>
          <?php endforeach; ?>
          </select>
          <textarea class="Add restitle" name="restitle" required><?=$post['title']?></textarea>
          <textarea class="Add rescontent" name="rescontent" required><?=$post['content']?></textarea>
          <p><input type="submit" class="log-reg-btn" name="enter" value="Редактировать"> <input type="reset" class="log-reg-btn" value="Очистить"></p>
        </form>
				</div>
	      <?php
			  } else {
					?>
				  <div class="posts-cat"> 
				    <a href="/category.php?id=<?=$post['category_id']?>">
				    	<?=get_category_title($post['category_id'])?>
				    </a>
			    </div>
				</div>
			    <div class="post-link">
				    <h1><?=$post['title']?></h1>
			    <div class="one-post-content">
				    <?=$post['content']?>
			    </div>
				</div>
					<?php
			  };
			?>
	</div>
		<div class="one-post-com">
		  <h2>Оставить комментарий</h2>

        <?php
          include_once 'app/include/addcomment.php';
        ?>
		</div>
		<div class="one-post-coments">
        <h3>Коментарии:</h3>

			  <?php 
        get_comment($link, $post_id);
			  ?>
	  </div>
	</div>
</div>

<?php
require_once 'app/footer.php';
?>

