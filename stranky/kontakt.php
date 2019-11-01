<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDyCh2DnhHBdTmr1AWR5juXsDRNLkIaUhs&callback=myMap"></script>
      
      <script>
         function loadMap() {
			
            var mapOptions = {
               center:new google.maps.LatLng(48.368452,  17.895661), zoom:17,
               mapTypeId:google.maps.MapTypeId.ROADMAP
            };
				
            var map = new google.maps.Map(document.getElementById("sample"),mapOptions);
         }
      </script>
<?php
echo "<div class='odstavec_kontakt'>";
echo "<h1 class='nadpis'>Kontakt</h1>"; 
echo "<p>Adresa:</p>";
echo "<p>Dolná dedina 706, 951 21 Rišnovce,  Slovensko.</p>"; 
echo "<p>Mobil:</p>";
echo "<p>+421 907 371 032</p>";
echo "<p>Email:</p>";
echo "<p>vanillia706@gmail.com</p>";
echo "


      <div id = 'sample' ></div>

   </div> ";
   
?>   