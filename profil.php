<?php $baslik = 'Profil'; include 'templates/header.php'; ?>

<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading">Profil</h1>
    <p class="lead text-muted">Profilini tekrardan düzenleyebilirsin.</p>
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
              if (isset($_POST['profil-duzenle'])) {
                if (empty($_POST['isim'])) {
                  $basarisiz = '<div class="alert alert-warning"><strong><i class="fa fa-times-circle"></i></strong>  Profil düzenlenemedi, isim boş olamaz.</div>';
                }elseif (empty($_POST['soyisim'])) {
                  $basarisiz = '<div class="alert alert-warning"><strong><i class="fa fa-times-circle"></i></strong>  Profil düzenlenemedi, soyisim boş olamaz.</div>';
                }elseif (empty($_POST['sifre'])) {
                  $update = $db->prepare('UPDATE vt_kullanicilar SET
                    vt_isim=:isim,
                    vt_soyisim=:soyisim
                    WHERE vt_id = '.$kullanicicek['vt_id'].'');
                    $kaydet = $update->execute(array(
                      'isim' => htmlspecialchars($_POST['isim']),
                      'soyisim' => htmlspecialchars($_POST['soyisim'])
                    ));
                    if ($kaydet) {
                      $basarili = '<div class="alert alert-success"><strong><i class="fa fa-check-circle"></i></strong> Profil başarıyla düzenlendi.</div>';
                    }else{
                      $basarisiz = '<div class="alert alert-danger"><strong><i class="fa fa-times-circle"></i></strong> Profil düzenlenemedi, tekrar deneyin.</div>';
                    }
                  }else{
                    $update = $db->prepare('UPDATE vt_kullanicilar SET
                      vt_isim=:isim,
                      vt_soyisim=:soyisim,
                      vt_sifre=:sifre
                      WHERE vt_id = '.$kullanicicek['vt_id'].'');
                      $kaydet = $update->execute(array(
                        'isim' => htmlspecialchars($_POST['isim']),
                        'soyisim' => htmlspecialchars($_POST['soyisim']),
                        'sifre' => htmlspecialchars(md5($_POST['sifre']))
                      ));
                      if ($kaydet) {
                        $basarili = '<div class="alert alert-success"><strong><i class="fa fa-check-circle"></i></strong> Profil başarıyla düzenlendi.</div>';
                      }else{
                        $basarisiz = '<div class="alert alert-danger"><strong><i class="fa fa-times-circle"></i></strong> Profil düzenlenemedi, tekrar deneyin.</div>';
                      }
                    }
                  }
                  echo $basarili;
                  echo $basarisiz;
                  ?>
                  <div class="form-row">
                    <div class="col form-group">
                      <label>İsim</label>
                      <input type="text" class="form-control" name="isim">
                    </div> <!-- form-group end.// -->
                    <div class="col form-group">
                      <label>Soyisim</label>
                      <input type="text" class="form-control" name="soyisim">
                    </div> <!-- form-group end.// -->
                  </div> <!-- form-row end.// -->
                  <div class="form-group">
                    <label>E-Posta Adresi</label>
                    <input type="email" class="form-control" value="<?php echo $kullanicicek['vt_eposta']; ?>" disabled>
                  </div> <!-- form-group end.// -->
                  <div class="form-group">
                    <label>Şifre</label>
                    <input class="form-control" type="password" name="sifre">
                    <small class="text-muted">Şifrenizi değiştirmek istemiyorsanız boş bırakın.</small>
                  </div> <!-- form-group end.// -->
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" name="profil-duzenle"> Profili Düzenle  </button>
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
