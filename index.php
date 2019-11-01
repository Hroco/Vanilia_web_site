<!doctype html>
<html lang="sk">
<head>
  <title>Vanilia</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="Description" content="Vyroba a predaj zmrzliny.">
  <meta name="Keywords" content="Zmrzlina,Zákusky,Káva,Torty">
  <meta name="Author" content="Samuel Hrotík">
  <Link rel="icon" href="favicon.ico">
  <Link rel="stylesheet" type="text/css" href="default.css">
  <meta charset="utf-8">   
</head>
<?php
include("stranky/mysql_connect.php");
?>

<body onload = 'loadMap()'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<div id="pageWrapper">

<div class="topnav" id="myTopnav">
  <a href="index.php?stranka=home" class="active">Home</a>
  <a href="index.php?stranka=zmrzlina" class="mobilemenu">Zmrzlina</a>
  <a href="index.php?stranka=rozvoz" class="mobilemenu">Rozvoz</a>
  <a href="index.php?stranka=galeria" class="mobilemenu">Galeria</a>
  <a href="index.php?stranka=prevadzky" class="mobilemenu">Prevadzky</a>
  <a href="index.php?stranka=kontakt" class="mobilemenu">Kontakt</a>
  <?php
       if (isset($_SESSION["id"])) {
         echo"<a href='index.php?stranka=prihlaseni'>".$_SESSION["nick"]."</a>";
       }
        else { 
         ?>
         <button onclick="document.getElementById('id01').style.display='block'" class="login_button_mobile">Prihlásenie</button>
         <?php
      }
         
       
    ?>
  <?php
       if (!isset($_SESSION["id"])) { 
       ?>
         <button onclick="document.getElementById('id02').style.display='block'" class="login_button_mobile">Registrácia</button>
        <?php
        }  
    ?>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>

<script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>

	<header class="obrazok">
	<a href="index.html"><img src="logo.png" alt="Vanilia"></a>
	</header>
  <span id="framesize"></span>

<div id="winSize"></div>
<?php
include 'stranky/menu.php';
  
if (isset($_GET["stranka"])) 
  { 
    $stranka = $_GET["stranka"]; 
  }
  else 
  { 
    $stranka = ""; 
  }  
switch($stranka)
  {
                   // Menu 
               
                    case "home": 
                    include("stranky/home.php"); 
                    break;
                    
                    case "zmrzlina": 
                    include("stranky/zmrzlina.php"); 
                    break;
                    
                    case "rozvoz": 
                    include("stranky/rozvoz.php"); 
                    break;
                    
                    case "galeria": 
                    include("stranky/galeria.php"); 
                    break;
                    
                    case "prevadzky": 
                    include("stranky/prevadzky.php"); 
                    break;
                    
                    case "kontakt": 
                    include("stranky/kontakt.php"); 
                    break;
                    
                    case "prihlasenie": 
                    include("stranky/prihlasenie.php"); 
                    break;
                    
                    case "prihlaseni": 
                    include("stranky/prihlaseni.php"); 
                    break;
                    
                    case "registracia": 
                    include("stranky/registracia.php"); 
                    break;
                    
                    case "odhlasenie": 
                    include("stranky/odhlas.php"); 
                    break;
                    
                    default: include("stranky/home.php"); 
  }
echo" </div> ";
                   include("stranky/footer.php");
?>
  
  </body>
</html>





