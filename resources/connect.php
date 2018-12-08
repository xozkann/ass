<?php
ob_start();
if(!isset($_SESSION)) : session_start(); endif;
try {

  date_default_timezone_set('Europe/Istanbul');
  $db = NEW PDO('mysql:host=localhost;dbname=ass;charset=utf8', 'root', 'Sananelan2003!');

} catch (\Exception $e) {

  echo 'Hata: '.$e->getMessage();

}
?>
