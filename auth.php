<?php
    //Запускаем сессию
    session_start();
 
    //Добавляем файл подключения к БД
    require_once("dbconnect.php");
    //Объявляем ячейку для добавления ошибок, которые могут возникнуть при обработке формы.
$_SESSION["error_messages"] = '';
 
//Объявляем ячейку для добавления успешных сообщений
$_SESSION["success_messages"] = '';
/*
    Проверяем была ли отправлена форма, то есть была ли нажата кнопка Войти. Если да, то идём дальше, если нет, то выведем пользователю сообщение об ошибке, о том что он зашёл на эту страницу напрямую.
*/
if(isset($_POST["btn_submit_auth"]) && !empty($_POST["btn_submit_auth"])){

    //Обрезаем пробелы с начала и с конца строки
    $login = trim($_POST["login"]);
    if(isset($_POST["login"])){
 
        if(!empty($login)){
            $login = htmlspecialchars($login, ENT_QUOTES);
 
        //Проверяем формат полученного почтового адреса с помощью регулярного выражения
        /*$reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";
 
        //Если формат полученного почтового адреса не соответствует регулярному выражению
        if( !preg_match($reg_email, $email)){
            // Сохраняем в сессию сообщение об ошибке. 
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Вы ввели неправильный email</p>";
             
            //Возвращаем пользователя на страницу авторизации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/login.php");
 
            //Останавливаем скрипт
            exit();
        }*/
        }else{
        // Сохраняем в сессию сообщение об ошибке. 
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Поле для ввода логина не должно быть пустым.</p>";
         
        //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/register.php");
 
        //Останавливаем скрипт
            exit();
        }
     
 
    }else{
    // Сохраняем в сессию сообщение об ошибке. 
        $_SESSION["error_messages"] .= "<p class='mesage_error' >Пустое поле для ввода логина</p>";
     
    //Возвращаем пользователя на страницу авторизации
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$address_site."/login.php");
 
    //Останавливаем скрипт
        exit();
    }

    if(isset($_POST["password"])){
 
    //Обрезаем пробелы с начала и с конца строки
        $password = trim($_POST["password"]);
 
        if(!empty($password)){
            $password = htmlspecialchars($password, ENT_QUOTES);
 
        //Шифруем пароль
            $password = md5($password."top_secret");

        }else{
        // Сохраняем в сессию сообщение об ошибке. 
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Укажите Ваш пароль</p>";
         
        //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/login.php");
 
        //Останавливаем скрипт
            exit();
        }
     
    }else{
    // Сохраняем в сессию сообщение об ошибке. 
        $_SESSION["error_messages"] .= "<p class='mesage_error' >Пустое поле для ввода пароля</p>";
     
    //Возвращаем пользователя на страницу регистрации
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$address_site."/login.php");
 
    //Останавливаем скрипт
        exit();
    }
    //Запрос в БД на выборке пользователя.
    $result_query_select = $mysqli->query("SELECT * FROM `users_data` WHERE login = '".$login."' AND password = '".$password."'");
 
    if(!$result_query_select){
    // Сохраняем в сессию сообщение об ошибке. 
        $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка запроса по выборке пользователя из БД</p>";
     
    //Возвращаем пользователя на страницу регистрации
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$address_site."/login.php");
 
    //Останавливаем скрипт
        exit();

    }else{
 
    //Проверяем, если в базе нет пользователя с такими данными, то выводим сообщение об ошибке
        if($result_query_select->num_rows == 1){
         
        // Если введенные данные совпадают с данными из базы, то сохраняем логин и пароль в массив сессий.
            $_SESSION['login'] = $login;
            $_SESSION['password'] = $password;
        /*$login = $mysqli->query("SELECT `login` FROM `users_data` WHERE `email` = '".$email."' AND `password` = '".$password."'");
        if ($login) {

            $_SESSION['login'] = $login->fetch_assoc();
            $_SESSION['login'] = $login[0];*/

        /* удаление выборки */
 
        //Возвращаем пользователя на главную страницу
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: index.php");
 
        }else{
         
        // Сохраняем в сессию сообщение об ошибке. 
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Неправильный логин и/или пароль</p>";
         
        //Возвращаем пользователя на страницу авторизации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/login.php");
 
        //Останавливаем скрипт
            exit();
        }

    }
}else{
    exit("<p><strong>Ошибка!</strong> Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. Вы можете перейти на <a href=".$address_site."> главную страницу </a>.</p>");
}