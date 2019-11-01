<script>
jQuery("document").ready(function($){

	var nav = $('.menu');

	$(window).scroll(function () {
		if ($(this).scrollTop() > 136) {
			nav.addClass("fixed");
		} else {
			nav.removeClass("fixed");
		}
	});

});
</script>

<div class="menu">
<div class="icemegamenu">
  <ul class="icemegamenu">
		<li class="topmenu1 topmenu1-1"><a href="index.php?stranka=home" class="odkaz"><span>Home</span></a></li>
		<li class="topmenu topmenu-1"><a href="index.php?stranka=zmrzlina" class="odkaz">Zmrzlina</a></li>
		<li class="topmenu topmenu-1"><a href="index.php?stranka=rozvoz" class="odkaz">Rozvoz</a></li>
		<li class="topmenu topmenu-1"><a href="index.php?stranka=galeria" class="odkaz">Galeria</a></li>
		<li class="topmenu topmenu-1"><a href="index.php?stranka=prevadzky" class="odkaz">Prevadzky</a></li>
		<li class="topmenu topmenu-1"><a href="index.php?stranka=kontakt" class="odkaz">Kontakt</a></li>
    <?php
       if (isset($_SESSION["id"])) {
         echo"<li class='topmenu'><a href='index.php?stranka=prihlaseni' class='odkaz'>".$_SESSION["nick"]."</a></li>";
       }
        else { 
         echo"<li class='topmenu'>";
         ?>
         <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;" class="login_button">Prihlásenie</button>
         <?php
         echo"</li>";
      }  
    ?>
    <?php
       if (!isset($_SESSION["id"])) { 
         echo"<li class='topmenu'>";
         ?>
         <button onclick="document.getElementById('id02').style.display='block'" style="width:auto;" class="login_button">Registrácia</button>
         <?php
         echo"</li>";
      }  
    ?>
  </ul>
   </div>
   </div>
   
<?php   
if (!isset($_SESSION["id"])) {   
?>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="index.php" method="post">

    <div class="container">
      <label><b>Meno</b></label>
      <input type="text" placeholder="Zadaj meno" name="nick" required>

      <label><b>Heslo</b></label>
      <input type="password" placeholder="Zadaj heslo" name="heslo" required>
      <input type="submit" name="login" value="Prihlásiť sa" class="login_form_button">  
      
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<?php

}
include("stranky/prihlasenie.php");
include("stranky/registracia.php");
?>
<script>
// Get the modal
var modal = document.getElementById('id01');


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    }

</script>



