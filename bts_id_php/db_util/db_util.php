<?php
function createConnection(){
  $link = new PDO("mysql:host=localhost; dbname=prakpwl20194","root","");
  $link->setAttribute(PDO::ATTR_AUTOCOMMIT,false);
  $link->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  return $link;  
}

function closeConnection(PDO $link){
    if($link != null){
        $link = null;
    }
}
?>