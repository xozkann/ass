<?php
require_once 'connect.php';

//Giriş Yap
if (isset($_POST['giris-yap'])) {
  $eposta = $_POST['eposta'];
  $sifre = md5($_POST['sifre']);

  if ($eposta && $sifre) {
    $kullanicisor=$db->prepare("SELECT * from vt_kullanicilar where vt_eposta=:eposta and vt_sifre=:sifre");
    $kullanicisor->execute(array(
      'eposta' => $eposta,
      'sifre' => $sifre
    ));

    $say=$kullanicisor->rowCount();

    if ($say>0) {

      $_SESSION['eposta'] = $eposta;


      header('Location:index.php');


    } else {

      $basarisiz = '<div class="alert alert-danger"><strong><i class="fa fa-times-circle"></i></strong> Giriş işlemi başarısız, eposta veya şifre yanlış.</div>';

    }
  }
}

//Kayıt Ol
if (isset($_POST['kayit-ol'])) {

  $kullanicisor=$db->prepare("SELECT * from vt_kullanicilar where vt_eposta=:eposta");
  $kullanicisor->execute(array(
    'eposta' => $_POST['eposta']
  ));

  $say=$kullanicisor->rowCount();

  if ($say==1) {
    $basarisiz = '<div class="alert alert-warning"><strong><i class="fa fa-times-circle"></i></strong> Kayıt olma işlemi başarısız, bu eposta zaten kayıtlı.</div>';
  }elseif (empty($_POST['isim'])) {
    $basarisiz = '<div class="alert alert-warning"><strong><i class="fa fa-times-circle"></i></strong> Kayıt olma işlemi başarısız, isim boş olamaz.</div>';
  }elseif (empty($_POST['soyisim'])) {
    $basarisiz = '<div class="alert alert-warning"><strong><i class="fa fa-times-circle"></i></strong> Kayıt olma işlemi başarısız, soyisim boş olamaz.</div>';
  }elseif (empty($_POST['eposta'])) {
    $basarisiz = '<div class="alert alert-warning"><strong><i class="fa fa-times-circle"></i></strong> Kayıt olma işlemi başarısız, eposta boş olamaz.</div>';
  }elseif (empty($_POST['sifre'])) {
    $basarisiz = '<div class="alert alert-warning"><strong><i class="fa fa-times-circle"></i></strong> Kayıt olma işlemi başarısız, şifre boş olamaz.</div>';
  }else{

    $insert = $db->prepare('INSERT INTO vt_kullanicilar SET
      vt_isim=:isim,
      vt_soyisim=:soyisim,
      vt_eposta=:eposta,
      vt_sifre=:sifre,
      vt_durum=:durum
      ');
      $kaydet = $insert->execute(array(
        'isim' => htmlspecialchars($_POST['isim']),
        'soyisim' => htmlspecialchars($_POST['soyisim']),
        'eposta' => htmlspecialchars($_POST['eposta']),
        'sifre' => htmlspecialchars(md5($_POST['sifre'])),
        'durum' => 1
      ));

      if ($kaydet) {
        header('Location:kayit.php?durum=basarili');
        exit;
      }else{
        $basarisiz = '<div class="alert alert-danger"><strong><i class="fa fa-times-circle"></i></strong> Kayıt olma işlemi başarısız, tekrar deneyin.</div>';
      }

    }
  }
  ?>
