 <script>
//результаты уже проголосовавших
var answer = new Array();
<?php
include("dbconnect.php");
$result = $mysqli->query("SELECT * FROM answers",$db);
$answer = $mysqli->fetch_array($result);
$arrayips = $mysqli->query("SELECT * FROM ip WHERE ip = '$_SERVER[REMOTE_ADDR]'",$db);
$ip = $mysqli->fetch_array($arrayips);
$i = 0;
do{
  echo "answer[".$i."] = [".$answer['result'].", '".$answer['answer']."'];\r\n";
  $i++;
}while($answer = $mysqli->fetch_array ($result));
?>
//1% полоски результатов будет занимать 2 пикселя
var background = 2;
//Сумма всех результатов
for (var i = 0, sum = 0; i < answer.length; i++){
  sum += answer[i][0];
}
//Вычисляем процентное соотношение результатов
//и длинну полосы результатов
var percent = 100/sum;
var answerWidth = new Array();
var answerPercent = new Array();
for (var i = 0; i < answer.length; i++){
   answerPercent[i] = answer[i][0]*percent;
   answerWidth[i] = answerPercent[i]*background;
}
<?php if(empty($_COOKIE['opros']) || ($_COOKIE['opros']) == '' || empty($ip['id'])){ ?>
//Отправлям запрос обработчику по нажатию на кнопку голосовать
//и выводим результаты на экран
$(function() {
  $("#vote").click(function(){
     var idAnswer = $('.otvet:checked').val();
     $.ajax({
        url: "action.php",
        type: "GET",
        data: {"answer": idAnswer},
        cache: false,
        success: function(response){
           if(response == 1){
              var p = $(".otvet:checked").attr("id");
              if(p != undefined){
                 sum++;
                 var newPercent = 100/sum;
                 answer[p][0]++;
                 var newAnswerWidth = new Array();
                 var newAnswerPercent = new Array();
                 $("#poll").hide();
                 $("#resaltPoll").fadeIn(800);
                 for (var i = 0; i < answer.length; i++){
                    newAnswerPercent[i] = answer[i][0]*newPercent;
                    newAnswerWidth[i] = newAnswerPercent[i]*background;
                    $("#res_" + i + " .font").animate({width: newAnswerWidth[i]}, 800);
                    $("#res_" + i + " .nameanswer").html(answer[i][1] + " <strong>" + newAnswerPercent[i].toFixed(2) + "</strong> (" + answer[i][0] + ")");
                 }
                 $("#er").addClass("pollGreen").html("Спасибо, Ваш голос принят<br><span>Всего проголосовало: " + sum + "</span>");
               }
            }else{
               alert("Ошибка");
            }
          }
       });                          
       return false;
    });
});
<?php } ?>
$(document).ready(function(){
<?php if(isset($_COOKIE['opros']) || ($_COOKIE['opros']) != '' || isset($ip['id'])){ ?>
   //Эту часть мы выводим если пользователь уже проголосовал
   $("#resaltPoll").fadeIn(800);
   for (var i = 0; i < answer.length; i++){
      $("#res_" + i + " .font").animate({width: answerWidth[i]}, 800);
      $("#res_" + i + " .nameanswer").html(answer[i][1] + " <strong>" + answerPercent[i].toFixed(2) + "</strong> (" + answer[i][0] + ")");
   }
   $("#er").addClass("pollRed").html("Вы уже голосовали<br><span>Всего проголосовало: " + sum + "</span>");
<?php } ?>
});
</script>

<div id="pollAjaxs">
  <p class="pollTitle">Вопрос?</p>
     <?php if(empty($_COOKIE['opros']) || ($_COOKIE['opros']) == '' || empty($ip['id'])){ ?>
     <div id="poll">
       <form method="get" id="formPoll">
       <?php
       $mysqli->data_seek($result, 0);
       $answer = $mysqli->fetch_array($result);
       $i = 0;
       do{
         echo "<div class='answer'>
         <input type='radio' name='otvet' value='".$answer['id']."' class='otvet' id='".$i."'> ".$answer['answer'].
         "</div>\r\n";
         $i++;
       }while($answer = $mysqli->fetch_array ($result));
       ?>
       <div class="button">
          <a href="#" id="vote">Голосовать</a>
       </div>
       </form>
     </div>
     <?php } ?>
     <div id="resaltPoll">
        <?php
        $mysqli->data_seek($result, 0);
        $answer = $mysqli->fetch_array($result);
        $i = 0;
        do{
           echo "<div class='answer' id='res_".$i."'>
           <div class='nameanswer'></div>
           <div class='font'></div>
           </div>\r\n";
           $i++;
        }while($answer = $mysqli->fetch_array ($result));
        ?>
        <div class='button' id='er'></div>
     </div>
</div>