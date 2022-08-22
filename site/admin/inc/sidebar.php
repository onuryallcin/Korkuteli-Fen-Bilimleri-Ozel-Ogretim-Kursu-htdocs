<div id="wrapper">
    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item <?php echo $sayfa == 'Ana Sayfa' ? 'active' : '' ?>">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-home"></i>
                <span>Ana Sayfa</span>
            </a>
        </li>
         <li class="nav-item <?php echo $sayfa == 'Hakkımızda' ? 'active' : '' ?>">
            <a class="nav-link" href="hakkimizda.php">
                <i class="fas fa-fw fa-info"></i>
                <span>Hakkımızda</span>
            </a>
        </li>

        <li class="nav-item <?php echo $sayfa == 'Ürünler' ? 'active' : '' ?>">
            <a class="nav-link" href="urunler.php">
                <i class="fas fa-light fa-store"></i>
                <span>Ürünler</span></a>
        </li>
        <li class="nav-item <?php echo $sayfa == 'İletişim' ? 'active' : '' ?>">
            <a class="nav-link" href="iletisim.php">
                <i class="fas fa-fw fa-envelope"></i>
                <span>İletişim</span></a>
        </li>
        
            <li class="nav-item <?php echo $sayfa == 'Kullanıcılar' ? 'active' : '' ?>">
            <a class="nav-link" href="kullanicilar.php">
                <i class="fas fa-fw fa-users"></i>
                <span>Kullanıcılar</span></a>
        </li>
    </ul>