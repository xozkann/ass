<?php $baslik = 'Giriş Yap'; include 'templates/header.php'; ?>

      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Giriş Yap</h1>
          <p class="lead text-muted">Giriş yap ve anonim biri olarak takıl!</p>
        </div>
      </section>

      <div class="album py-5 bg-light">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-6">
              <div class="card">
                <article class="card-body">
                  <form method="post">
                    <?php echo $basarisiz; ?>
                    <div class="form-group">
                      <label>E-Posta Adresi</label>
                      <input type="email" class="form-control" name="eposta">
                    </div> <!-- form-group end.// -->
                    <div class="form-group">
                      <label>Şifre</label>
                      <input class="form-control" type="password" name="sifre">
                    </div> <!-- form-group end.// -->
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block" name="giris-yap"> Giriş Yap  </button>
                    </div> <!-- form-group// -->
                  </form>
                </article> <!-- card-body end .// -->
                <div class="border-top card-body text-center">Hesabın yok mu? <a href="kayit.php">Kayıt Ol</a></div>
              </div> <!-- card.// -->
            </div> <!-- col.//-->

          </div> <!-- row.//-->


        </div>
        </div>
      </div>

    <?php include 'templates/footer.php'; ?>
