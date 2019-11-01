
<?php
    if (!isset($_SESSION["id"])) { 
    $tlacitko = empty($_POST["login"]) ? "" : $_POST["login"];   
    if($tlacitko) {
      $nick = empty($_POST["nick"]) ? "" : $_POST["nick"];
       $heslo = empty($_POST["heslo"]) ? "" : $_POST["heslo"];
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
}
?>



  