<?php
  @$baglanti= new mysqli("localhost","root","","korkutelifenbilimleri");
  if($baglanti->connect_error)
  {
      //hata varsa yazdırıyoruz ve sayfayı sonlandırıyor
  echo $baglanti->connect_error." hatası oluştu";
  exit;
  }

  //türkçe karakter sorunu olmasın diye karakter setini ayarlıyoruz
  $baglanti->set_charset("utf8");
?>