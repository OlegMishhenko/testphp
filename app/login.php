<form action="app/include/testreg.php" method="post">
    <input name="login" class="log-reg" placeholder="Логин" type="text" size="15" maxlength="15">
    <input name="password" class="log-reg" placeholder="Пароль" type="password" size="15" maxlength="15">
    <input type="submit" class="log-reg-btn" name="submit" value="Войти">
</form>

<?php
// Проверяем, пусты ли переменные логина и id пользователя
  if (empty($_SESSION['login']) or empty($_SESSION['id']))
  {
  // Если пусты, то мы не выводим ссылку
    //echo "Вы вошли на сайт, как гость<br><a href='#'>Эта ссылка  доступна только зарегистрированным пользователям</a>";
  }
    else
    {
      // Если не пусты, то мы выводим ссылку
      //echo "Вы вошли на сайт, как ".$_SESSION['login']."<br><a  href='http://tvpavlovsk.sk6.ru/'>Эта ссылка доступна только  зарегистрированным пользователям</a>";
    }
?>