<?php
if (basename($_SERVER['PHP_SELF'])==basename(__FILE__)) {
  header('Location:../index.php');
  exit;
}

require_once 'resources/post.php';

$kullanicisor = $db->prepare('SELECT * FROM vt_kullanicilar WHERE vt_eposta=:eposta');
$kullanicisor->execute(array(
  'eposta' => $_SESSION['eposta']
));

$sorgula = $kullanicisor->rowCount();

if(basename($_SERVER['PHP_SELF'])=="giris.php") {

  if ($sorgula==1) {

    header("Location:index.php");
    exit;

  }

}elseif(basename($_SERVER['PHP_SELF'])=="kayit.php") {

  if ($sorgula==1) {

    header("Location:index.php");
    exit;

  }

}elseif(basename($_SERVER['PHP_SELF'])=="olustur.php") {

  if ($sorgula==0) {

    header("Location:giris.php");
    exit;

  }

}elseif(basename($_SERVER['PHP_SELF'])=="profil.php") {

  if ($sorgula==0) {

    header("Location:giris.php");
    exit;

  }

}elseif(basename($_SERVER['PHP_SELF'])=="actiginiz-basliklar.php") {

  if ($sorgula==0) {

    header("Location:giris.php");
    exit;

  }

}

$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="https://getbootstrap.com/favicon.ico">

  <title>ASS</title>

  <!-- Bootstrap core CSS -->
  <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="https://getbootstrap.com/docs/4.1/examples/album/album.css" rel="stylesheet">

  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

  <header>
    <div class="navbar navbar-dark bg-dark shadow-sm">
      <div class="container d-flex justify-content-between">
        <a href="index.php" class="navbar-brand d-flex align-items-center">
          <i class="fa fa-user-secret"></i>
          <strong>ASS</strong>
        </a>
        <?php if($sorgula!=1) { ?>
          <a href="giris.php" class="btn btn-primary my-2 my-sm-0" style="color:white">Giriş Yap veya Kayıt Ol</a>
        <?php } elseif($sorgula==1) { ?>
          <ul>
            <a href="olustur.php" class="btn btn-warning my-2 my-sm-0 btn-sm" style="color:white;"><i class="fa fa-plus"></i></a>
            <a href="profil.php" class="btn btn-warning my-2 my-sm-0 btn-sm" style="color:white;"><i class="fa fa-user"></i></a>
			<a href="actiginiz-basliklar.php" class="btn btn-warning my-2 my-sm-0 btn-sm" style="color:white;"><i class="fa fa-list"></i></a>
            <a href="resources/quit.php" class="btn btn-warning btn-sm" style="color:white"><i class="fa fa-power-off"></i></a>
            <?php if ($kullanicicek['vt_durum']==2) { ?>
                <a href="admin-kullanicilar.php" class="btn btn-danger my-2 my-sm-0 btn-sm" style="color:white;"><i class="fa fa-users"></i></a>
                <a href="admin-basliklar.php" class="btn btn-danger my-2 my-sm-0 btn-sm" style="color:white;"><i class="fa fa-list"></i></a>
                <a href="admin-kategoriler.php" class="btn btn-danger my-2 my-sm-0 btn-sm" style="color:white;"><i class="fa fa-tag"></i></a>
            <?php } ?>
          </ul>
        <?php } ?>
      </div>
    </div>
  </header>

  <main role="main">
