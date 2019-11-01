<?php

/*if (!isset($_SESSION["id"])) {
       session_start();
      session_unset();
      session_destroy();
      session_write_close();
      session_regenerate_id(true);
      header('Refresh: 0; URL=/index.php');
}
*/
echo "<div class='odstavec_prihlaseni'>";
echo "<div class='article_left'>";

echo "<ul class='submenu_user'>";
if($_SESSION["opravneni"] == 2){
           echo "<li><a class='submenu_user_a' href='index.php?datum_od=2000-01-01&datum_do=2100-01-01&stranka=prihlaseni&subsite=sklad&list=1&t1=zmrzlina&t2=zakusky&l1=mrazak_1&l2=mrazak_2&l3=mrazak_3&l4=mrazak_4&t3=ingrediencie&t4=sladkosti&l5=chladnicka_1&l6=chladnicka_2&l7=chladnicka_3&l8=chladnicka_4&t5=alkohol&t6=ine&l9=sklad&l10=garaz&l11=sokovacka&l12=ine'>Sklad</a></li>
                 <li><a class='submenu_user_a' href='index.php?stranka=prihlaseni&subsite=aktivne_objednavky'>Aktívne objednavky</a></li>
                 <li><a class='submenu_user_a' href='index.php?stranka=prihlaseni&subsite=vsetky_objednavky&list=1'>Všetky objednavky</a></li>
                 <li><a class='submenu_user_a' href='index.php?stranka=prihlaseni&subsite=uzivatelia'>Uživatelia</a></li>";
        }
        else{
           echo "<li><a class='submenu_user_a' href='index.php?stranka=prihlaseni&subsite=aktivne_objednavky'>Objednávky</a></li>";
        }
 
echo "<li><a class='submenu_user_a' href='index.php?stranka=prihlaseni&subsite=nastavenia'>Nastavenia</a></li>
  <li><a class='submenu_user_a' href='index.php?stranka=prihlaseni&subsite=odhlasenie'>Odhlasit sa</a></li>
</ul>";





echo" </div> ";

echo "<div class='article_right'>";

if (isset($_GET["subsite"])) 
  { 
    $subsite = $_GET["subsite"]; 
  }
  else 
  { 
    $subsite = ""; 
  }  
switch($subsite)
  {
                   // SubMenu 
               
                    case "sklad": 
                    include("sklad.php"); 
                    break;
                    
                    case "aktivne_objednavky": 
                    include("aktivne_objednavky.php"); 
                    break;
                    
                    case "vsetky_objednavky": 
                    include("vsetky_objednavky.php"); 
                    break;
                    
                    case "uzivatelia": 
                    include("uzivatelia.php"); 
                    break;
                    
                    case "nastavenia": 
                    include("nastavenia.php"); 
                    break;


                    
                    
                    default: include("stranky/uzivatelia.php"); 
  }


 
         echo" </div> ";
         echo" </div> ";
?>



  