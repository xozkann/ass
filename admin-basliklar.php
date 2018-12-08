<?php include 'templates/header.php'; if($kullanicicek['vt_durum']==1) { header('Location:index.php'); exit; } ?>

  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">Yetkili Erişimi</h1>
      <p class="lead text-muted">Bu sayfaya sadece yetkililer erişebilir.</p>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Başlık</th>
            <th scope="col">Tarih</th>
            <th scope="col">Saat</th>
            <th scope="col">Oluşturan</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <script language="JavaScript">
          //Fonksiyonu hazırlıyoruz.
          function islem()
          {
            var onay;
            onay = confirm("Başlığı silmek istiyor musunuz?")
          }
        </script>
        <?php $kullanicilar = $db->query("SELECT * FROM vt_basliklar"); foreach($kullanicilar as $kullanicilarcek) { ?>
          <tr>
            <th scope="row"><?php echo $kullanicilarcek['vt_id']; ?></th>
            <td><?php echo $kullanicilarcek['vt_baslik']; ?></td>
            <td><?php echo $kullanicilarcek['vt_tarih']; ?></td>
            <td><?php echo $kullanicilarcek['vt_saat']; ?></td>
            <td>Anonim#<?php echo $kullanicilarcek['vt_kullid']; ?></td>
            <td><a href="baslik-duzenle.php?id=<?php echo $kullanicilarcek['vt_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a></td>
            <?php if(isset($_POST['ksil'])) { $query = $db->prepare("DELETE FROM vt_basliklar WHERE vt_id = :id");
              $delete = $query->execute(array(
                'id' => $_POST['id']
              )); header('Refresh:0'); } ?>
              <td><form method="post"><input hidden name="id" value="<?php echo $kullanicilarcek['vt_id']; ?>"><button type="submit" onclick="islem()" name="ksil" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button></form></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include 'templates/footer.php'; ?>
