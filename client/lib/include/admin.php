<?php

if( strpos($_SERVER['REQUEST_URI'], "/login") === false && strpos($_SERVER['REQUEST_URI'], "/signup") === false ){
  if( strpos($_SERVER['REQUEST_URI'], "/") !== false ){
    if( !isset($_SESSION['admin']) ){
      header("Location: /login");
      exit;
    }
  }
}


?>
