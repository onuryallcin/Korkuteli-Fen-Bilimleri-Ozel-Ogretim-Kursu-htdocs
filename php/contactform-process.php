<?php
include('../site/inc/vt.php');

// prepare email body text
if ($_POST) {

    $kaydet = $baglanti->prepare("INSERT INTO iletisim SET ad=:ad, email=:email, mesaj=:mesaj");
    $insert = $kaydet->execute(array(
        'ad' => htmlspecialchars($_POST['ad']),
        'email' => htmlspecialchars($_POST['email']),
        'mesaj' => htmlspecialchars($_POST['mesaj']),
    ));
    if ($insert) {

        echo '<script>swal("Başarılı","Mesajınız bize ulaştı","success");</script>';
    } else {
        echo '<script>swal("Hata","Daha sonra tekrar deneyin","error");</script>';
    }
}   
?>