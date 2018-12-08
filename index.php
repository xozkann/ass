<?php include 'templates/header.php'; ?>
  
  <!-- -->
  <section class="jumbotron text-center">
    <div class="container">
      <?php if($sorgula==0) { ?>
        <h1 class="jumbotron-heading">Hoşgeldin ziyaretçi,</h1>
        <p class="lead text-muted">kayıt ol ve başlık oluşturup cevaplar almaya başla.</p>
      <?php }elseif($sorgula==1) { ?>
        <h1 class="jumbotron-heading">Hoşgeldin <?php echo $kullanicicek['vt_isim']; ?>,</h1>
        <p class="lead text-muted">başlık oluşturup cevaplar almaya başla.</p>
      <?php } ?>
    </div>
  </section>

  <!-- -->
  <section id="anonim">
  <div class="py-5 bg-light">
    <div class="container">
    <div class="row">
      
      <div class="col-md-8">
        
        <!-- -->
		<?php
          $sayfada = 4; // sayfada gösterilecek içerik miktarını belirtiyoruz.


          $sorgu=$db->prepare("select * from vt_basliklar");
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

          $iceriksor=$db->prepare("select * from vt_basliklar order by vt_id DESC limit $limit,$sayfada");
          $iceriksor->execute();
          $ssaaa = $sorgu->rowCount();
          if ($ssaaa==0) {
            echo '<div class="col-md-12"><div class="alert alert-warning">Herhangi bir içerik bulunamadı!</div></div>';
          }
          while($icerikcek=$iceriksor->fetch(PDO::FETCH_ASSOC)) {

            ?>
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
		  <?php } ?>
        
        <!-- -->
        <div class="row">
          <div class="col-md-12">
            <div class="pagination-p">
              <?php

                $s=0;

                while ($s < $toplam_sayfa) {

                  $s++; ?>

                  <?php

                  if ($s==$sayfa) {?>
                    <label class="btn btn-secondary active">
                      <a href="index.php?sayfa=<?php echo $s; ?>" style="color:white"> <?php echo $s; ?> </a>
                    </label>
                  <?php } else {?>
                    <label class="btn btn-secondary">
                      <a href="index.php?sayfa=<?php echo $s; ?>" style="color:white"> <?php echo $s; ?> </a>
                    </label>
                  <?php   }

                }

                ?>
            </div>
          </div>
        </div>
        
      </div>
      
      <!-- -->
      <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
          <div class="card-body">
            <p class="card-text"><b>Kategoriler</b></p>
            <hr>
            <p></p>
            <ul class="list-group">
			<?php $kategori = $db->query('SELECT * FROM vt_kategoriler ORDER BY vt_sira'); $ssss = $kategori->rowCount(); if($ssss==0){ echo '<div class="alert alert-warning">Kategori bulunamadı!</div>'; } foreach($kategori as $kategoricek) { ?>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="kategoriler.php?id=<?php echo $kategoricek['vt_id']; ?>"><?php echo $kategoricek['vt_kategori']; ?></a>
                 <span class="badge badge-primary badge-pill"><?php
                        $kategorisor = $db->prepare('SELECT * FROM vt_basliklar WHERE vt_kategori=:kategori');
                        $kategorisor->execute(array(
                          'kategori' => $kategoricek['vt_id']
                        ));

                        echo $kategorisor->rowCount();
                        ?></span>
              </li>
			  <?php } ?>
            </ul>
          </div>
        </div>
      </div>
   
    </div>
    </div>
  </div>
  </section>

<?php include 'templates/footer.php'; ?>