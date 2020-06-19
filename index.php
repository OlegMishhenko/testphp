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
		<h1>Лента</h1>
		</div>
    <?php
	    $page = isset($_GET['page']) ? $_GET['page']: 1;
	    $limit = 5;
	    $offset = $limit * ($page - 1);
			$posts = get_posts($limit, $offset);
    ?>
		<?php foreach($posts as $post): ?>
			<div class="posts">
			    <?php 
				    if(!empty($_SESSION['login']) and $_SESSION['login'] == $post['added']) {
				    ?> 
						<div class="posts-red">
						  <p>
						    <a href='/post.php?post_id=<?=$post['id']?>&red_post=<?=$post['id']?>'>Редактировать</a> 
				        <a href='/?del_post=<?=$post['id']?>'>Удалить</a>
						  </p>
						</div>
						  <?php
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
			<!-- вывод пагинатора -->
			<div class="pag">
      <?php if($pageNum > 1) { ?>
        <a href="/?page=1">&lt;&lt;</a></li>
        <a href="/?page=<?=$pageNum-1;?>">&lt;</a></li>
      <?php } ?>
         
      <?php for($i = 1; $i<=$lastPage; $i++) { ?>
        <a <?=($i == $pageNum) ? 'class="current"' : '';?> href="/?page=<?=$i;?>"><?=$i;?></a>
      <?php } ?>
         
      <?php if($pageNum < $lastPage) { ?>
        <a href="/?page=<?=$pageNum+1;?>">&gt;</a>
        <a href="/?page=<?=$lastPage;?>">&gt;&gt;</a>
      <?php } ?>
			</div>
	</div>
</div>
</div>


<?php 
require_once 'app/footer.php';
?>