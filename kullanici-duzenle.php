<?php include 'templates/header.php'; if($kullanicicek['vt_durum']==1) { header('Location:index.php'); exit; }
$ksor = $db->prepare('SELECT * FROM vt_kullanicilar WHERE vt_id=:id');
$ksor->execute(array(
  'id' => $_GET['id']
));
$kcek = $ksor->fetch(PDO::FETCH_ASSOC);
?>

<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading"><?php echo $kcek['vt_isim'].' '.$kcek['vt_soyisim']; ?></h1>
    <p class="lead text-muted"><?php echo $kcek['vt_id']; ?> numaralı kullanıcıyı düzenliyorsunuz.</p>
  </div>
</section>

<div class="album py-5 bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <article class="card-body">
            <form method="post">
              <?php
              //Profil Düzenle
              if (isset($_POST['kullanici-duzenle'])) {
                if (empty($_POST['isim'])) {
                  $basarisiz = '<div class="alert alert-warning"><strong><i class="fa fa-times-circle"></i></strong>  Kullanıcı düzenlenemedi, isim boş olamaz.</div>';
                }elseif (empty($_POST['soyisim'])) {
                  $basarisiz = '<div class="alert alert-warning"><strong><i class="fa fa-times-circle"></i></strong>  Kullanıcı düzenlenemedi, soyisim boş olamaz.</div>';
                }elseif (empty($_POST['eposta'])) {
                  $basarisiz = '<div class="alert alert-warning"><strong><i class="fa fa-times-circle"></i></strong>  Kullanıcı düzenlenemedi, eposta boş olamaz.</div>';
                }elseif (empty($_POST['sifre'])) {
                  $update = $db->prepare('UPDATE vt_kullanicilar SET
                    vt_isim=:isim,
                    vt_soyisim=:soyisim,
                    vt_eposta=:eposta
                    WHERE vt_id = '.$kcek['vt_id'].'');
                    $kaydet = $update->execute(array(
                      'isim' => htmlspecialchars($_POST['isim']),
                      'soyisim' => htmlspecialchars($_POST['soyisim']),
                      'eposta' => htmlspecialchars($_POST['eposta'])
                    ));
                    if ($kaydet) {
                      header('Refresh:2');
                      $basarili = '<div class="alert alert-success"><strong><i class="fa fa-check-circle"></i></strong> Kullanıcı başarıyla düzenlendi.</div>';
                    }else{
                      $basarisiz = '<div class="alert alert-danger"><strong><i class="fa fa-times-circle"></i></strong> Kullanıcı düzenlenemedi, tekrar deneyin.</div>';
                    }
                  }else{
                    $update = $db->prepare('UPDATE vt_kullanicilar SET
                      vt_isim=:isim,
                      vt_soyisim=:soyisim,
                      vt_eposta=:eposta,
                      vt_sifre=:sifre,
                      vt_durum=:durum
                      WHERE vt_id = '.$kcek['vt_id'].'');
                      $kaydet = $update->execute(array(
                        'isim' => htmlspecialchars($_POST['isim']),
                        'soyisim' => htmlspecialchars($_POST['soyisim']),
                        'eposta' => htmlspecialchars($_POST['eposta']),
                        'sifre' => htmlspecialchars(md5($_POST['sifre'])),
                        'durum' => htmlspecialchars($_POST['durum'])
                      ));
                      if ($kaydet) {
                        $basarili = '<div class="alert alert-success"><strong><i class="fa fa-check-circle"></i></strong> Kullanıcı başarıyla düzenlendi.</div>';
                      }else{
                        $basarisiz = '<div class="alert alert-danger"><strong><i class="fa fa-times-circle"></i></strong> Kullanıcı düzenlenemedi, tekrar deneyin.</div>';
                      }
                    }
                  }
                  echo $basarili;
                  echo $basarisiz;
                  ?>
                  <div class="form-row">
                    <div class="col form-group">
                      <label>İsim</label>
                      <input type="text" class="form-control" name="isim" value="<?php echo $kcek['vt_isim'] ?>">
                    </div> <!-- form-group end.// -->
                    <div class="col form-group">
                      <label>Soyisim</label>
                      <input type="text" class="form-control" name="soyisim" value="<?php echo $kcek['vt_soyisim'] ?>">
                    </div> <!-- form-group end.// -->
                  </div> <!-- form-row end.// -->
                  <div class="form-group">
                    <label>E-Posta Adresi</label>
                    <input type="email" class="form-control" name="eposta" value="<?php echo $kcek['vt_eposta'] ?>">
                  </div> <!-- form-group end.// -->
                  <div class="form-group">
                    <label>Şifre</label>
                    <input class="form-control" type="password" name="sifre">
                    <small class="text-muted">Boş bırakırsanız şifre değişmez.</small>
                  </div> <!-- form-group end.// -->
                  <div class="col form-group">
                    <label>Yetki</label>
                    <div class="form-group">
                      <select class="form-control" name="durum">
                        <?php if($kcek['vt_durum']==1){ ?>
                          <option value="1" selected>1</option>
                          <option value="2">2</option>
                        <?php }else{ ?>
                          <option value="1">1</option>
                          <option value="2" selected>2</option>
                        <?php } ?>
                      </select>
                    </div>
                  </div> <!-- form-group end.// -->
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" name="kullanici-duzenle"> Kullanıcıyı Düzenle  </button>
                  </div> <!-- form-group// -->
                </form>
              </article> <!-- card-body end .// -->
            </div> <!-- card.// -->
          </div> <!-- col.//-->

        </div> <!-- row.//-->


      </div>
    </div>
  </div>

  <?php include 'templates/footer.php'; ?>
