<?php include 'templates/header.php'; if($kullanicicek['vt_durum']==1) { header('Location:index.php'); exit; }
?>

<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading">Yeni Kategori Ekle</h1>
    <p class="lead text-muted">Yeni kategori ekleyebilirsiniz.</p>
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
              if (isset($_POST['kategori-duzenle'])) {
                if (empty($_POST['kategori'])) {
                  $basarisiz = '<div class="alert alert-warning"><strong><i class="fa fa-times-circle"></i></strong>  Kategori eklenemedi, kategori adı boş olamaz.</div>';
                }elseif (empty($_POST['sira'])) {
                  $basarisiz = '<div class="alert alert-warning"><strong><i class="fa fa-times-circle"></i></strong>  Kategori eklenemedi, sıra boş olamaz.</div>';
                }else{
                  $update = $db->prepare('INSERT INTO vt_kategoriler SET
                    vt_kategori=:kategori,
                    vt_sira=:sira
                    ');
                    $kaydet = $update->execute(array(
                      'kategori' => htmlspecialchars($_POST['kategori']),
                      'sira' => htmlspecialchars($_POST['sira'])
                    ));
                    if ($kaydet) {
                      header('Refresh:2');
                      $basarili = '<div class="alert alert-success"><strong><i class="fa fa-check-circle"></i></strong> Kategori başarıyla eklendi.</div>';
                    }else{
                      $basarisiz = '<div class="alert alert-danger"><strong><i class="fa fa-times-circle"></i></strong> Kategori eklenemedi, tekrar deneyin.</div>';
                    }
                  }
                }

                echo $basarili;
                echo $basarisiz;
                ?>
                <div class="form-row">
                  <div class="col form-group">
                    <label>Kategori Adı</label>
                    <input type="text" class="form-control" name="kategori">
                  </div> <!-- form-group end.// -->
                  <div class="col form-group">
                    <label>Sıra</label>
                    <input type="text" class="form-control" name="sira">
                  </div> <!-- form-group end.// -->
                </div> <!-- form-row end.// -->
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block" name="kategori-duzenle"> Kategoriyi Ekle  </button>
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
