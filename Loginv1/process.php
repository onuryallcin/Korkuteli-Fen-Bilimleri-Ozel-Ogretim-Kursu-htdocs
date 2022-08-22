<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
</head>
<style>
  /* session_start();
    ob_start();
    try {
        $db = new PDO("mysql:host=localhost;dbname=korkutelifenbilimleri", "root", "");
        $sorgu = $baglanti->query("select isim sifre from ogretmengiris");
    } catch ( PDOException $e ){
        print $e->getMessage();
        }
    
    if(($_POST["isim"]==$isim) and ($_POST["sifre"]==$sifre)){
    header("Location:adminlogin.php");
    }else{
        echo '<script type="text/javascript">alert("Kullanıcı adı veya şifre yanlış. Giriş sayfasına yönlendiriliyorsunuz.");window.history.go(-1);</script>';
        // echo "Kullancı Adı veya Şifre Yanlış.<br>";
        // echo "Giriş sayfasına yönlendiriliyorsunuz.";
        header("Refresh: 2; url=indexlogin.php");
    }
    ob_end_flush();
        // try {
        //     $db = new PDO("mysql:host=localhost;dbname=korkutelifenbilimleri", "root", "");
        // } catch ( PDOException $e ){
        //     print $e->getMessage();
        // }

        // $isim = $_POST['isim'];
        // $sifre = $_POST['sifre'];

        // $login = $db->prepare("SELECT * FROM ogretmengiris WHERE isim=? AND sifre=?");
        // $login->execute(array($isim, $sifre));
        // if ($login->rowCount())
        // {
        //     $_SESSION["login"] = "true";
        //     $_SESSION["isim"] = $isim;
        //     $_SESSION["sifre"] = $sifre;
        //     // header("location:adminlogin.php");

        //     $msg = 'Login Complete! Thanks';
        //     echo "<script> window.location.assign('adminlogin.php'); </script>";

        //     // echo "<script> window.location.assign('adminlogin.php'); </script>";

        // }
        // else
        // {
        //     echo '<script type="text/javascript">alert("Kullanıcı adı veya şifre yanlış");window.history.go(-1);</script>';
        //     // echo '<script language="javascript">';
        //     // echo 'alert("Girilen bilgiler hatalı. Tekrar deneyiniz.")';
        //     // echo '</script>';
        // } */
</style>
<body>
    <script type="text/javascript" src="sweetalert2.all.min.js"></script>
    <script src="dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
    <?php



        session_start(); //oturum başlattık
        include("login2.php"); //veri tabanına bağlandık 

        //eğer mevcut oturum varsa sayfayı yönlendiriyoruz.
        if (isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "6789") {
            header("location:../site/admin/index.php");
        } //eğer önceden beni hatırla işaretlenmiş ise oturum oluşturup sayfayı yönlendiriyoruz.
        else if (isset($_COOKIE["cerez"])) {
            //Kullanıcı adlarını çeken sorgumuz
            $sorgu = $baglanti->query("select isim from ogretmengiris");

            //Kullanıcı adlarını döngü yardımı ile tek tek elde ediyoruz
            while ($sonuc = $sorgu->fetch_assoc()) {
                //eğer bizim belirlediğimiz yapıya uygun kullanıcı var mı diye bakıyoruz.
                if ($_COOKIE["cerez"] == md5("aa" . $sonuc['isim'] . "bb")) {

                    //oturum oluşturma buradaki değerleri güvenlik açısından
                    //farklı değerler yapabilirsiniz
                    //aynı zamanda kullanıcı adınıda burada tuttum
                    $_SESSION["Oturum"] = "6789";
                    $_SESSION["isim"] = $sonuc['isim'];

                    //sonrasında index sayfasına yönlendiriyorum
                    header("location:../site/admin/index.php");
                }
            }
        }
        //Giriş formu doldurulmuşsa kontrol ediyoruz
        if ($_POST) {
            $txtİsim = $_POST["txtİsim"]; //Kullanıcı adını değişkene atadık
            $txtSifre = $_POST["txtSifre"]; //Parolayı değişkene atadık
        }


    ?>

</body>
</html>