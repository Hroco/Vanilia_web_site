<?php
$list = isset($_GET["list"]) ? $_GET["list"] : "";
      
      
      if($_SESSION["opravneni"] == 2)
        {
          $id1 = ($list*30)-30;   
          $pocet_zaznamov = mysqli_num_rows(mysqli_query($databaza,"
          SELECT * 
          FROM objednavky_simple 
          "));

          $dotaz_simple = mysqli_query($databaza,"
          SELECT * 
          FROM objednavky_simple
          LIMIT 30 OFFSET $id1  
          ");
             echo "<table class='tabulka_objednavky'>";
             echo"<tr class='tabulka_riadok_sklad'>
                  <td class='tabulka_stlpec_sklad'>Meno</td>
                  <td class='tabulka_stlpec_sklad'>Číslo objednávky</td>
                  <td class='tabulka_stlpec_sklad'>Dátum dovozu</td>
                  <td class='tabulka_stlpec_sklad'>Stav objednávky</td>
                  </tr>";
          while ($objednavka_simple = mysqli_fetch_array($dotaz_simple))
           {   
             echo"<tr class='tabulka_riadok_sklad'>";
             echo"<td class='tabulka_stlpec_sklad'>".$objednavka_simple["meno"]."</td>
                  <td class='tabulka_stlpec_sklad'>".$objednavka_simple["id"]."</td>
                  <td class='tabulka_stlpec_sklad'>".$objednavka_simple["datum"]."</td>
                  <td class='tabulka_stlpec_sklad'>".$objednavka_simple["stav"]."</td>
                  </tr>";
           }
           echo"</table>";
          
      $pocet_zaznamov = $pocet_zaznamov/30; 
      $pocet_zaznamov = ceil($pocet_zaznamov);
        echo "<ul class='submenu_sklad'>";
          for ($i = 1; $i <= $pocet_zaznamov; $i++) {
            echo "<li class='submenu_sklad_li'><a class='submenu_sklad_a' href='index.php?stranka=prihlaseni&subsite=vsetky_objednavky&list=".$i."'>".$i."</a></li>";
          }
        echo "</ul>";
          
          }

       