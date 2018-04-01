<!-- Блок для вывода сообщений -->
<div class="block_for_messages">
    <?php
        //Если в сессии существуют сообщения об ошибках, то выводим их
        if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
            echo $_SESSION["error_messages"];
 
            //Уничтожаем чтобы не выводились заново при обновлении страницы
            unset($_SESSION["error_messages"]);
        }
 
        //Если в сессии существуют радостные сообщения, то выводим их
        if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
            echo $_SESSION["success_messages"];
             
            //Уничтожаем чтобы не выводились заново при обновлении страницы
            unset($_SESSION["success_messages"]);
        }
    ?>
</div>
 
<?php
    //Проверяем, если пользователь не авторизован, то выводим форму регистрации, 
    //иначе выводим сообщение о том, что он уже зарегистрирован
    if (!isset($_SESSION["email"]) && !isset($_SESSION["password"])) {
?>
        <div id="form_register">
            <h2>Форма регистрации</h2>
 
            <form action="post_reg.php" method="post" name="register">
                <table>
                    <tbody><tr>
                        <td> Логин: </td>
                        <td>
                            <input name="login" required="required" type="text">
                        </td>
                    </tr>
              
                    <tr>
                        <td> E-mail: </td>
                        <td>
                            <input name="email" required="required" type="email"><br>
                            <span id="valid_email_message" class="mesage_error"></span>
                        </td>
                    </tr>
              
                    <tr>
                        <td> Пароль: </td>
                        <td>
                            <input name="password" placeholder="минимум 6 символов" required="required" type="password"><br>
                            <span id="valid_password_message" class="mesage_error"></span>
                        </td>
                    </tr>
                    <!--<tr>
                        <td> Введите капчу: </td>
                        <td>
                            <p>
                                <img src="captcha.php" alt="Капча" /> <br><br>
                                <input name="captcha" placeholder="Проверочный код" required="required" type="text">
                            </p>
                        </td>
                    </tr>-->
                    <tr>
                        <td colspan="2">
                            <input name="btn_submit_register" value="Зарегистрироватся" type="submit">
                        </td>
                    </tr>
                </tbody></table>
            </form>
        </div>
<?php
    } else {
?>
        <div id="authorized">
            <h2>Вы уже зарегистрированы</h2>
        </div>
<?php
    }
?>