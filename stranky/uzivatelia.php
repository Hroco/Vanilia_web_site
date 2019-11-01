<?php

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
                 "; ?><form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post"><?php echo "
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
              ?><form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post"><?php 
                   if($uzivatel["opravneni"] == 1) {         
                               echo "<div class='vypis_uzivatelov'>";}           
                    if($uzivatel["opravneni"] == 2) {         
                               echo "<div class='admin_odstavec'>";}
                   
                                  
                   echo"<h1 class=vypis_uzivatelov>".$uzivatel["nick"]."</h1>
                   <p class=vypis_uzivatelov>
                   <b>ID:</b>".$uzivatel["id"]." 
                   <b>Email</b>:" .$uzivatel["email"]." 
                   <b>Telefon:</b>" .$uzivatel["phonenumber"]."</p>
                    
                   <p class=vypis_uzivatelov>
                   <b>Mesto:</b>" .$uzivatel["city"]." 
                   <b>Ulica:</b>" .$uzivatel["street"]." 
                   <b>Číslo:</b>" .$uzivatel["number"]."</p>
                    
                   <p class=vypis_uzivatelov>
                   <b>Opravnenie:</b><select name='opravnenie'>";           
                    if($uzivatel["opravneni"] == 1) {         
                               echo "<option value='1'>Uzivatel</option>
                                     <option value='2'>Admin</option></select>";}           
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



  