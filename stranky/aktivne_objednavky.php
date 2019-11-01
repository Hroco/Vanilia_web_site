<?php
$save = empty($_POST["save"]) ? "" : $_POST["save"];
$save2 = empty($_POST["save2"]) ? "" : $_POST["save2"];
$delete = empty($_POST["delete"]) ? "" : $_POST["delete"];
$poznamka = empty($_POST["poznamka"]) ? "" : mysqli_real_escape_string($databaza, $_POST["poznamka"]);
$nazov = empty($_POST["nazov"]) ? "" : mysqli_real_escape_string($databaza, $_POST["nazov"]);
$mnozstvo = empty($_POST["mnozstvo"]) ? "" : $_POST["mnozstvo"];
$meno = empty($_SESSION["nick"]) ? "" : $_SESSION["nick"];
$filter_nazov = empty($_POST["nazov"]) ? "" : $_POST["nazov"];
$filter_mnozstvo = empty($_POST["mnozstvo"]) ? "" : $_POST["mnozstvo"]; 
$filter_poznamka = empty($_POST["poznamka"]) ? "" : $_POST["poznamka"];
$filter_meno = empty($_POST["meno"]) ? "" : $_POST["meno"];
$filter_datum = empty($_POST["datum"]) ? "" : $_POST["datum"];
$filter_stav = empty($_POST["stav"]) ? "" : $_POST["stav"];
$filter_cislo_objednavky = empty($_POST["cislo_objednavky"]) ? "" : $_POST["cislo_objednavky"];
$datum_dovozu = empty($_POST["datum_dovozu"]) ? "" : $_POST["datum_dovozu"];
$hotovo = empty($_POST["hotovo"]) ? "" : $_POST["hotovo"];
$list = isset($_GET["list"]) ? $_GET["list"] : "";
$tmp = empty($tmp) ? "" : "";
$id = empty($_POST["id"]) ? "" : $_POST["id"];
$pocet_zaznamov = mysqli_num_rows(mysqli_query($databaza,"
          SELECT * 
          FROM objednavky
          WHERE (meno = '$meno' and stav = '0') 
          "));      
      
      if($_SESSION["opravneni"] == 2)
        {
           $dotaz_simple = mysqli_query($databaza,"
          SELECT * 
          FROM objednavky_simple 
          WHERE (stav = '1')
          ");

          while ($objednavka_simple = mysqli_fetch_array($dotaz_simple))
           {

            
             $dotaz_telefon = mysqli_query($databaza,"
            SELECT * 
            FROM uzivatelia 
            WHERE (nick = '".$objednavka_simple["meno"]."')
            ");
            $objednavka_telefon = mysqli_fetch_array($dotaz_telefon);

            
             echo "<form action='";echo $_SERVER['REQUEST_URI'];echo"' method='post'>";      
             echo"<br>";
             echo "<table class='tabulka_objednavky'>";
             echo"<tr class='tabulka_riadok_sklad'>";
             echo"<td class='tabulka_stlpec_sklad'>".$objednavka_simple["meno"]."</td>
                  <td class='tabulka_stlpec_sklad'>".$objednavka_telefon["phonenumber"]."</td>
                  <td class='tabulka_stlpec_sklad'>Objednávka číslo: ".$objednavka_simple["id"]."</td>
                  <td class='tabulka_stlpec_sklad'>Na deň: ".$objednavka_simple["datum"]."</td>
                  <td class='tabulka_stlpec_sklad'>Stav objednávky: ".$objednavka_simple["stav"]."</td>
                  <td class='tabulka_stlpec_sklad'><input type='hidden' class='nice' name='id' value='".$objednavka_simple["id"]."' /><input class='button_tabulka_sklad' type='submit'  name='hotovo' value='Hotová' /></td>
                  </tr>";
           //  echo"<tr class='tabulka_riadok_sklad'></tr>";
              echo"</table>";
              echo"</form>";
              
              if($hotovo)
                   {
                     mysqli_query($databaza,"
                     UPDATE `objednavky_simple` 
                     SET `stav` = '2' 
                     WHERE `id` = ".mysqli_real_escape_string($databaza, $id));
                   
                   
                     $dotaz_stav = mysqli_query($databaza,"
                     SELECT * 
                     FROM objednavky 
                     WHERE (cislo_objednavky = ".$id.")
                     ");
              
                while ($objednavka_stav = mysqli_fetch_array($dotaz_stav))
                  {
                     mysqli_query($databaza,"
                     UPDATE `objednavky` 
                     SET `stav` = '2' 
                     WHERE `cislo_objednavky` = ".mysqli_real_escape_string($databaza, $id));    
                  }  
                }
              
              echo"<br>";
          $dotaz_full = mysqli_query($databaza,"
          SELECT * 
          FROM objednavky 
          WHERE (cislo_objednavky = ".$objednavka_simple["id"].")
        
          ");
          echo "<table class='tabulka_objednavky'>";
          while ($objednavka_full = mysqli_fetch_array($dotaz_full))
           {   
            echo "<tr class='tabulka_riadok_sklad'>
                  <td class='tabulka_stlpec_sklad'>".$objednavka_full["nazov"]."</td>
                  <td class='tabulka_stlpec_sklad'>".$objednavka_full["mnozstvo"]."x</td>";
                   if($objednavka_full["poznamka"] != "")
                   {
                     echo"<td class='tabulka_stlpec_sklad'>".$objednavka_full["poznamka"]."</td>";
                   }
                    echo"</tr>";
           }
            echo"</table>";
           }
           
                   }

        else {
                
echo "
  <form action='";echo $_SERVER['REQUEST_URI'];echo"' method='post'>
    <table>
        <tr><td>Názov: </td><td><select name='nazov'>";
      $dotaz = mysqli_query($databaza,"
          SELECT * 
          FROM zmrzliny 
          ");
          while ($zmrzliny = mysqli_fetch_array($dotaz))
           {            
             echo "<option value='".$zmrzliny["zmrzlina"]."'>".$zmrzliny["zmrzlina"]."</option>";      
           }
        echo "</select>
              </td></tr>";
      echo "<tr><td>Množstvo: </td><td><input type='number' name='mnozstvo' /></td><td>";    
      if($save){ if(!$mnozstvo){echo "Nezadal si množstvo.";}}
      echo "</td></tr>
      <tr><td>Poznamka: </td><td><input type='text' name='poznamka' /></td></tr>
      <tr><td><input class='nice' type='submit'  name='save' value='Uložit' /></td></tr>
    </table>
  </form>";

  if($save)
  {
     if($nazov AND $mnozstvo ) 
   {    
          if (mysqli_query($databaza,"INSERT INTO objednavky (id,cislo_objednavky,nazov,mnozstvo,poznamka,meno,datum,stav) 
              VALUES (DEFAULT, '0', '$nazov', '$mnozstvo', '$poznamka', '$meno', '0', '0')")) 
              {
                echo "<p>Zaznam bol pridaný.</p>";
              }
          else
              {
                echo "<p>Zaznam nebol pridaný.</p>";
              }
    }
  }
  
                echo "
  <form action='";echo $_SERVER['REQUEST_URI'];echo"' method='post'>
    <table>
     <tr>
     <td>Dátum dovozu: </td><td><input type='date' name='datum_dovozu' value='' /></td>
     <td><input type='submit'  name='save2' value='Odoslat objednávku' /></td>";
     if ($pocet_zaznamov != 0) {
     echo "<td><input type='submit'  name='delete' value='Zrušit objednávku' /></td>";
     }
     echo "<td>";    
      if($save){ if(!$datum_dovozu and $save2){echo "Nezadal si dátum dovozu.";}}
      echo "</td></tr>
    </table>
  </form>";
           if($delete)
              {
                 mysqli_query($databaza,"
                 DELETE FROM objednavky  
                 WHERE (meno = '$meno' and stav = '0')
                 ");
              } 
             
            if($save2 and $datum_dovozu)
              {
              mysqli_query($databaza,"INSERT INTO objednavky_simple (id,meno,datum,stav) 
              VALUES (DEFAULT, '$meno', '$datum_dovozu', '1')");     
              
              $dotaz1 = mysqli_query($databaza,"
                 SELECT *                             
                 FROM objednavky_simple 
                 WHERE (meno = '$meno' and datum = '$datum_dovozu')
                 ");
                 $objednavka_simple = mysqli_fetch_array($dotaz1);
                 $cislo_objednavky = $objednavka_simple["id"];   
              $dotaz = mysqli_query($databaza,"
                 SELECT * 
                 FROM objednavky 
                 WHERE (meno = '$meno' and stav = '0')
                 ");
              
                while ($objednavka_zapis = mysqli_fetch_array($dotaz))
                  { 
                     mysqli_query($databaza,"
                     UPDATE `objednavky` 
                     SET `cislo_objednavky` = '".$cislo_objednavky."' 
                     WHERE `id` = ".mysqli_real_escape_string($databaza, $objednavka_zapis["id"]));
                     mysqli_query($databaza,"
                     UPDATE `objednavky` 
                     SET `datum` = '".$datum_dovozu."' 
                     WHERE `id` = ".mysqli_real_escape_string($databaza, $objednavka_zapis["id"]));
                     mysqli_query($databaza,"
                     UPDATE `objednavky` 
                     SET `stav` = '1' 
                     WHERE `id` = ".mysqli_real_escape_string($databaza, $objednavka_zapis["id"]));    
                  }  
              }
      
          
    // echo"</div>"; 
     if ($pocet_zaznamov != 0) {
     echo "<form action='";echo $_SERVER['REQUEST_URI'];echo"' method='post'>";
     echo "<table class='tabulka_objednavky'>";   
     echo "<tr class='tabulka_riadok_sklad'>
              <td class='tabulka_stlpec_sklad'><input class='button_tabulka_sklad' type='submit'  name='nazov' value='Nazov' /></td>
              <td class='tabulka_stlpec_sklad'><input class='button_tabulka_sklad' type='submit'  name='mnozstvo' value='Množstvo' /></td>
              <td class='tabulka_stlpec_sklad'><input class='button_tabulka_sklad' type='submit'  name='poznamka' value='Poznámka' /></td>
            </tr>"; 
      echo "</form>";
      }  

    
    
          if ($filter_nazov) { $order = 'nazov'; }
          else if ($filter_mnozstvo) { $order = 'mnozstvo'; }
          else if ($filter_poznamka) { $order = 'poznamka'; }
          else { $order = 'id'; }      
          //--------------------------------------------------------
          $dotaz = mysqli_query($databaza,"
          SELECT * 
          FROM objednavky 
          WHERE (meno = '$meno' and stav = '0')
          ORDER BY $order 
          ");
               
          //treba to opravit a spravit aby sa tie stranky upravovali ako na googli napr
          while ($objednavka = mysqli_fetch_array($dotaz))
           {            
             echo"
             <tr class='tabulka_riadok_sklad'>
              <td class='tabulka_stlpec_sklad'>".$objednavka ["nazov"]."</td>
              <td class='tabulka_stlpec_sklad'>".$objednavka["mnozstvo"]."</td>
              <td class='tabulka_stlpec_sklad'>".$objednavka["poznamka"]."</td>
             </tr>";      
           }
      echo"</table>";
        }