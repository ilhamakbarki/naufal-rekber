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
        
        <!-- ChatBot -->
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
                    <ul class="navbar-nav flex-row ml-auto d-flex list-unstyled topnav-menu float-right mb-0">
                        <li class="dropdown notification-list align-self-center profile-dropdown">
                            <a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="false" aria-expanded="false">
                                <div class="media user-profile ">
                                    <?php if (user('image') == 'male.png') { ?>
                                    
                                    <img src="<?= base_url() ?>assets/images/male.png" alt="user-image" class="rounded-circle align-self-center" />
                                    <?php } else { ?>
                                    
                                    <img src="<?= base_url() ?>assets/images/profile/<?= user('image') ?>" alt="user-image" class="rounded-circle align-self-center" />
                                    <?php } ?>
                                    
                                    <div class="media-body text-left">
                                        <h6 class="pro-user-name ml-2 my-0">
                                            <span><?= user('full_name') ?></span>
                                            <span class="pro-user-desc text-muted d-block mt-1"><?= $level->level_name ?></span>
                                        </h6>
                                    </div>
                                    <span data-feather="chevron-down" class="ml-2 align-self-center"></span>
                                </div>
                            </a>
                            <div class="dropdown-menu profile-dropdown-items dropdown-menu-right">
                                <a href="<?= base_url() ?>account" class="dropdown-item notify-item">
                                    <i data-feather="user" class="icon-dual icon-xs mr-2"></i>
                                    <span>Akun</span>
                                </a>
                                <a href="<?= base_url() ?>account/history" class="dropdown-item notify-item">
                                    <i data-feather="refresh-cw" class="icon-dual icon-xs mr-2"></i>
                                    <span>Riwayat</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="<?= base_url() ?>auth/logout" class="dropdown-item notify-item">
                                    <i data-feather="log-out" class="icon-dual icon-xs mr-2"></i>
                                    <span>Keluar</span>
                                </a>
                            </div>
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
                                    <a href="<?= base_url() ?>#transaction">
                                        <i data-feather="help-circle"></i>
                                        <span>Cara Transaksi</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>order/create">
                                        <i data-feather="shopping-cart"></i>
                                        <span>Buat Transaksi</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>order/join">
                                        <i data-feather="shopping-bag"></i>
                                        <span>Join Transaksi</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>#contact">
                                        <i data-feather="phone"></i>
                                        <span>Contact</span>
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
                                <h4 class="mb-1 mt-0"><?= $page ?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12"><?php $this->load->view('result') ?></div>
                        </div>
<?= $content ?>

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
        
        <!-- Alert Notification -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
    </body>
</html>