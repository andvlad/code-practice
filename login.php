<!-- Блок для вывода сообщений -->
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
 
<?php
    //Проверяем, если пользователь не авторизован, то выводим форму авторизации, 
    //иначе выводим сообщение о том, что он уже авторизован
    if(!isset($_SESSION["email"]) && !isset($_SESSION["password"])){
?>

    <div id="form_auth">
        <h2>Форма авторизации</h2>
        <form action="auth.php" method="post" name="login">
            <table>
          
                <tbody>
                    <tr>
                        <td> Логин: </td>
                        <td>
                            <input name="login" required="required" type="text"><br>
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
                            <img src="captcha.php" alt="Изображение капчи" /> <br>
                            <input name="captcha" placeholder="Проверочный код" type="text">
                        </p>
                    </td>
                </tr>-->
 
                    <tr>
                        <td colspan="2">
                            <input name="btn_submit_auth" value="Войти" type="submit">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
 
<?php
    }else{
?>
 
    <div id="authorized">
        <h2>Вы уже авторизованы</h2>
    </div>
 
<?php
    }
?>