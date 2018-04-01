<?php session_start(); ?>
 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name='viewport' content='width=device-width,initial-scale=1'/>
    <meta content='true' name='HandheldFriendly'/>
    <meta content='width' name='MobileOptimized'/>
    <meta content='yes' name='apple-mobile-web-app-capable'/>
    <title>Mein Seit</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!--<script src="js/jquery-3.3.1.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>-->
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>

  <body>

    <div class="top">
      <?php  if(!isset($_SESSION['email']) && !isset($_SESSION['password'])){
      require_once("popup.php");
      }else{ ?> 
        <div class="reg">
          <a href="index.php"><?php printf ($_SESSION['login']); ?></a>
          <a href="logout.php">Выход</a>
        </div>
      <?php } ?> 
      <p id="toptext">Владислав Андрюшин</p>
    </div>

    <div class="mainmenu">
      <a href="index.php">Главная</a>
      <a href="index.php">Формы</a>
      <a href="index.php">Медиа</a>
      <a href="index.php">Инфо</a>
      <a href="index.php">Метод</a>
    </div>