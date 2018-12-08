<?php include 'templates/header.php'; ?>
<?php
$iceriksor = $db->prepare('SELECT * FROM vt_basliklar WHERE vt_id=:id');
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
    <h1 class="jumbotron-heading"><?php if ($icerikcek['vt_baslik']=="") { header('Location:index.php');
      exit; } ?><?php echo $icerikcek['vt_baslik']; ?></h1>
      <p class="lead text-muted">Anonim#<?php echo $icerikcek['vt_kullid']; ?> adlı kullanıcının açtığı başlık.</p>
    </div>
  </section>
   <section id="anonim">
      <div class="py-5 bg-light">
         <div class="container">
            <div class="row">
               <!-- Sol Tarafı -->
               <div class="col-sm-8">
                  <!-- Burdan Başla :d -->
                  <div class="card mb-4 shadow-sm">
                     <div class="card-body">
                <p class="text-muted"><?php echo $icerikcek['vt_detay']; ?></p>
                <div class="d-flex justify-content-between align-items-center pull-right">
                  <small class="text-muted"><i class="fa fa-calendar-o"></i> <?php echo $icerikcek['vt_tarih']; ?> - <i class="fa fa-clock-o"></i> <?php echo $icerikcek['vt_saat']; ?> | <i class="fa fa-tag"></i>
                    <?php $ssor = $db->prepare('SELECT * FROM vt_kategoriler WHERE vt_id=:kategori');
                    $ssor->execute(array(
                      'kategori' => $icerikcek['vt_kategori']
                    ));
                    $sscek = $ssor->fetch(PDO::FETCH_ASSOC); if($sscek['vt_kategori']=="") { echo 'Kategori bulunamadı'; }else { echo $sscek['vt_kategori']; } ?></small>
                  </div>
                </div>
                  </div>
				  <?php
            //Başlık Oluştur
            if (isset($_POST['yorum-yap'])) {
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

              if (empty($_POST['yorum'])) {
                $basarisiz = '<div class="alert alert-warning"><strong><i class="fa fa-times-circle"></i></strong> Yorum gönderilmedi, yorum boş olamaz.</div>';
              }else{

                $insert = $db->prepare('INSERT INTO vt_yorumlar SET
                  vt_kullid=:kid,
                  vt_yorum=:yorum,
                  vt_tarih=:tarih,
                  vt_saat=:saat,
                  vt_konuid=:konuid
                  ');
                  $kaydet = $insert->execute(array(
                    'kid' => $kullanicicek['vt_id'],
                    'yorum' => htmlspecialchars($_POST['yorum']),
                    'tarih' => date('d').' '.$ay.' '.date('Y'),
                    'saat' => $saat,
                    'konuid' => $icerikcek['vt_id']
                  ));

                  if ($kaydet) {
                    header('Location:baslik-detay.php?id='.$icerikcek['vt_id'].'');
                    exit;
                    $basarili = '<div class="alert alert-success"><strong><i class="fa fa-check-circle"></i></strong> Yorum gönderildi, lütfen bekleyin.</div>';
                  }else{
                    $basarisiz = '<div class="alert alert-danger"><strong><i class="fa fa-times-circle"></i></strong> Yorum gönderilmedi, tekrar deneyin.</div>';
                  }

                }
              }

              ?>
              <?php
              $sayfada = 3; // sayfada gösterilecek içerik miktarını belirtiyoruz.


              $sorgu=$db->prepare("select * from vt_yorumlar WHERE vt_konuid = {$icerikcek['vt_id']}");
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

              $iceriksorss=$db->prepare("select * from vt_yorumlar WHERE vt_konuid = {$icerikcek['vt_id']} order by vt_id DESC limit $limit,$sayfada");
              $iceriksorss->execute();
              $ssaaa = $sorgu->rowCount();
              if ($ssaaa==0) {
                echo '<div class="col-md-12"><div class="alert alert-warning">Herhangi bir yorum bulunamadı!</div></div>';
              }
              while($icerikcekl=$iceriksorss->fetch(PDO::FETCH_ASSOC)) {
                ?>
                  <div class="card text-white bg-danger mb-3">
                     <div class="card-header">Anonim#<?php echo $icerikcekl['vt_kullid']; ?></div>
                     <div class="card-body">
                        <p class="card-text"><?php echo $icerikcekl['vt_yorum']; ?></p>
                        <div class="d-flex justify-content-between align-items-center pull-right">
                           <small class="text-muted"><font color="white"><i class="fa fa-calendar-o"></i> <?php echo $icerikcekl['vt_tarih']; ?> - <i class="fa fa-clock-o"></i> <?php echo $icerikcekl['vt_saat']; ?></font></small>
                        </div>
                     </div>
                  </div>
			  <?php } ?>
                  <div>
                  <?php

                  $s=0;

                  while ($s < $toplam_sayfa) {

                    $s++; ?>

                    <?php

                    if ($s==$sayfa) {?>
                      <label class="btn btn-secondary active">
                        <a href="baslik-detay.php?id=<?php echo $icerikcek['vt_id']; ?>&sayfa=<?php echo $s; ?>" style="color:white"> <?php echo $s; ?> </a>
                      </label>
                    <?php } else {?>
                      <label class="btn btn-secondary">
                        <a href="baslik-detay.php?id=<?php echo $icerikcek['vt_id']; ?>&sayfa=<?php echo $s; ?>" style="color:white"> <?php echo $s; ?> </a>
                      </label>
                    <?php   }

                  }

                  ?>
                </div>
                  <hr>
				  <?php
                echo $basarisiz;
                if($sorgula==0) { }else{
                  ?>
                  <form method="post">
                     <div class="form-group">
                        <textarea class="form-control" rows="3" placeholder="Yorumunuzu yazın ve ardından 'Gönder' butonuna tıklayın." name="yorum"></textarea><br>
                        <button type="submit" class="btn btn-primary pull-right" name="yorum-yap">Gönder</button>
                     </div>
                  </form>
				<?php } ?>
               </div>
               <!-- Sol Tarafı Bitiş -->			   
               <!-- Sağ Tarafı -->
               <div class="col-sm">
			      <!-- Burdan Başla :d -->
                  <div class="card mb-4 shadow-sm">
                     <div class="card-body">
                        <p class="card-text"><b>Sizin Bilgileriniz<hr></b></p>
            <?php if($sorgula==0) { echo '<center><a href="giris.php" class="btn btn-primary my-2 my-sm-0" style="color:white">Giriş Yap veya Kayıt Ol</a></center>'; }else{ ?>
              <p class="text-muted"><b>Ad Soyad:</b> <i><?php echo $kullanicicek['vt_isim'].' '.$kullanicicek['vt_soyisim']; ?> (Anonim#<?php echo $kullanicicek['vt_id']; ?>)</i></p>
              <p class="text-muted"><b>E-Posta:</b> <i><?php echo $kullanicicek['vt_eposta']; ?></i></p>
              <p class="text-muted"><b>Lokasyon & IP:</b> <i><?php
              $ip = $_SERVER['REMOTE_ADDR'];

              $ip = file_get_contents("http://ip-api.com/xml/".$ip);

              $cek = new SimpleXMLElement($ip); $ulke = $cek->country; if($ulke=="") { echo 'Ülke bulunamadı'; }else{ echo $ulke; }
              ?></i> - <i><?php echo $_SERVER['REMOTE_ADDR']; ?></i></p><?php } ?>
                     </div>
                  </div>
               </div>
               <!-- Sağ Tarafı Bitiş -->
            </div>
         </div>
      </div>
   </section>
<?php include 'templates/footer.php'; ?>