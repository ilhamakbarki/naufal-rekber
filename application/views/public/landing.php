<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?= $config['meta']['description'] ?>" />
		<meta name="keywords" content="<?= $config['meta']['keywords'] ?>" />
        <meta name="author" content="<?= $config['author'] ?>" />

        <!-- Favicon -->
        <link rel="shortcut icon" href="<?= base_url() ?>assets/images/logo1.jpg">

        <!-- Title -->
        <title><?= $config['title'] ?></title>

        <!-- Plugins -->
        <link href="<?= base_url() ?>assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />

        <!-- CSS -->
        <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="https://rawgit.com/jackmoore/autosize/master/dist/autosize.min.js"></script>

        <!-- Jquery -->
        <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
        
        <!-- Chatbot -->
        <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="bc63bc08-a7d1-4f1b-9c36-ee26007c5218";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
    </head>
    <body data-layout="topnav">
        <div class="wrapper">
            <div class="navbar navbar-expand flex-column flex-md-row navbar-custom">
                <div class="container-fluid">
                    <a href="<?= base_url() ?>" class="navbar-brand mr-0 mr-md-2 logo">
                        <span class="logo-lg">
                            <img src="<?= base_url() ?>assets/images/logo1.jpg" alt="" height="50" />
                            <span class="d-inline h5 ml-1 text-logo"><?= $config['short_title'] ?></span>
                        </span>
                        <span class="logo-sm">
                            <img src="<?= base_url() ?>assets/images/logo1.jpg" alt="" height="50">
                        </span>
                    </a>
                    <ul class="navbar-nav bd-navbar-nav flex-row list-unstyled menu-left mb-0">
                        <li class="">
                            <button class="button-menu-mobile open-left disable-btn">
                                <i data-feather="menu" class="menu-icon"></i>
                                <i data-feather="x" class="close-icon"></i>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="topnav shadow-sm">
                <div class="container-fluid">
                    <nav class="navbar navbar-light navbar-expand-lg topbar-nav">
                        <div class="collapse navbar-collapse" id="topnav-menu-content">
                            <ul class="metismenu" id="menu-bar">
                                <li class="menu-title">Menu</li>
                                <li>
                                    <a href="<?= base_url() ?>">
                                        <i data-feather="home"></i>
                                        <span>Beranda</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#transaction">
                                        <i data-feather="help-circle"></i>
                                        <span>Cara Transaksi</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#contact">
                                        <i data-feather="phone"></i>
                                        <span>Contact</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>auth/login">
                                        <i data-feather="log-in"></i>
                                        <span>Login</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>

            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row page-title">
                            <div class="col-md-12">
                                <h4 class="mb-1 mt-0">Beranda</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <img src="https://img.freepik.com/free-vector/b2b-strategy-commercial-transaction-partner-agreement-partnership-arrangement-successful-collaboration-businessmen-shaking-hands-cartoon-characters-vector-isolated-concept-metaphor-illustration_335657-2760.jpg?w=740&t=st=1675433768~exp=1675434368~hmac=b6e04a1f70a0b97361badcb42d54048cbfa3326ec055e1fe0ee0520fe0fb5ce2" class="img-fluid">
                                            </div>
                                            <div class="col-md-8">
                                                <h1><?= $config['short_title'] ?></h1>
                                                <p class="font-size-15"><?= $config['short_title'] ?> merupakan konsep layanan rekening keuangan yang menyimpan dana pada pihak ketiga berdasarkan persetujuan perjanjian antara pihak pertama dan kedua. Pencairan dana yang tersimpan hanya dapat dilakukan bila ada instruksi dari penyetor atau mencapai kondisi yang disepakati bersama. </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h2>Feature</h2>
                                                <p class="font-size-18">Terdapat beberapa fitur dan layanan utama pada Rekber. Berikut ini adalah fitur dan layanan kami</p><br>
                                                <h3 style="color:#808080">1. <?= $config['short_title'] ?></h3>
                                                <p class="font-size-15">Pembayaran / Transaksi apapun yang membutuhkan pihak ketiga.</p>
                                                <br>
                                                <h3 style="color:#808080">2. Chatting</h3>
                                                <p class="font-size-15">Chatting antar user rekber</p>
                                                <br>
                                                <h3 style="color:#808080">3. Metode Pembayaran</h3>
                                                <p class="font-size-15">Terdapat Berbagai Macam Metode Pembayaran</p>
                                            </div>
                                            <div class="col-md-4">
                                                <img src="https://img.freepik.com/free-vector/software-requirement-description-abstract-concept-illustration_335657-3813.jpg?w=740&t=st=1675439155~exp=1675439755~hmac=b0c1a7f9ecf87ccb8182f9a7ace011f19cb9f898ebcfd4646b5b8e4197f8da27" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="text-center pb-5" id="transaction">
                                            <h1>Cara Transaksi Rekber</h1>
                                            <h2 style="color:#808080">Berikut ini adalah langkah - langkah anda melakukan transaksi rekber.</h2><br>
                                            <p class="font-size-15">1. Pembeli dan penjual sepakat menggunakan jasa rekber<br><br>
                                            2. Penjual melakukan pengisian form pembuatan transaksi<br><br>
                                            3. Pembeli melakukan join transaksi dengan memasukkan kode transaksi dari penjual<br><br>
                                            4. Pembeli melakukan pembayaran<br><br>
                                            5. Penjual dan pembeli melakukan chatting untuk penyerahan data/barang transaksi<br><br>
                                            6. Penjual dan pembeli melakukan verifikasi transaksi</h4><br>
                                            </p>
                                            <br>
                                            <h1>Daftar Fee Rekber</h1>
                                            <h2 style="color:#808080">Berikut ini adalah list harga untuk fee rekber.</h2><br>
                                            <p class="font-size-15">Rp 10.000-199.000 = Rp 3.000<br><br>
                                                Rp 200.000-399.000 = Rp 5.000<br><br>
                                                RP 400.000-599.000 = Rp 7.000<br><br>
                                                Rp 600.000-799.000 = Rp 9.000<br><br>
                                                Rp 800.000-999.000 = Rp 12.000<br><br>
                                                Rp 1.000.000-1.999.000= Rp 15.000<br><br>
                                                Rp 2.000.000-4.999.000= Rp 17.000<br><br>
                                                Rp 5.000.000-Seterusnya Rp 20.000
                                            </p>
                                        </div>
                                        <div class="row text-center pt-5 pb-5" id="contact">
                                            <div class="col-md-4">
                                                <h2><?= $config['short_title'] ?></h2>
                                                <p class="font-size-17">Transaksi Mudah, Aman dan Terpercaya Dengan Rekber</p>
                                            </div>
                                            <div class="col-md-4">
                                                <h2>Contact</h2>
                                                <p class="font-size-17">Jl. Urip Sumoharjo Gg. Adenium No.07 Sumenep</p>
                                                <p class="font-size-17">Kode Pos : 69417</p>
                                            </div>
                                            <div class="col-md-4">
                                                <h2>Social Media</h2>
                                                <p class="font-size-17"><b>Gmail: </b>naufalinsankamil@gmail.com</p>
                                                <p class="font-size-17"><b>Whatsapp: </b>081775776864</p>
                                                <p class="font-size-17"><b>Instagram: </b>naufalinsankamil</p>
                                                <p class="font-size-17"><b>Facebook: </b>https://www.facebook.com/noval.kamil</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <?= $config['footer'] ?>
                                
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>


        <!-- App JS -->
        <script src="<?= base_url() ?>assets/js/vendor.min.js"></script>
        <script src="<?= base_url() ?>assets/js/jquery.mask.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/moment/moment.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/apexcharts/apexcharts.min.js"></script>
        <script src="<?= base_url() ?>assets/libs/flatpickr/flatpickr.min.js"></script>
        <script src="<?= base_url() ?>assets/js/pages/dashboard.init.js"></script>
        <script src="<?= base_url() ?>assets/js/app.min.js"></script>
    </body>
</html>