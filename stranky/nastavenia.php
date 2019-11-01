<?php


    if (isset($_SESSION["id"])) {


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

  
?>



  