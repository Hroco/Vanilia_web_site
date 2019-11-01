<?php
  error_reporting( error_reporting() & ~E_NOTICE );
  $databaza=mysqli_connect("127.0.0.1", "root", "", "vanilia");
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
                echo "Hlas bol pridaný.";
              }
            else
              {
                 mysqli_query($databaza,"INSERT INTO hlasovanie VALUES(DEFAULT, '$hlasovanie_zmrzlina')");
                 echo "Hlas bol pridaný.<br>";
              }             
                header("Refresh:0");
      } 
      
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
        
                    case "odhlasenie": 
                    session_start();
                    session_unset();
                    session_destroy();
                    session_write_close();
                    session_regenerate_id(true);
                    header('Refresh: 0; URL=/index.php'); 
                    break;

  }
  if($refresh_galeria)
  {
   $refresh_galeria = 0;
   header('Refresh: 0; URL=index.php?stranka=galeria');
  }
     
?>     






                 