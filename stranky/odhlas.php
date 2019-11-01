<?php
// .........................Odhlasenie.....................................
      session_start();
      session_unset();
      session_destroy();
      session_write_close();
      session_regenerate_id(true);
      header('Refresh: 0; URL=/index.php');
      
?>