<?php include 'templates/header.php'; if($kullanicicek['vt_durum']==1) { header('Location:index.php'); exit; } ?>

  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">Yetkili Erişimi</h1>
      <p class="lead text-muted">Bu sayfaya sadece yetkililer erişebilir.</p>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">
      <a href="kategori-ekle.php" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Kategori Ekle</a>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Kategori Adı</th>
            <th scope="col">Sıra</th>
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
            onay = confirm("Kategoriyi silmek istiyor musunuz?")
          }
        </script>
        <?php $kullanicilar = $db->query("SELECT * FROM vt_kategoriler"); foreach($kullanicilar as $kullanicilarcek) { ?>
          <tr>
            <th scope="row"><?php echo $kullanicilarcek['vt_id']; ?></th>
            <td><?php echo $kullanicilarcek['vt_kategori']; ?></td>
            <td><?php echo $kullanicilarcek['vt_sira']; ?></td>
            <td><a href="kategori-duzenle.php?id=<?php echo $kullanicilarcek['vt_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a></td>
            <?php if(isset($_POST['ksil'])) { $query = $db->prepare("DELETE FROM vt_kategoriler WHERE vt_id = :id");
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
