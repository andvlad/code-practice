<div class="reg">
	<a href="#win1">Вход</a>
    <a href="#win2">Регистрация</a>
</div>
		<!--<nav class="main-nav"></nav>-->
<a href="#x" class="overlay" id="win1"></a>
<div class="popup">
	<div class="tabs">
    	<input id="tab1" type="radio" name="tabs" checked>
    	<label for="tab1" title="Вкладка 1">Вход</label>
 
    	<input id="tab2" type="radio" name="tabs">
    	<label for="tab2" title="Вкладка 2">Регистрация</label>
 
    	<section id="content-tab1">
        	<p>
			<?php require("login.php"); ?>
        	</p>
    	</section>  
    	<section id="content-tab2">
        	<p>
          	<?php require("register.php"); ?>
        	</p>
    	</section>   
	</div>
	<a class="close" title="Закрыть" href="#close"></a>
</div>

<a href="#0" class="overlay" id="win2"></a>
<div class="popup">
	<div class="tabs">
    	<input id="tab3" type="radio" name="tabs">
    	<label for="tab3" title="Вкладка 1">Вход</label>
 
    	<input id="tab4" type="radio" name="tabs" checked>
    	<label for="tab4" title="Вкладка 2">Регистрация</label>
 
    	<section id="content-tab3">
        	<p>
			<?php require("login.php"); ?>
        	</p>
    	</section>  
    	<section id="content-tab4">
        	<p>
          	<?php require("register.php"); ?>
        	</p>
    	</section>   
	</div>
	<a class="close" title="Закрыть" href="#close"></a>
</div>