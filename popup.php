<div class="block_for_messages">
    <?php
 
        if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
            echo $_SESSION["error_messages"];
 
            //Уничтожаем чтобы не появилось заново при обновлении страницы
            unset($_SESSION["error_messages"]);
        }
 
        if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
            echo $_SESSION["success_messages"];
             
            //Уничтожаем чтобы не появилось заново при обновлении страницы
            unset($_SESSION["success_messages"]);
        }
    ?>
</div>

<div class="reg">
        <a href="#win1">Вход</a>
        <a href="#win2">Регистрация</a>
      </div>
      <a href="#x" class="overlay" id="win1"></a>
      <div class="popup">

        <p>Вход</p>
          <form class="cd-form" action="auth.php" method="post" name="login">

            <p class="fieldset">
              <label class="image-replace cd-email" for="signin-email">Логин</label>
              <input class="full-width has-padding has-border" id="signin-email" type="text" placeholder="Логин">
              <span class="error_mesage"></span>
            </p>

            <p class="fieldset">
              <label class="image-replace cd-password" for="signin-password">Пароль</label>
              <input class="full-width has-padding has-border" id="signin-password" type="password"  placeholder="Пароль">
              <a href="#0" class="hide-password">Скрыть</a>
              <span class="error_mesage"></span>
            </p>

            <p class="fieldset">
              <input type="checkbox" id="remember-me" checked>
              <label for="remember-me">Запомнить меня</label>
            </p>
                
            <button class="glo" name="btn_submit_auth" type="submit">Войти</button>
                
          </form>

        <a class="close" title="Закрыть" href="#close"></a>
      </div>

      <a href="#x" class="overlay" id="win2"></a>
      <div class="popup">

        <p>Регистрация</p>

          <form action="post_reg.php" method="post" name="register">

            <p class="fieldset">
              <label class="image-replace cd-email" for="signin-email">Логин</label>
              <input class="full-width has-padding has-border" id="signin-email" type="text" placeholder="Логин">
              <span class="error_mesage"></span>
            </p>

            <p class="fieldset">
              <label class="image-replace cd-password" for="signin-password">E-mail</label>
              <input class="full-width has-padding has-border" id="signin-email" type="email"  placeholder="E-mail">
              <span class="error_mesage"></span>
            </p>

            <p class="fieldset">
              <label class="image-replace cd-password" for="signin-password">Пароль</label>
              <input class="full-width has-padding has-border" id="signin-password" type="password"  placeholder="Пароль">
              <a href="#0" class="hide-password">Скрыть</a>
              <span class="error_mesage"></span>
            </p>
                
            <button class="glo" name="btn_submit_auth" type="submit">Зарегистрироваться</button>

          </form>

        <a class="close" title="Закрыть" href="#close"></a>
      </div>