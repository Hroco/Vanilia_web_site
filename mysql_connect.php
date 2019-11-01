<?php
  error_reporting( error_reporting() & ~E_NOTICE );
  $databaza=mysqli_connect("sql2.webzdarma.cz", "vaniliawzsk2099", "APrthro2", "vaniliawzsk2099");
  session_start();
  $hlasovat = empty($_POST["hlasovat"]) ? "" : $_POST["hlasovat"];
  $hlasovanie_zmrzlina= $_POST["hlasovanie_zmrzlina"];
  if($hlasovat)
      {       
            $cookie_name = "vanilia_prieskum";
            $cookie_value = 1;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            if($hlasovanie_zmrzlina == "")
              {
                mysqli_query($databaza,"INSERT INTO hlasovanie VALUES(DEFAULT, '1')");
              }
            else
              {
                 mysqli_query($databaza,"INSERT INTO hlasovanie VALUES(DEFAULT, '$hlasovanie_zmrzlina')");
              }             
                header("Refresh:0");
      }   
?>     






                 