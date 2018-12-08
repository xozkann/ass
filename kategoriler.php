<?php include 'templates/header.php'; ?>
<?php
$iceriksor = $db->prepare('SELECT * FROM vt_kategoriler WHERE vt_id=:id');
$iceriksor->execute(array(
  'id' => $_GET['id']
));
$icerikcek = $iceriksor->fetch(PDO::FETCH_ASSOC);
if($_GET['id']!=$icerikcek['vt_id']) {
  header('Location:index.php');
  exit;
}
?>
<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading"><?php if ($icerikcek['vt_kategori']=="") { header('Location:index.php');
      exit; } ?><?php echo $icerikcek['vt_kategori']; ?></h1>
      <p class="lead text-muted">adlı kategori altında tüm başlıklar.</p>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
        <?php
        $sayfada = 4; // sayfada gösterilecek içerik miktarını belirtiyoruz.


        $sorgu=$db->prepare("select * from vt_basliklar WHERE vt_kategori = {$icerikcek['vt_id']}");
        $sorgu->execute();
        $toplam_icerik=$sorgu->rowCount();

        $toplam_sayfa = ceil($toplam_icerik / $sayfada);

        // eğer sayfa girilmemişse 1 varsayalım.
        $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;

        // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
        if($sayfa < 1) $sayfa = 1;

        // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
        if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;

        $limit = ($sayfa - 1) * $sayfada;

        $iceriksor=$db->prepare("select * from vt_basliklar WHERE vt_kategori = {$icerikcek['vt_id']} order by vt_id DESC limit $limit,$sayfada");
        $iceriksor->execute();
        $ssaaa = $sorgu->rowCount();
        if ($ssaaa==0) {
          echo '<div class="col-md-12"><div class="alert alert-warning">Herhangi bir içerik bulunamadı!</div></div>';
        }
        while($icerikcek=$iceriksor->fetch(PDO::FETCH_ASSOC)) {

          ?>

          <div class="col-md-12">
            <div class="card mb-4 shadow-sm">
              <div class="card-body">
                <p class="card-text"><b><?php echo $icerikcek['vt_baslik']; ?></b></p>
                <p class="text-muted"><?php if(strlen($icerikcek['vt_detay'])>="255") { echo substr($icerikcek['vt_detay'], 0, 255).'...'; }else{ echo $icerikcek['vt_detay']; } ?></p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <a href="baslik-detay.php?id=<?php echo $icerikcek['vt_id']; ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-eye"></i> İncele</a>
                  </div>
                  <small class="text-muted"><i class="fa fa-calendar-o"></i> <?php echo $icerikcek['vt_tarih']; ?> - <i class="fa fa-clock-o"></i> <?php echo $icerikcek['vt_saat']; ?> | <i class="fa fa-tag"></i>
                    <?php $ssor = $db->prepare('SELECT * FROM vt_kategoriler WHERE vt_id=:kategori');
                    $ssor->execute(array(
                      'kategori' => $icerikcek['vt_kategori']
                    ));
                    $sscek = $ssor->fetch(PDO::FETCH_ASSOC); if($sscek['vt_kategori']=="") { echo 'Kategori bulunamadı'; }else { echo $sscek['vt_kategori']; } ?></small>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
        <div>
          <?php

          $s=0;

          while ($s < $toplam_sayfa) {

            $s++; ?>

            <?php

            if ($s==$sayfa) {?>
              <label class="btn btn-secondary active">
                <a href="kategori.php?sayfa=<?php echo $s; ?>" style="color:white"> <?php echo $s; ?> </a>
              </label>
            <?php } else {?>
              <label class="btn btn-secondary">
                <a href="kategori.php?sayfa=<?php echo $s; ?>" style="color:white"> <?php echo $s; ?> </a>
              </label>
            <?php   }

          }

          ?>
        </div>
      </div>
    </div>

    <?php include 'templates/footer.php'; ?>
