<?php
ob_start();
if(!isset($_SESSION)) : session_start(); endif;
try {

  date_default_timezone_set('Europe/Istanbul');
  $db = NEW PDO('mysql:host=localhost;dbname=vt adı;charset=utf8', 'vt kadı', 'vt sifre');

} catch (\Exception $e) {

  echo 'Hata: '.$e->getMessage();

}
?>
