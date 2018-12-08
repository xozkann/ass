<?php include 'templates/header.php'; if($kullanicicek['vt_durum']==1) { header('Location:index.php'); exit; }
$ksor = $db->prepare('SELECT * FROM vt_basliklar WHERE vt_id=:id');
$ksor->execute(array(
  'id' => $_GET['id']
));
$kcek = $ksor->fetch(PDO::FETCH_ASSOC);
?>

<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading"><?php echo $kcek['vt_baslik']; ?></h1>
    <p class="lead text-muted"><?php echo $kcek['vt_id']; ?> numaralı başlığı düzenliyorsunuz.</p>
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
              if (isset($_POST['baslik-duzenle'])) {
                if (empty($_POST['baslik'])) {
                  $basarisiz = '<div class="alert alert-warning"><strong><i class="fa fa-times-circle"></i></strong>  Başlık düzenlenemedi, başlık boş olamaz.</div>';
                }elseif (empty($_POST['kategori'])) {
                  $basarisiz = '<div class="alert alert-warning"><strong><i class="fa fa-times-circle"></i></strong>  Başlık düzenlenemedi, kategori boş olamaz.</div>';
                }elseif (empty($_POST['detay'])) {
                  $basarisiz = '<div class="alert alert-warning"><strong><i class="fa fa-times-circle"></i></strong>  Başlık düzenlenemedi, detay boş olamaz.</div>';
                }else{
                  $update = $db->prepare('UPDATE vt_basliklar SET
                    vt_baslik=:baslik,
                    vt_kategori=:kategori,
                    vt_detay=:detay
                    WHERE vt_id = '.$kcek['vt_id'].'');
                    $kaydet = $update->execute(array(
                      'baslik' => htmlspecialchars($_POST['baslik']),
                      'kategori' => htmlspecialchars($_POST['kategori']),
                      'detay' => htmlspecialchars($_POST['detay'])
                    ));
                    if ($kaydet) {
                      header('Refresh:2');
                      $basarili = '<div class="alert alert-success"><strong><i class="fa fa-check-circle"></i></strong> Başlık başarıyla düzenlendi.</div>';
                    }else{
                      $basarisiz = '<div class="alert alert-danger"><strong><i class="fa fa-times-circle"></i></strong> Başlık düzenlenemedi, tekrar deneyin.</div>';
                    }
                  }
                }
              echo $basarili;
              echo $basarisiz;
              ?>
              <div class="form-row">
                <div class="col form-group">
                  <label>Başlık</label>
                  <input type="text" class="form-control" placeholder="Örn. Ne yemeliyim?" name="baslik" value="<?php echo $kcek['vt_baslik']; ?>">
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
                <textarea class="form-control" rows="3" placeholder="Detayı yazın ve ardından 'Başlığı Düzenle' butonuna tıklayın." name="detay"><?php echo $kcek['vt_detay']; ?></textarea>
              </div> <!-- form-group end.// -->
              <div class="form-group">
                <button type="submit" name="baslik-duzenle" class="btn btn-primary btn-block"> Başlığı Düzenle  </button>
              </div>
            </form>
          </article> <!-- card-body end .// -->
        </div> <!-- card.// -->
      </div> <!-- col.//-->

    </div> <!-- row.//-->


  </div>
</div>
</div>

<?php include 'templates/footer.php'; ?>
