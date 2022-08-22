<script type="text/javascript" src="../js/sweetalert.min.js"></script>
<?php
$sayfa = "Ürünler";
include('../inc/vt.php');
include('inc/head.php');
include('inc/nav.php');
include('inc/sidebar.php');
if ($_POST) { 
    $cihazt = $_POST['cihazt']; 
    $icerik = $_POST['icerik'];
    $cihaza = $_POST['cihaza'];
    $fiyat = $_POST['fiyat'];
    $aktif = 0;
    if (isset($_POST['aktif'])) $aktif = 1;
    $hata = "";

    
    if ($cihazt <> "" && $icerik <> "" && isset($_FILES['foto'])) {

        if ($_FILES['foto']['error'] != 0) {
            $hata .= 'Dosya yüklenirken hata gerçekleşti lütfen daha sonra tekrar deneyiniz.';
        } else {

            $dosya_adi = strtolower($_FILES['foto']['name']);
            if (file_exists('images/' . $dosya_adi)) {
                $hata .= " $dosya_adi diye bir dosya var";
            } else {
                $boyut = $_FILES['foto']['size'];
                if ($boyut > (1024 * 1024 * 2)) {
                    $hata .= ' Dosya boyutu 2MB den büyük olamaz.';
                } else {
                    $dosya_tipi = $_FILES['foto']['type'];
                    $dosya_uzanti = explode('.', $dosya_adi);
                    $dosya_uzanti = $dosya_uzanti[count($dosya_uzanti) - 1];

                    if (!in_array($dosya_tipi, ['image/png', 'image/jpeg']) || !in_array($dosya_uzanti, ['png', 'jpg'])) {
                        
                        $hata .= ' Hata, dosya türü JPEG veya PNG olmalı.';
                    } else {
                        $foto = $_FILES['foto']['tmp_name'];
                        copy($foto, '../img/' . $dosya_adi);


                        
                        $satir = [
                            'foto' => $dosya_adi,
                            'cihazt' => $cihazt,
                            'cihaza' => $cihaza,
                            'fiyat' => $fiyat,
                            'aktif' => $aktif,
                            'icerik' => $icerik,
                        ];

                       
                        $sql = "INSERT INTO urunler SET foto=:foto, cihazt=:cihazt,aktif=:aktif,fiyat=:fiyat, cihaza=:cihaza, icerik=:icerik;";
                        $durum = $baglanti->prepare($sql)->execute($satir);

                        if ($durum) {
                            echo '<script>swal("Başarılı","Ürün Eklendi","success").then((value)=>{ window.location.href = "urunler.php"});

</script>';
                        }


                    }
                }
            }
        }
    }
    if($hata!=""){
        echo '<script>swal("Hata","'.$hata.'","error");</script>';
    }
}
?>
<script src="vendor/CKEditor5/ckeditor.js"></script>
<div id="content-wrapper">

    <div class="container-fluid">

        
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Ürün Ekle</li>
        </ol>


        
        <div class="card mb-3">

            <div class="card-body">

                <form method="post" action="urunEkle.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input required type="file" name="foto" class="form-control-file" id="foto">
                    </div>
                    <div class="form-group">
                        <label>Cihaz Adı</label>
                        <input required type="text" class="form-control" name="cihaza" placeholder="Cihaz Adı">
                    </div>
                    <div class="form-group">
                        <label>Cihaz Türü</label>
                        <input required type="text" class="form-control" name="cihazt" placeholder="Cihaz Türü">
                    </div>

                    <div class="form-group">
                        <label for="icerik">İçerik</label>
                        <textarea name="icerik" id="icerik"></textarea>

                        <script>
                            ClassicEditor
                                .create(document.querySelector('#icerik'))
                                .then(editor => {
                                    console.log(editor);
                                })
                                .catch(error => {
                                    console.error(error);
                                });
                        </script>

                    </div>

                    <div class="form-group">
                        <label>Fiyat</label>
                        <input required type="text" class="form-control" name="fiyat" placeholder="Fiyat">
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="aktif" id="aktif">
                        <label class="form-check-label" for="aktif">Aktif mi?</label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>

                </form>


            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>


       


        <?php
        include('inc/footer.php');
        ?>
        <script>
            $(document).ready(function () {
                $('#dataTable').DataTable({
                    language: {
                        info: "_TOTAL_ kayıttan _START_ - _END_ kayıt gösteriliyor.",
                        infoEmpty: "Gösterilecek hiç kayıt yok.",
                        loadingRecords: "Kayıtlar yükleniyor.",
                        zeroRecords: "Tablo boş",
                        search: "Arama:",
                        sLengthMenu: "Sayfada _MENU_ kayıt göster",
                        infoFiltered: "(toplam _MAX_ kayıttan filtrelenenler)",
                        buttons: {
                            copyTitle: "Panoya kopyalandı.",
                            copySuccess: "Panoya %d satır kopyalandı",
                            copy: "Kopyala",
                            print: "Yazdır",
                        },

                        paginate: {
                            first: "İlk",
                            previous: "Önceki",
                            next: "Sonraki",
                            last: "Son"
                        },
                    }
                });
            });

        </script>
        <script src="js/aktifcustom.js"></script>
        <link rel="stylesheet" type="text/css" href="css/switch.css">