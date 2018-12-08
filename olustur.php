<?php $baslik = 'Başlık Oluştur'; include 'templates/header.php'; ?>

<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading">Başlık Oluştur</h1>
    <p class="lead text-muted">Başlık oluştur ve anonim cevaplar al.</p>
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
              //Başlık Oluştur
              if (isset($_POST['baslik-olustur'])) {
                $zaman = date('d.m.Y H:i');
                $saat = date('H:i');
                $aylar = array(
                  'Ocak',
                  'Şubat',
                  'Mart',
                  'Nisan',
                  'Mayıs',
                  'Haziran',
                  'Temmuz',
                  'Ağustos',
                  'Eylül',
                  'Ekim',
                  'Kasım',
                  'Aralık'
                );
                $ay = $aylar[date('m') - 1];

                if (empty($_POST['baslik'])) {
                  $basarisiz = '<div class="alert alert-warning"><strong><i class="fa fa-times-circle"></i></strong> Başlık oluşturulamadı, başlık boş olamaz.</div>';
                }elseif (empty($_POST['kategori'])) {
                  $basarisiz = '<div class="alert alert-warning"><strong><i class="fa fa-times-circle"></i></strong> Başlık oluşturulamadı, kategori boş olamaz.</div>';
                }elseif (empty($_POST['detay'])) {
                  $basarisiz = '<div class="alert alert-warning"><strong><i class="fa fa-times-circle"></i></strong> Başlık oluşturulamadı, detay boş olamaz.</div>';
                }else{

                  $insert = $db->prepare('INSERT INTO vt_basliklar SET
                    vt_kullid=:kid,
                    vt_baslik=:baslik,
                    vt_kategori=:kategori,
                    vt_detay=:detay,
                    vt_tarih=:tarih,
                    vt_saat=:saat,
                    vt_durum=:durum
                    ');
                    $kaydet = $insert->execute(array(
                      'kid' => $kullanicicek['vt_id'],
                      'baslik' => htmlspecialchars($_POST['baslik']),
                      'kategori' => htmlspecialchars($_POST['kategori']),
                      'detay' => htmlspecialchars($_POST['detay']),
                      'tarih' => date('d').' '.$ay.' '.date('Y'),
                      'saat' => $saat,
                      'durum' => 1
                    ));

                    if ($kaydet) {
                      header('Location:olustur.php?durum=basarili');
                      exit;
                    }else{
                      $basarisiz = '<div class="alert alert-danger"><strong><i class="fa fa-times-circle"></i></strong> Başlık oluşturulamadı, tekrar deneyin.</div>';
                    }

                  }
                }
                echo $basarili;
                echo $basarisiz;
                if ($_GET['durum']=="basarili") {
                  header('Refresh: 3;URL=index.php');
                  echo '<div class="alert alert-success"><strong><i class="fa fa-check-circle"></i></strong> Başlık oluşturuldu, yönlendiriliyorsunuz.</div>';
                }
                ?>
                <div class="form-row">
                  <div class="col form-group">
                    <label>Başlık</label>
                    <input type="text" class="form-control" placeholder="Örn. Ne yemeliyim?" name="baslik">
                  </div> <!-- form-group end.// -->
                  <div class="col form-group">
                    <label>Kategori</label>
                    <div class="form-group">
                      <select class="form-control" name="kategori">
                        <?php $kategori = $db->query('SELECT * FROM vt_kategoriler ORDER BY vt_sira'); foreach($kategori as $kategoricek) { ?>
                          <option value="<?php echo $kategoricek['vt_id']; ?>"><?php echo $kategoricek['vt_kategori']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div> <!-- form-group end.// -->
                </div> <!-- form-row end.// -->
                <div class="form-group">
                  <label>Detay</label>
                  <textarea class="form-control" rows="3" placeholder="Detayı yazın ve ardından 'Başlık Oluştur' butonuna tıklayın." name="detay"></textarea>
                </div> <!-- form-group end.// -->
                <?php if ($_GET['durum']=="basarili") { ?>
                  <div class="form-group">
                    <button class="btn btn-primary btn-block"> Yönlendiriliyorsunuz...  </button>
                  </div>
                <?php }else{ ?>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" name="baslik-olustur"> Başlık Oluştur  </button>
                  </div> <!-- form-group// -->
                <?php } ?><!-- form-group// -->
              </form>
            </article> <!-- card-body end .// -->
          </div> <!-- card.// -->
        </div> <!-- col.//-->

      </div> <!-- row.//-->


    </div>
  </div>
</div>

<?php include 'templates/footer.php'; ?>
