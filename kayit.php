<?php $baslik = 'Kayıt Ol'; include 'templates/header.php'; ?>

<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading">Kayıt Ol</h1>
    <p class="lead text-muted">Kayıt ol, başlık oluştur & başlık cevapla!</p>
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
              echo $basarili;
              echo $basarisiz;
              if ($_GET['durum']=="basarili") {
                header('Refresh: 3;URL=giris.php');
                echo '<div class="alert alert-success"><strong><i class="fa fa-check-circle"></i></strong> Başarıyla kayıt oldunuz, yönlendiriliyorsunuz.</div>';
              }
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
                <input type="email" class="form-control" name="eposta">
              </div> <!-- form-group end.// -->
              <div class="form-group">
                <label>Şifre</label>
                <input class="form-control" type="password" name="sifre">
              </div> <!-- form-group end.// -->
              <?php if ($_GET['durum']=="basarili") { ?>
                <div class="form-group">
                  <button class="btn btn-primary btn-block"> Yönlendiriliyorsunuz...  </button>
                </div> <!-- form-group// -->
              <?php }else{ ?>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block" name="kayit-ol"> Kayıt Ol  </button>
                </div> <!-- form-group// -->
              <?php } ?>
              <small class="text-muted">Girdiğiniz tüm bilgiler yönetici harici kimse ile paylaşılmayacaktır.</small>
            </form>
          </article> <!-- card-body end .// -->
          <div class="border-top card-body text-center">Hesabın var mı? <a href="giris.php">Giriş Yap</a></div>
        </div> <!-- card.// -->
      </div> <!-- col.//-->

    </div> <!-- row.//-->


  </div>
</div>
</div>

<?php include 'templates/footer.php'; ?>
