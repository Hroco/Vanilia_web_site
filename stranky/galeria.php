<script>
function openKCFinder(field) {
    window.KCFinder = {
        callBack: function(url) {
            field.value = url;
            window.KCFinder = null;
        }
    };
    window.open('/kcfinder/browse.php?type=files&dir=files/public', 'kcfinder_textbox',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=800, height=600'
    );
}
</script>

<?php


 if($_SESSION["opravneni"] == 2)
   {
   echo "<div class='odstavec_small'>";
?>                          
        
        
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
        <input type="text" readonly="readonly" name="subor" onclick="openKCFinder(this)"
        value="Click here" style="width:600px;cursor:pointer" />
        <input type="submit" name="odoslat_subor" value="upload" /> 
        </form>
        
<?php
       
       $odoslat_subor = empty($_POST["odoslat_subor"]) ? "" : $_POST["odoslat_subor"];
       $url = empty($_POST["subor"]) ? "" : $_POST["subor"];
         
       $path_parts = pathinfo($_SERVER["DOCUMENT_ROOT"].$url);
    
       
      $name_thumb = $path_parts['basename'];
      $url_thumb = '/kcfinder/upload/.thumbs/files/'.$name_thumb ;
       
        if($odoslat_subor)
          if($url == "Click here")
          {
           echo "Musiš vybrat fotku.";
          }
            else
            {
              mysqli_query($databaza,"INSERT INTO fotky VALUES(DEFAULT, '$url_thumb', '$url')");
            }
    echo "</div>";
   }
?>



<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>

<link  href="/fancybox/dist/jquery.fancybox.min.css" rel="stylesheet">
<script src="/fancybox/dist/jquery.fancybox.min.js"></script>

<?php
//echo "<a class='fancybox' rel='group' href='fotky/slide_1_big.jpg'><img src='fotky/slide_1_small.jpg' width='".$sirka2."' height='".$vyska2."' alt='' /></a>";

// .........................Mazanie obrazkov......................................
 
    
 echo "<div class='odstavec_galeria'>";
    
    if(isset($_POST["vymazat"]))
        {
        $refresh_galeria = 0;
             if($obrazok = mysqli_fetch_array(mysqli_query($databaza,"SELECT * FROM fotky  WHERE id = ".mysqli_real_escape_string($databaza, $_POST["id"])))); 
             {
             echo "<div class='odstavec'>
                 <div class='overenie_text'>Určite chcete vymazat tuto fotku ?</div>                
                 "; ?><form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>"><?php echo "                
                 <input type='hidden' name='id' value='".$obrazok["id"]."' />
                 <div class='overenie'><input class='nice' type='submit'  name='ano' value='Ano' />       
                 <input class='nice' type='submit'  name='nie' value='Nie' /></div>
                 </form>
                 </div>
                 <div class='medzera'></div>";
             }
        }
    if(isset($_POST["ano"]))
      {
      mysqli_query($databaza,"DELETE FROM fotky  WHERE id = ".mysqli_real_escape_string($databaza, $_POST["id"]));
      }
    if(isset($_POST["nie"]))
      {
      $refresh_galeria = 1;
      }

// .........................Vypis obrazkov......................................    
    
    $dotaz = mysqli_query($databaza,"SELECT * FROM fotky");
      $pocitadlo = 0;
      while ($obrazok = mysqli_fetch_array($dotaz))
      {
          if (file_exists($_SERVER["DOCUMENT_ROOT"].$obrazok["url"])) 
           {    
              list($sirka, $vyska) = getimagesize($_SERVER["DOCUMENT_ROOT"].$obrazok["url"]);
             
            //  if ($(window).width() < 960)

               
               $vyska2 = 200;
               $sirka2 = (($vyska2*$sirka)/$vyska);
              if($sirka2 < 375)
             {
               echo "
                 <div class='galeria'>
                <a data-fancybox='gallery' href='".$obrazok["url"]."'>
                <img src='".$obrazok["url_thumb"]."' 
                 class='img_galeria_s'
                 style='width: 249px; 
                  ' alt=''>
                </a>";
             } 
               else 
                {
                  echo "
                 <div class='galeria'>
                <a data-fancybox='gallery' href='".$obrazok["url"]."'>
                <img src='".$obrazok["url_thumb"]."'
                class='img_galeria_b' 
                 style='width: 500px;
                  ' alt=''>
                </a>";
                }   
          
              
             if($_SESSION["opravneni"] == 2)
             {       
               ?><form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>"><?php echo "
                    <input name='id' type='hidden' value='".$obrazok["id"]."' />
                    <input class='galeria' type='submit'  name='vymazat' value='vymazat' />
                    </form>";      
             }
             echo "</div>";
        }
         else 
         {
          mysqli_query($databaza,"DELETE FROM fotky  WHERE id = ".mysqli_real_escape_string($databaza, $obrazok["id"]));
         }      
           
    } 
			echo "</div>";
?>
              