<?php
  $kontrola_odoslania = empty($_POST["register"]) ? "" : $_POST["register"];
  // .........................Kontrola ci uzivatel neni uz prihlaseny....................
  // .........................Začiatok registracie......................................
  if($kontrola_odoslania)
  {
      // .........................Osetrenie premennych......................................
  $nick = empty($_POST["nick"]) ? "" : mysqli_real_escape_string($databaza, $_POST["nick"]);
  $city = empty($_POST["city"]) ? "" : mysqli_real_escape_string($databaza, $_POST["city"]);
  $street = empty($_POST["street"]) ? "" : mysqli_real_escape_string($databaza, $_POST["street"]);
  $number = empty($_POST["number"]) ? "" : mysqli_real_escape_string($databaza, $_POST["number"]);
  $phonenumber = empty($_POST["phonenumber"]) ? "" : mysqli_real_escape_string($databaza, $_POST["phonenumber"]); 
  $email = empty($_POST["email"]) ? "" : $_POST["email"];
  $heslo = empty($_POST["heslo"]) ? "" : $_POST["heslo"];
  $potvrd_heslo = empty($_POST["potvrd_heslo"]) ? "" : $_POST["potvrd_heslo"];
  $pohlavie = empty($_POST["pohlavie"]) ? "" : $_POST["pohlavie"];    
  $mail = empty($_POST["mail"]) ? "" : $_POST["mail"]; 
  $existujuci_nick = (mysqli_num_rows(mysqli_query($databaza,"SELECT `nick` FROM `uzivatelia` WHERE `nick`='".$nick."'"))) ? 1:0;
  
   if($nick AND $email AND $heslo == $potvrd_heslo AND $heslo AND !$existujuci_nick AND strlen($nick)>2 AND strlen($nick)<15 AND strlen($heslo)>3 AND filter_var($email, FILTER_VALIDATE_EMAIL)) 
   { 
  // .........................E-Mail.................................................... 
   if($mail)
     { 
      $message = "Ahoj ";
      if($pohlavie == 'z')
         {$message.= "Pani";}
        else
         {$message.= "Pan";}
          $message.=" $nick !\r\nPrave si sa zaregistroval na stranke www.vanilia.sk\r\nNižšie su uvedene tvoje prihlasovacie udaje na tento email neodpovedaj\r\n Meno:$nick  Heslo:$heslo ";
          $message = wordwrap($message, 70, "\r\n");

      if(mail($email, 'Registrácia', $message))
        {echo "<p>Email bol odoslany</p>";}                
       else                 
        {echo "<p>Email nebol odoslany</p>";}                 
      } 
   // .........................Zapisovanie udajov do databaze......................................  
     
        $heslo = md5(md5($heslo));
        $ip = $_SERVER["REMOTE_ADDR"];
          echo "<p>lol.</p>"; 
        if (mysqli_query($databaza,"INSERT INTO uzivatelia (pohlavie,nick,city,street,number,phonenumber,heslo,ip,email,opravneni) VALUES ('$pohlavie', '$nick', '$city', '$street', '$number', '$phonenumber', '$heslo', '$ip', '$email', '1')")) {
          
          echo "<p>Registracia prebehla v poriadku.</p>";
        }
        echo "<p>Registracia.</p>";  
    }else{
      echo '<style type="text/css">#id02 {display: block;}</style>';
    } 
  }
  // .........................Formular......................................   

?>

<div id="id02" class="modal">
  
  <form class="modal-content animate" action="index.php" method="post">

    <div class="container">
      <label><b>Meno</b></label>
      <input type="text" placeholder="<?php
       if($kontrola_odoslania){
            if(strlen($nick)<2){echo "Nick musi mat aspon 2 znaky.";} 
            elseif(strlen($nick)>15){echo "Nick musi mat menej ako 15 znakov.";} 
            elseif ($existujuci_nick){echo "Zadany nick je uz obsadeny.";}}
            else{echo "Zadaj meno";}
      ?>" name="nick" required>
      
      <label><b>Mesto/Obec</b></label>
      <input type="text" placeholder="Zadaj mesto/obec" name="city" required>
      
      <label><b>Ulica</b></label>
      <input type="text" placeholder="Zadaj ulicu" name="street" required>
      
      <label><b>Čislo domu</b></label>
      <input type="text" placeholder="Zadaj čislo domu" name="number" required>
      
      <label><b>Email</b></label>
      <input type="text" placeholder="<?php
       if($kontrola_odoslania){
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){echo "E-mail je napísaný nespravne.";}}
            else{echo "Zadaj emailovú adresu";}
      ?>" name="email" required>
      
      <label><b>Mobil</b></label>
      <input type="text" placeholder="Zadaj telefonne číslo" name="phonenumber" required>

      <label><b>Heslo</b></label>
      <input type="password" placeholder="<?php
       if($kontrola_odoslania){
            if(strlen($heslo)<4){echo "Heslo musi mat aspon 4 znaky.";}}
            else{echo "Zadaj heslo";}
      ?>" name="heslo" required>
      
      <label><b>Potvrď heslo</b></label>
      <input type="password" placeholder="Potvrď heslo" name="potvrd_heslo" required>
      
      <label><b>Pohlavie muž</b></label>
      <input type="radio" name="pohlavie" checked="checked" value="m" />
      <label style="background-color: white; color: black;"><b>žena</b></label>
      <input type="radio" name="pohlavie" value="z" />
            
      <input type="submit" name="register" value="Registrovať sa" class="login_form_button">  
      
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
    
    </div>
  </form>
</div>

<script>
// Get the modal

var modal2 = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it

window.onclick = function(event) {
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
}
</script>  
  
    
  