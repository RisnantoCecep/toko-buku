<?php 
    $categories = $this->book->categories();
?>
<header id="header" class="header fixed-top d-flex align-items-center shadow-sm">
    <div class="container d-flex align-items-center justify-content-between">

        <a href="<?= base_url() ?>" class="logo d-flex align-items-center me-auto me-lg-0">
            <img src="<?= base_url('assets/img/logo-budaya-literasi-red.png') ?>" class="h-100">
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                <?php if($this->session->userdata('user_flag')!='admin'): ?>
                <li><a href="<?= base_url() ?>">Home</a></li>
                <li><a href="<?= base_url('#about') ?>">About</a></li>
                <li><a href="<?= base_url('#teams')?>">Teams</a></li>
                <li class="dropdown"><a href="#"><span>Categories</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <?php if($categories): foreach($categories as $category): ?>
                        <li><a href="<?= base_url('book/category/'.$category['category_slug']) ?>"><?= $category['category_title'] ?></a></li>
                        <?php endforeach; endif; ?>
                    </ul>
                </li>
                <li><a href="https://wa.me/send?phone=6287879234369&text=Hallo,%20Rekan%20BuLite"><i class="bi bi-whatsapp me-1" style="font-size:20px;"></i>Contact Admin</a></li>
                <?php endif ?>
                <?php if($this->session->userdata('user_flag')=='admin'): ?>
                <li class="dropdown">
                    <a href="#"><span>Admin Panel</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                        <li><a href="<?= base_url('admin/books') ?>">Data Buku</a></li>
                        <li><a href="<?= base_url('admin/transactions') ?>">Data Transaksi</a></li>
                        <li><a href="<?= base_url('admin/payments') ?>">Data Pembayaran</a></li>
                        <li><a href="<?= base_url('admin/cooriers') ?>">Data Kurir</a></li>
                    </ul>
                </li>
                <?php endif ?>
            </ul>
        </nav>

        <div class="ms-auto">
            <?php if($this->session->userdata('user_id')): ?>
            <?php if($this->session->userdata('user_flag')!='admin'): ?>
            <a href="<?= base_url('keranjang') ?>" class="btn btn-light position-relative">
                <i class="bi bi-cart3"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <span id="my-basket-count"><?= countBasket() ?></span>
                    <span class="visually-hidden">Belum Di Check Out</span>
                </span>
            </a>
            <?php endif ?>
            <a class="btn-book-a-table" href="<?= base_url('profile') ?>">
                <i class="bi bi-person-circle"></i>
                <span class="d-none d-md-inline">Profile</span>
            </a>
            <?php else: ?>
            <a class="btn-book-a-table" href="<?= base_url('login') ?>">Login</a>
            <a class="btn-book-a-table ms-2" href="<?= base_url('register') ?>">Daftar</a>
            <?php endif ?>
        </div>
        
        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
</header>