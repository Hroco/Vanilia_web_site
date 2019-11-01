<?php
$cookie_name = "vanilia_prieskum";
if(!isset($_COOKIE[$cookie_name])) {

echo "<div class='odstavec_zmrzlina'>";
        $pocet_zmrzlin = mysqli_num_rows(mysqli_query($databaza,"SELECT * FROM zmrzliny"));
           // echo "".$pocet_zmrzlin."";
  
 
 
 ?><form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post"><?php  
      
      
      echo "<table>
        <tr>
        <td>Dajte nám vediet akú zmrzlinu by ste chceli</td>
        <td><p><select name='hlasovanie_zmrzlina'>";
   
        $dotaz = mysqli_query($databaza,"SELECT * FROM zmrzliny");
 while ($zmrzliny = mysqli_fetch_array($dotaz))
      {
          echo "<option value=".$zmrzliny["id"].">";
          echo "".$zmrzliny["zmrzlina"]."";
          echo "</option>";
      }
         echo "</select></p></td>
        <td><input type='submit' name='hlasovat' value='Hlasovať' /></td>
        </tr>
      </table>
    </form>";
} else {
    $pocet_zmrzlin = mysqli_num_rows(mysqli_query($databaza,"SELECT * FROM zmrzliny"));
            $celkovy_pocet_hlasov = mysqli_num_rows(mysqli_query($databaza,"SELECT * FROM hlasovanie"));
             
             echo "<div class='odstavec_zmrzlina'>";
             
            echo "".$celkovy_pocet_hlasov." ludi hlasovalo <br>";
            
    for($pocet = 1; $pocet <= $pocet_zmrzlin; $pocet++)
    {
  
        $pocet_hlasov = mysqli_num_rows(mysqli_query($databaza,"SELECT * FROM hlasovanie WHERE id_zmrzliny='".$pocet."'"));
        $nazov_zmrzlin = mysqli_fetch_array(mysqli_query($databaza,"SELECT * FROM zmrzliny WHERE id='".$pocet."'"));
        if($pocet_hlasov != 0)
        {
        $percentualny_pocet_hlasov = round(($pocet_hlasov/$celkovy_pocet_hlasov)*100); 
        echo "".$pocet_hlasov." * ".$nazov_zmrzlin["zmrzlina"]."    ".$percentualny_pocet_hlasov."%<br>";
        }
    }
  }

if($_SESSION["opravneni"] == 2)
   {
   echo "<div>";
    ?><form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post"><?php echo "  
      <table>
        <tr>
        <td>Zmrzlina:</td>
        <td><input type='text' name='zmrzlina' /></td>
        <td><p>Typ <select name='kategoria'><option value='1'>Mliečna</option><option value='2'>Ovocná</option></select></p></td>
        <td><input type='submit' name='tlacitko' value='Uložit' /></td>
        </tr>
      </table>
    </form>";    
       $odoslat_subor = empty($_POST["tlacitko"]) ? "" : $_POST["tlacitko"];
       $zmrzlina = empty($_POST["zmrzlina"]) ? "" : mysqli_real_escape_string($databaza, $_POST["zmrzlina"]);
       $kategoria= $_POST["kategoria"];

       
        if($odoslat_subor){
          if($zmrzlina == "")
          {
           echo "Musíš zadat názov zmrzliny.";
          }
            else
            {
              mysqli_query($databaza,"INSERT INTO zmrzliny VALUES(DEFAULT, '$zmrzlina', '$kategoria')");
              echo "Zmrzlina bola pridaná.";
            }
            }
    echo "</div>";
   }

echo "<div class='zmrzlina_odstavec'>";
echo "<h1 class='nadpis'>Druhy zmrzlín</h1>"; 
echo "<ul class='mliecna'>
      <li class='mliecna_typ'>Mliečne Druhy:</li> ";

    
    
    $dotaz = mysqli_query($databaza,"SELECT * FROM zmrzliny");
      $pocitadlo = 0;
      while ($zmrzliny = mysqli_fetch_array($dotaz))
      {
        
          if($zmrzliny["kategoria"] == 1)
          {
           echo "<li class='mliecna'>";
           echo "".$zmrzliny["zmrzlina"]."";
           echo "</li>";
          }
        
        }
echo "</ul>";

echo "<ul class='ovocna'>
      <li class='ovocna_typ'>Ovocné Druhy:</li> ";

    
    
    $dotaz = mysqli_query($databaza,"SELECT * FROM zmrzliny");
      $pocitadlo = 0;
      while ($zmrzliny = mysqli_fetch_array($dotaz))
      {
        
          if($zmrzliny["kategoria"] == 2)
          {
           echo "<li class='ovocna'>";
           echo "".$zmrzliny["zmrzlina"]."";
           echo "</li>";
          }
        
        }
echo "</ul>";
      
 
echo "</div>";
echo "<div class='fotka_odstavec'>

 <img class='rotate90' src='/fotky/zmrzka.jpg' height='800' width='600' alt=''>

</div>";
echo "</div>";

?>
