<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'app/header.php';
?>

<div class="container">
<div class="flex">
<?php
			  $categories = get_categories();
				include_once 'app/include/addpost.php';
				if (!empty($_SESSION['login']) or !empty($_SESSION['id']))
          {
		        ?>
	<div class="sitebar">
		<div class="posts-f">
		        <h3>Добавить сообщение</h3>
            <form method="POST" action="">
						<p>Категория</p>
		          <select class="Add Add-sel" name="category_id" required>
			        <?php foreach($categories as $category): ?>
              <option value="<?=$category['id']?>"><?=$category['title']?></option>
              <?php endforeach; ?>
              </select>
							<p>Заголовок</p>
              <textarea class="Add Add-min" name="title" required></textarea>
							<p>Сообщение</p>
              <textarea class="Add Add-max" name="content" required></textarea>
              <p><input type="submit" class="log-reg-btn" name="enter" value="Добавить"> <input class="log-reg-btn" type="reset" value="Очистить"></p>
            </form>
		</div>
	</div>
	        <?php
	        };
      ?>
	<div class="main">
		<div class="posts-t">
			<p>Последние сообщения из категории: </p><h1><?=get_category_title($_GET['id'])?></h1>
		</div>
		<?php
			$category_id = $_GET['id'];
			$posts = get_posts_by_category($category_id);
		?>
		<?php foreach($posts as $post): ?>
		<div class="posts">
		<?php if(!empty($_SESSION['login']) and $_SESSION['login'] == $post['added']) {
				?> 
			  <div class="posts-red">
				  <p>
					  <a href='/post.php?post_id=<?=$post_id?>&red_com=<?=$resComment['id']?>'>Редактировать</a> 
				    <a href='/?del_post=<?=$post['id']?>'>Удалить</a>
					</p>
				</div><?php
				  }?>
			<div class="posts-post">
				<div class="posts-cat-add">
				  <div class="posts-cat">
				<a href="/category.php?id=<?=$post['category_id']?>">
					<?=get_category_title($post['category_id'])?>
				</a>
			</div>
			<div class="posts-added">
				<a href="/author.php?added=<?=$post['added']?>">
					<?=$post['added']?>
			  </a>
			</div>
			</div>
      <div class="post-link">
				<h3><a href="/post.php?post_id=<?=$post['id']?>"><?=$post['title']?></a></h3>
        <p>
          <?=mb_substr($post['content'], 0, 150, 'UTF-8').'...'?>
        </p>
        <p>
          <a href="/post.php?post_id=<?=$post['id']?>">
            Читать полностью
          </a>
        </p>
				 </div>
      </div>
		</div>
		<?php endforeach; ?>
	</div>
</div>


<?php
require_once 'app/footer.php';
?>