<div>
<?php
if($_SESSION["opravneni"] == 2)
        {
  $dt1 = new DateTime();
  $today = $dt1->format("Y-m-d");

  $dt2 = new DateTime("+1 month");
  $date = $dt2->format("Y-m-d");

  $typ = empty($_POST["typ"]) ? "" : $_POST["typ"];
  $nazov = empty($_POST["nazov"]) ? "" : mysqli_real_escape_string($databaza, $_POST["nazov"]);
  $mnozstvo = empty($_POST["mnozstvo"]) ? "" : $_POST["mnozstvo"];
  $datum_spotreby = empty($_POST["datum_spotreby"]) ? "" : $_POST["datum_spotreby"];
  $datum_vyroby = empty($_POST["datum_vyroby"]) ? "" : $_POST["datum_vyroby"];
  $lokacia = empty($_POST["lokacia"]) ? "" : mysqli_real_escape_string($databaza, $_POST["lokacia"]);
  $cena = empty($_POST["cena"]) ? "" : $_POST["cena"];
  $poznamka = empty($_POST["poznamka"]) ? "" : mysqli_real_escape_string($databaza, $_POST["poznamka"]);
  $save = empty($_POST["save"]) ? "" : $_POST["save"];
  $edit = empty($_POST["edit"]) ? "" : $_POST["edit"];
  $delete = empty($_POST["delete"]) ? "" : $_POST["delete"];
  $stav = $_POST["stav"]==1 ? "1" : "0";
  $filter_id = empty($_POST["id"]) ? "" : $_POST["id"];
  $filter_typ = empty($_POST["typ"]) ? "" : $_POST["typ"];
  $filter_nazov = empty($_POST["nazov"]) ? "" : $_POST["nazov"];
  $filter_mnozstvo = empty($_POST["mnozstvo"]) ? "" : $_POST["mnozstvo"];
  $filter_datum_spotreby = empty($_POST["datum_spotreby"]) ? "" : $_POST["datum_spotreby"];
  $filter_datum_vyroby = empty($_POST["datum_vyroby"]) ? "" : $_POST["datum_vyroby"];
  $filter_lokacia = empty($_POST["lokacia"]) ? "" : $_POST["lokacia"];
  $filter_cena = empty($_POST["cena"]) ? "" : $_POST["cena"];
  $filter_poznamka = empty($_POST["poznamka"]) ? "" : $_POST["poznamka"];
  $filter_stav = empty($_POST["stav"]) ? "" : $_POST["stav"];
  $filter = empty($_POST["filter"]) ? "" : $_POST["filter"];
  $list = isset($_GET["list"]) ? $_GET["list"] : "";
  $datum_od_new = isset($_GET["datum_od"]) ? $_GET["datum_od"] : "2000-01-01";      
  $datum_do_new = isset($_GET["datum_do"]) ? $_GET["datum_do"] : "2100-01-01";       
  $t1 = isset($_GET["t1"]) ? $_GET["t1"] : "";
  $t2 = isset($_GET["t2"]) ? $_GET["t2"] : "";
  $t3 = isset($_GET["t3"]) ? $_GET["t3"] : "";
  $t4 = isset($_GET["t4"]) ? $_GET["t4"] : "";
  $t5 = isset($_GET["t5"]) ? $_GET["t5"] : "";
  $t6 = isset($_GET["t6"]) ? $_GET["t6"] : "";
  $l1 = isset($_GET["l1"]) ? $_GET["l1"] : "";
  $l2 = isset($_GET["l2"]) ? $_GET["l2"] : "";
  $l3 = isset($_GET["l3"]) ? $_GET["l3"] : "";
  $l4 = isset($_GET["l4"]) ? $_GET["l4"] : "";
  $l5 = isset($_GET["l5"]) ? $_GET["l5"] : "";
  $l6 = isset($_GET["l6"]) ? $_GET["l6"] : "";
  $l7 = isset($_GET["l7"]) ? $_GET["l7"] : "";
  $l8 = isset($_GET["l8"]) ? $_GET["l8"] : "";
  $l9 = isset($_GET["l9"]) ? $_GET["l9"] : "";
  $l10 = isset($_GET["l10"]) ? $_GET["l10"] : "";
  $l11 = isset($_GET["l11"]) ? $_GET["l11"] : "";
  $l12 = isset($_GET["l12"]) ? $_GET["l10"] : "";

  if($edit)
        {
          mysqli_query($databaza,"UPDATE `sklad` SET `stav` = '".$stav."' WHERE `id` = ".mysqli_real_escape_string($databaza, $_POST["id"]));
        }
  if($delete)
        {
          mysqli_query($databaza,"DELETE FROM sklad  WHERE id = ".mysqli_real_escape_string($databaza, $_POST["id"]));
        }


  ?><form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post"><?php
    echo "<table id='tabulka_objednavky'>
      <tr><td>Typ: </td>
      <td>
        <select name='typ'>
          <option value='zmrzlina'>Zmrzlina</option>
          <option value='zakusky'>Zákusky</option>
          <option value='ingrediencie'>Ingrediencie</option>
          <option value='sladkosti'>Sladkosti</option>
          <option value='alkohol'>Alkohol</option>
          <option value='ine'>Ine</option>
        </select>
      </td></tr>
      <tr><td>Nazov: </td><td><input type='text' name='nazov' /></td><td>";    
      if($save){ if(!$nazov){echo "Nezadal si nazov.";}}
      echo "</td></tr>";
      echo "<tr><td>Množstvo: </td><td><input type='number' name='mnozstvo' /></td><td>";    
      if($save){ if(!$mnozstvo){echo "Nezadal si množstvo.";}}
      echo "</td></tr>";
      echo "<tr><td>Dátum spotredy: </td><td><input type='date' name='datum_spotreby' value=".$date." /></td><td>";    
      if($save){ if(!$datum_spotreby){echo "Nezadal si dátum spotreby.";}}
      echo "</td></tr>";
      echo "<tr><td>Dátum vyroby: </td><td><input type='date' name='datum_vyroby' value=".date('Y-m-d')." /><td>";    
      if($save){ if(!$datum_vyroby){echo "Nezadal si dátum výroby.";}}
      echo "</td></tr>";
      echo "<tr><td>Umiestnenie: </td>
      <td>
        <select name='lokacia'>
          <option value='mrazak_1'>Mrazak 1</option>
          <option value='mrazak_2'>Mrazak 2</option>
          <option value='mrazak_3'>Mrazak 3</option>
          <option value='mrazak_4'>Mrazak 4</option>
          <option value='sklad'>Sklad</option>
          <option value='garaz'>Garaž</option>
          <option value='sokovacka'>Šokovačka</option>
          <option value='chladnicka_1'>Chladnička 1</option>
          <option value='chladnicka_2'>Chladnička 2</option>
          <option value='chladnicka_3'>Chladnička 3</option>
          <option value='chladnicka_4'>Chladnička 4</option>
          <option value='ine'>Ine</option>
        </select>
      </td></tr>
      <tr><td>Cena: </td><td><input type='number' name='cena' /></td><td>";    
      if($save){ if(!$cena){echo "Nezadal si cenu.";}}
      echo "</td></tr>";
      echo "<tr><td>Poznamka: </td><td><input type='text' name='poznamka' /></td></tr>
      <tr><td><input class='nice' type='submit'  name='save' value='Uložit' /></td></tr>
    </table>
  </form>";
  
  
  if($save)
  {
     if($nazov AND $mnozstvo AND $datum_spotreby AND $datum_vyroby AND $cena ) 
   {    
          if (mysqli_query($databaza,"INSERT INTO sklad (id,typ,nazov,mnozstvo,datum_spotreby,datum_vyroby,lokacia,cena,poznamka) 
              VALUES (DEFAULT, '$typ', '$nazov', '$mnozstvo', '$datum_spotreby', '$datum_vyroby', '$lokacia', '$cena', '$poznamka', '0')")) 
              {
                echo "<p>Zaznam bol pridaný.</p>";
              }
          else
              {
                echo "<p>Zaznam nebol pridaný.</p>";
              }
    }
  }
  echo"</div>";
  
 
  
  echo "
  <form action='index.php?stranka=prihlaseni&subsite=sklad&list=1&' method='GET'>
    <table> 
      <tr id='datum_objednavky'>
      <td>Dátum medzi: </td><td><input type='date' name='datum_od' value='2000-01-01' /></td>
      <td><input type='date' name='datum_do' value='2100-01-01' /><input class='nice' type='hidden' name='stranka' value='prihlaseni'/><input class='nice' type='hidden' name='subsite' value='sklad'/><input class='nice' type='hidden' name='list' value='1'/></td>
      </tr>
      </table>
      <table>
      <tr>
      <td><input id='zmrzlina' type='checkbox' name='t1' value='zmrzlina' checked><label for='zmrzlina' class='label_sklad'>Zmrzlina</label></td>
      <td><input id='zakusky' type='checkbox' name='t2' value='zakusky' checked><label for='zakusky' class='label_sklad'>Zákusky</label></td>      
      <td><input id='mrazak_1' type='checkbox' name='l1' value='mrazak_1' checked><label for='mrazak_1' class='label_sklad'>Mrazák 1</label></td>
      <td><input id='mrazak_2' type='checkbox' name='l2' value='mrazak_2' checked><label for='mrazak_2' class='label_sklad'>Mrazák 2</label></td>
      <td><input id='mrazak_3' type='checkbox' name='l3' value='mrazak_3' checked><label for='mrazak_3' class='label_sklad'>Mrazák 3</label></td>
      <td><input id='mrazak_4' type='checkbox' name='l4' value='mrazak_4' checked><label for='mrazak_4' class='label_sklad'>Mrazák 4</label></td>
      </tr>
      <tr>
      <td><input id='ingrediencie' type='checkbox' name='t3' value='ingrediencie' checked><label for='ingrediencie' class='label_sklad'>Ingrediencie</label></td>
      <td><input id='sladkosti' type='checkbox' name='t4' value='sladkosti' checked><label for='sladkosti' class='label_sklad'>Sladkosti</label></td>      
      <td><input id='chladnicka_1' type='checkbox' name='l5' value='chladnicka_1' checked><label for='chladnicka_1' class='label_sklad'>Chladnička 1</label></td>
      <td><input id='chladnicka_2' type='checkbox' name='l6' value='chladnicka_2' checked><label for='chladnicka_2' class='label_sklad'>Chladnička 2</label></td>
      <td><input id='chladnicka_3' type='checkbox' name='l7' value='chladnicka_3' checked><label for='chladnicka_3' class='label_sklad'>Chladnička 3</label></td>
      <td><input id='chladnicka_4' type='checkbox' name='l8' value='chladnicka_4' checked><label for='chladnicka_4' class='label_sklad'>Chladnička 4</label></td>
      </tr>
      <tr>
      <td><input id='alkohol' type='checkbox' name='t5' value='alkohol' checked><label for='alkohol' class='label_sklad'>Alkohol</label></td>
      <td><input id='ine' type='checkbox' name='t6' value='ine' checked><label for='ine' class='label_sklad'>Iný typ</label></td>      
      <td><input id='sklad' type='checkbox' name='l9' value='sklad' checked><label for='sklad' class='label_sklad'>Sklad</label></td>
      <td><input id='garaz' type='checkbox' name='l10' value='garaz' checked><label for='garaz' class='label_sklad'>Garaž</label></td>
      <td><input id='sokovacka' type='checkbox' name='l11' value='sokovacka' checked><label for='sokovacka' class='label_sklad'>Šokovačka</label></td>
      <td><input id='ine_miesto' type='checkbox' name='l12' value='ine' checked><label for='ine_miesto' class='label_sklad'>Iné umiestnenie</label></td>
      </tr>
      <tr><td><input class='nice' type='submit'  value='Filtrovat' /></td></tr>
    </table>
  </form>";
  
     
     echo "<table class='tabulka_sklad'>";     
     echo "<tr class='tabulka_riadok_sklad'>
              <td class='tabulka_stlpec_sklad'>";       ?><form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post"><?php echo "<input class='button_tabulka_sklad' type='submit'  name='id' value='Id' /></form></td>
              <td class='tabulka_stlpec_sklad'>";       ?><form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post"><?php echo "<input class='button_tabulka_sklad' type='submit'  name='typ' value='Typ' /></form></td>
              <td class='tabulka_stlpec_sklad_nazov'>"; ?><form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post"><?php echo "<input class='button_tabulka_sklad' type='submit'  name='nazov' value='Názov' /></form></td>
              <td class='tabulka_stlpec_sklad'>";       ?><form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post"><?php echo "<input class='button_tabulka_sklad' type='submit'  name='mnozstvo' value='Množstvo' /></form></td>
              <td class='tabulka_stlpec_sklad'>";       ?><form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post"><?php echo "<input class='button_tabulka_sklad' type='submit'  name='datum_spotreby' value='Dátum spotreby' /></form></td>
              <td class='tabulka_stlpec_sklad'>";       ?><form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post"><?php echo "<input class='button_tabulka_sklad' type='submit'  name='datum_vyroby' value='Dátum výroby' /></form></td>
              <td class='tabulka_stlpec_sklad'>";       ?><form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post"><?php echo "<input class='button_tabulka_sklad' type='submit'  name='lokacia' value='Lokácia' /></form></td>
              <td class='tabulka_stlpec_sklad'>";       ?><form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post"><?php echo "<input class='button_tabulka_sklad' type='submit'  name='cena' value='Cena' /></form></td>
              <td class='tabulka_stlpec_sklad'>";       ?><form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post"><?php echo "<input class='button_tabulka_sklad' type='submit'  name='poznamka' value='Poznámka' /></form></td>
              <td class='tabulka_stlpec_sklad'>";       ?><form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post"><?php echo "<input class='button_tabulka_sklad' type='submit'  name='stav' value='Stav' /></form></td>
            </tr>";
        

    
    
   $id1 = ($list*10)-10;                                                                                                              
    
          if ($filter_id) { $order = 'id'; }
          else if ($filter_typ) { $order = 'typ'; }     
          else if ($filter_nazov) { $order = 'nazov'; }
          else if ($filter_mnozstvo) { $order = 'mnozstvo'; }
          else if ($filter_datum_spotreby) { $order = 'datum_spotreby'; }
          else if ($filter_datum_vyroby) { $order = 'datum_vyroby'; }
          else if ($filter_lokacia) { $order = 'lokacia'; }
          else if ($filter_cena) { $order = 'cena'; }
          else if ($filter_poznamka) { $order = 'poznamka'; }
          else if ($filter_poznamka) { $order = 'stav'; }
          else { $order = 'id'; }      
          //--------------------------------------------------------
          $dotaz = mysqli_query($databaza,"
          SELECT * 
          FROM sklad 
          WHERE (datum_spotreby BETWEEN '$datum_od_new' and '$datum_do_new' )
          AND (typ = '$t1' or typ = '$t2' or typ = '$t3' or typ = '$t4' or typ = '$t5' or typ = '$t6')
          AND (lokacia = '$l1' or lokacia = '$l2' or lokacia = '$l3' or lokacia = '$l4' or lokacia = '$l5' or lokacia = '$l6' or lokacia = '$l7' or lokacia = '$l8' or lokacia = '$l9' or lokacia = '$l10' or lokacia = '$l11' or lokacia = '$l12')
          ORDER BY $order 
          LIMIT 10 OFFSET $id1 
          ");
          
          $pocet_zaznamov = mysqli_num_rows(mysqli_query($databaza,"
          SELECT * 
          FROM sklad 
          WHERE (datum_spotreby BETWEEN '$datum_od_new' and '$datum_do_new' )
          AND (typ = '$t1' or typ = '$t2' or typ = '$t3' or typ = '$t4' or typ = '$t5' or typ = '$t6')
          AND (lokacia = '$l1' or lokacia = '$l2' or lokacia = '$l3' or lokacia = '$l4' or lokacia = '$l5' or lokacia = '$l6' or lokacia = '$l7' or lokacia = '$l8' or lokacia = '$l9' or lokacia = '$l10' or lokacia = '$l11' or lokacia = '$l12')
          ORDER BY $order 
          "));     
          //treba to opravit a spravit aby sa tie stranky upravovali ako na googli napr
          while ($sklad = mysqli_fetch_array($dotaz))
           {            
             echo"<tr class='tabulka_riadok_sklad'>
              <td class='tabulka_stlpec_sklad'>".$sklad["id"]."</td>
              <td class='tabulka_stlpec_sklad'>".$sklad["typ"]."</td>
              <td class='tabulka_stlpec_sklad_nazov'>".$sklad["nazov"]."</td>
              <td class='tabulka_stlpec_sklad'>".$sklad["mnozstvo"]."</td>
              <td class='tabulka_stlpec_sklad'>".$sklad["datum_spotreby"]."</td>
              <td class='tabulka_stlpec_sklad'>".$sklad["datum_vyroby"]."</td>
              <td class='tabulka_stlpec_sklad'>".$sklad["lokacia"]."</td>
              <td class='tabulka_stlpec_sklad'>".$sklad["cena"]."€</td>
              <td class='tabulka_stlpec_sklad'>".$sklad["poznamka"]."</td>
              <td class='tabulka_stlpec_sklad'>";
                ?><form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post"><?php
                 if($sklad["stav"] == 0) {         
                    echo "<input type='checkbox' name='stav' value='1'>";}           
                 if($sklad["stav"] == 1) {         
                    echo "<input type='checkbox' name='stav' value='0' checked>";}
        echo "  
              <input type='hidden' class='hidden' name='id' value='".$sklad["id"]."' />
                  <input type='submit'  name='edit' value='Upraviť' /><input class='buttons' type='submit'  name='delete' value='Zmazať' />
                  </form></td>
            </tr>";      
           }
      echo"</table>";
          
      $pocet_zaznamov = $pocet_zaznamov/10; 
      $pocet_zaznamov = ceil($pocet_zaznamov);
        echo "<ul class='submenu_sklad'>";
          for ($i = 1; $i <= $pocet_zaznamov; $i++) {
            echo "<li class='submenu_sklad_li'><a class='submenu_sklad_a' href='index.php?stranka=prihlaseni&subsite=sklad&list=".$i."&datum_od=".$datum_od_new."&datum_do=".$datum_do_new."&t1=".$t1."&t2=".$t2."&t3=".$t3."&t4=".$t4."&t5=".$t5."&t6=".$t6."&l1=".$l1."&l2=".$l2."&l3=".$l3."&l4=".$l4."&l5=".$l5."&l6=".$l6."&l7=".$l7."&l8=".$l8."&l9=".$l9."&l10=".$l10."&l11=".$l11."&l12=".$l12."'>".$i."</a></li>";
          }
        echo "</ul>";

         }
 









