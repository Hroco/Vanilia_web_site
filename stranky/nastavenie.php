<?php


    if (!isset($_SESSION["id"])) {
    $nick = empty($_POST["nick"]) ? "" : $_POST["nick"];
    $heslo = empty($_POST["heslo"]) ? "" : $_POST["heslo"];
    $tlacitko = empty($_POST["tlacitko"]) ? "" : $_POST["tlacitko"];   
    if($tlacitko) {
      $heslo = md5(md5($heslo));;
      $uzivatel = mysqli_fetch_array(mysqli_query($databaza,"SELECT * FROM uzivatelia WHERE nick='".mysqli_real_escape_string($databaza, $nick)."' AND heslo='$heslo' ;"));
      if($nick == $uzivatel["nick"] AND $heslo == $uzivatel["heslo"]) {
          session_start();
          $_SESSION["id"] = $uzivatel["id"];
          $_SESSION["nick"] = $uzivatel["nick"];
          $_SESSION["email"] = $uzivatel["email"];
          $_SESSION["opravneni"] = $uzivatel["opravneni"];
          $_SESSION["url"] = $uzivatel["url"];
          header('Refresh: 0; URL=index.php');
          exit();
      }  
      else { 
        echo "Zly Login alebo Heslo."; 
      }
    }
// .........................Formular na prihlasenie......................................  
  echo "
  
    <form action='";echo $_SERVER['REQUEST_URI'];echo"' method='post'>  
      <table>
        <tr><td>Nick:</td><td><input type=\"text\" name=\"nick\" /></td></tr>
        <tr><td>Heslo:</td><td><input type=\"password\" name=\"heslo\" /></td></tr>
        <tr><td></td><td><input type=\"submit\" name=\"tlacitko\" value=\"Přihlásit se\" /></td></tr>
      </table>
    </form>
  ";
}
else {
      echo "<p>Si prihlaseny ako ".$_SESSION["nick"]."</p>
            <p><a href='stranky/odhlas.php' class=odhlas>Odhlasit sa</a></p>";

// .........................Zmena hesla......................................
           
        echo "<div id='panel_heslo'>

              
       
              <form action='";echo $_SERVER['REQUEST_URI'];echo"' method='post'>
              <table>
              <tr>
              <td>Stare Heslo:</td>
              <td><input type='password' name='stare_heslo'/></td>
              </tr>
              <tr>
              <td>Nove Heslo:</td>
              <td><input type='password' name='heslo'/></td>
              </tr>
              <tr>
              <td>Potvrd Nove Heslo:</td>
              <td><input type='password' name='potvrd_heslo'/></td>
              </tr>
              </table> 
              <p><input type='submit' class='nice' name='zmena_hesla' value='Zmen heslo'/></p>
  		        </form></div>";
          
        if(isset($_POST["zmena_hesla"]))
              {   
            $stare = mysqli_query($databaza,"SELECT * from `uzivatelia` WHERE `id` = ".mysqli_real_escape_string($databaza, $_SESSION["id"]));
            $hesloDB = mysqli_fetch_array($stare);
            $stare_hesloDB = $hesloDB["heslo"];
            $stare_heslo = empty($_POST["stare_heslo"]) ? "" : $_POST["stare_heslo"];
            $stare_heslo = md5(md5($stare_heslo));
            $heslo = empty($_POST["heslo"]) ? "" : $_POST["heslo"];
            $potvrd_heslo = empty($_POST["potvrd_heslo"]) ? "" : $_POST["potvrd_heslo"];
            if($heslo != $potvrd_heslo){echo "hesla sa nezhoduju";}
            if($stare_heslo != $stare_hesloDB){echo "stare heslo je zle ".$stare_hesloDB." toto  ".$stare_heslo."";}
            if($heslo == $potvrd_heslo AND $stare_heslo == $stare_hesloDB)
            {
            $heslo = md5(md5($heslo));
            if (mysqli_query($databaza,"UPDATE `uzivatelia` SET `heslo` = '".$heslo."' WHERE `id` = ".mysqli_real_escape_string($databaza, $_SESSION["id"]))){echo "heslo bolo zmenene";} 
            }
          }
}
// .........................Zmena opravnenia......................................
if($_SESSION["opravneni"] == 2)
        {

         if($_POST["edit"])
              {
                $opravnenie = empty($_POST["opravnenie"]) ? "" : mysqli_real_escape_string($databaza, $_POST["opravnenie"]);
                if (mysqli_query($databaza,"UPDATE `uzivatelia` SET `opravneni` = '".$opravnenie."' WHERE `id` = ".mysqli_real_escape_string($databaza, $_POST["id"]))){} 
              }
         
// .........................Mazanie uzivatelov......................................         
         if(isset($_POST["delete"]))
        {
             if($clanok = mysqli_fetch_array(mysqli_query($databaza,"SELECT * FROM uzivatelia  WHERE id = ".mysqli_real_escape_string($databaza, $_POST["id"])))); 
             {
                 echo "<div class='odstavec_overenie'>
                 <div class='overenie_text'>Určite chcete vymazat konto tohoto uzivatela ?</div>
                 <form action='";echo $_SERVER['REQUEST_URI'];echo"' method='post'>
                 <input type='hidden' name='id' value='".$clanok["id"]."' />
                 <div class='overenie'><input type='submit' class='nice' name='ano' value='Ano' />       
                 <input type='submit' class='nice' name='nie' value='Nie' /></div>
                 </form>
                 </div>
                 <div class='medzera'></div>";
             }
        }
    if(isset($_POST["ano"]))
      {
        mysqli_query($databaza,"DELETE FROM uzivatelia  WHERE id = ".mysqli_real_escape_string($databaza, $_POST["id"]));
      }
    if(isset($_POST["nie"]))
      {
        
      }
// .........................Vypis uzivatelov......................................          
          echo "<div class='medzera'></div>";
          $dotaz = mysqli_query($databaza,"SELECT * FROM uzivatelia");
          while ($uzivatel = mysqli_fetch_array($dotaz))
           {
             echo "<form action='";echo $_SERVER['REQUEST_URI'];echo"' method='post'>";
                   if($uzivatel["opravneni"] == 1) {         
                               echo "<div class='vypis_uzivatelov'>";}           
                    if($uzivatel["opravneni"] == 2) {         
                               echo "<div class='admin_odstavec'>";}
                   
                                  
                   echo"<h1 class=vypis_uzivatelov>".$uzivatel["nick"]."</h1>
                   <p class=vypis_uzivatelov>ID:".$uzivatel["id"]." Email: " .$uzivatel["email"]." 
                   Opravnenie:<select name='opravnenie'>";           
                    if($uzivatel["opravneni"] == 1) {         
                               echo "<option value='1'>Uzivatel</option>
                                     <option value='2'>Admin</option>";}           
                    if($uzivatel["opravneni"] == 2) {         
                               echo "<option value='2'>Admin</option>
                                     <option value='1'>Uzivatel</option></select>";}
              echo"
                   <input type='submit' class='nice' name='edit' value='Edit' />  
                   <input type='submit' class='nice' name='delete' value='Zmazat' /></p>
                   <input type='hidden' class='nice' name='id' value='".$uzivatel["id"]."' />
                   </div>
                   <div class='medzera'></div>
                   </form>";
           
           }
          
          
         }
         
  
?>



  