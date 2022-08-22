<script type="text/javascript" src="../js/sweetalert.min.js"></script>
<?php
$sayfa = "Ürünler";
include('../inc/vt.php');
include('inc/head.php');
include('inc/nav.php');
include('inc/sidebar.php');

$sorgu = $baglanti->prepare("SELECT * FROM urunler Where id=:id");
$sorgu->execute(['id' => (int)$_GET["id"]]);
$sonuc = $sorgu->fetch();

       if ($_POST) { 
               $cihazt = $_POST['cihazt']; 
               $icerik = $_POST['icerik'];
               $cihaza = $_POST['cihaza'];
               $fiyat = $_POST['fiyat'];
               $aktif = 0;
               if (isset($_POST['aktif'])) $aktif = 1;
               $hata = '';



               if ($_FILES["foto"]["name"] != "") {
                $foto = strtolower($_FILES['foto']['name']);
                if (file_exists('images/' . $foto)) {
                    $hata = "$foto diye bir dosya var";
                } else {
                    $boyut = $_FILES['foto']['size'];
                    if ($boyut > (1024 * 1024 * 2)) {
                        $hata = 'Dosya boyutu 2MB den büyük olamaz.';
                    } else {
                        $dosya_tipi = $_FILES['foto']['type'];
                        $dosya_uzanti = explode('.', $foto);
                        $dosya_uzanti = $dosya_uzanti[count($dosya_uzanti) - 1];

                        if (!in_array($dosya_tipi, ['image/png', 'image/jpeg']) || !in_array($dosya_uzanti, ['png', 'jpg'])) {
                           
                            $hata = 'Hata, dosya türü JPEG veya PNG olmalı.';
                        } else {
                            $dosya = $_FILES["foto"]["tmp_name"];
                            copy($dosya, "../img/" . $foto);
                            unlink('../img/' . $sonuc["foto"]); 
                        }
                    }
                }
            } else {
                
                $foto = $sonuc["foto"];
            }

            if ($cihazt <> "" && $icerik <> "" && $hata == "") { 
                $satir = [
                 'id' => $_GET['id'],
                 'foto' => $foto,
                 'cihazt' => $cihazt,
                 'cihaza' => $cihaza,
                 'fiyat' => $fiyat,
                 'aktif' => $aktif,
                 'icerik' => $icerik,
             ];
                
             $sql = "UPDATE urunler SET foto=:foto, cihazt=:cihazt,aktif=:aktif,fiyat=:fiyat, cihaza=:cihaza, icerik=:icerik WHERE id=:id;";             
             $durum = $baglanti->prepare($sql)->execute($satir);

             if ($durum)
             {
                echo '<script>swal("Başarılı","Ürün güncellendi","success").then((value)=>{ window.location.href = "urunler.php"});

                </script>';     
            } else {
                    echo 'Düzenleme hatası oluştu: '; 
                }
            } else {
                echo 'Hata oluştu: ' . $hata; 
            }
            if ($hata != "") {
        echo '<script>swal("Hata","' . $hata . '","error");</script>';
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

                <form method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <img src="../img/<?= $sonuc["foto"] ?>" width="150" alt="">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" class="form-control-file" id="foto">
                    </div>
                    <div class="form-group">
                        <label>Cihaz Adı</label>
                        <input required type="text" value="<?= $sonuc["cihaza"] ?>" class="form-control" name="cihaza"
                        placeholder="Cihaz Adı">
                    </div>
                    <div class="form-group">
                        <label>Cihaz Türü</label>
                        <input required type="text" value="<?= $sonuc["cihazt"] ?>" class="form-control" name="cihazt"
                        placeholder="Cihaz Türü">
                    </div>

                    <div class="form-group">
                        <label for="icerik">İçerik</label>
                        <textarea  name="icerik" id="icerik">
                            <?= $sonuc["icerik"] ?>
                        </textarea>

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
                        <input required type="text" value="<?= $sonuc["fiyat"] ?>" class="form-control" name="fiyat"
                        placeholder="Fiyat">
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="aktif" id="aktif"
                        <?php
                        if ($sonuc["aktif"] == 1) echo "checked";
                        ?>
                        >
                        <label class="form-check-label" for="aktif">Aktif mi?</label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Güncelle</button>
                    </div>

                </form>


            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>


       


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