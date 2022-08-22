<?php
$sayfa = 'Ürünler';
include('inc/vt.php');
include('inc/head.php');
include('inc/nav.php');


$sorgu = $baglanti->prepare("SELECT * FROM urunler where aktif=1");
$sorgu->execute();
$yon = 'sag';

while ($sonuc = $sorgu->fetch()) {
    ?>

<section class="page-section">
        <div class="container">
            <div class="product-item">
                <div class="product-item-title d-flex">
                    <div class="bg-faded p-5 d-flex <?php echo $yon == 'sol' ? 'ml-auto' : 'mr-auto' ?> rounded">
                        <h2 class="section-heading mb-0">
                            <span class="section-heading-upper"><?= $sonuc['cihazt'] ?></span>
                            <span class="section-heading-lower"><?= $sonuc['cihaza'] ?></span>
                        </h2>
                    </div>

                    <div class="bg-faded p-5 d-flex <?php echo $yon == 'sag' ? 'ml-auto' : 'mr-auto' ?> rounded">
                    <h2 class="section-heading mb-0">
                            <span class="section-heading-upper">Fiyat</span>
                            <span class="section-heading-lower"><?= $sonuc['fiyat'] ?></span>
                        </h2>
                    </div>
                </div>
                <img class="product-item-img mx-auto d-flex rounded img-fluid mb-3 mb-lg-0"
                     src="img/<?= $sonuc['foto'] ?>" alt="">
                <div class="product-item-description d-flex <?php echo $yon == 'sag' ? 'mr-auto' : 'ml-auto' ?>">
                    <div class="bg-faded p-5 rounded">
                        <?= $sonuc['icerik'] ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php
   /* if ($yon == 'sag') $yon = 'sol';
    else $yon = 'sag';*/

} //while sonu
include('inc/footer.php');
?>
