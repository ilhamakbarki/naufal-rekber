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

        <!-- App CSS -->
        <link href="<?= base_url() ?>assets/admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>assets/admin/css/icons.min.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>assets/admin/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>assets/admin/css/style.css" rel="stylesheet" type="text/css">

        <!-- Jquery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    </head>

    <body class="vertical-layout">   
        <!-- Start Layout Wrapper -->
        <div id="layout-wrapper">
            <?php if (admin()) : ?>

            <!-- Start Topbar -->
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- Start Logo -->
                        <div class="navbar-brand-box">
                            <a href="<?= base_url() ?>admin/home" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?= base_url() ?>assets/images/logo1.jpg" alt="" height="30">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= base_url() ?>assets/images/logo1.jpg" alt="" height="20">
                                </span>
                            </a>
                            <a href="<?= base_url() ?>admin" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?= base_url() ?>assets/images/logo1.jpg" alt="" height="30">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= base_url() ?>assets/images/logo1.jpg" alt="" height="20">
                                </span>
                            </a>
                        </div>
                        <!-- End Logo -->
                        <!-- Start Button Bars -->
                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                        <!-- End Button Bars -->
                    </div>

                    <div class="d-flex">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php if (admin('image') == 'male.png') { ?>
                                
                                <img class="rounded-circle header-profile-user" src="<?= base_url() ?>assets/images/male.png" alt="Header Avatar">
                                <?php } else { ?>
                                
                                <img class="rounded-circle header-profile-user" src="<?= base_url() ?>assets/images/profile/<?= admin('image') ?>" alt="Header Avatar">
                                <?php } ?>
                                
                                <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15"><?= admin('full_name') ?></span>
                                <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- Item-->
                                <a class="dropdown-item" href="<?= base_url() ?>admin/auth/logout"><i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Keluar</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- End Topbar -->

            <!-- Start Left Sidebar -->
            <div class="vertical-menu">
                <!-- Start Logo -->
                <div class="navbar-brand-box">
                    <a href="<?= base_url() ?>admin/home" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="<?= base_url() ?>assets/images/logo1.jpg" alt="" height="35">
                        </span>
                        <span class="logo-lg">
                            <img src="<?= base_url() ?>assets/images/logo1.jpg" alt="" height="35">
                        </span>
                    </a>
                    <a href="<?= base_url() ?>admin/home" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="<?= base_url() ?>assets/images/logo1.jpg" alt="" height="35">
                        </span>
                        <span class="logo-lg">
                            <img src="<?= base_url() ?>assets/images/logo1.jpg" alt="" height="35">
                        </span>
                    </a>
                </div>
                <!-- End Logo -->
                <!-- Start Button Bars -->
                <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
                <!-- End Button Bars -->

                <!--- Start Sidebar Menu Scroll -->
                <div data-simplebar class="sidebar-menu-scroll">
                    <!--- Start Sidebar Menu -->
                    <div id="sidebar-menu">
                        <!-- Start Left Menu -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li>
                                <a href="<?= base_url() ?>admin">
                                    <i class="uil-home-alt"></i>
                                    <span>Beranda</span>
                                </a>
                            </li>
                            <li class="menu-title">Menu</li>
                            <li>
                                <a href="<?= base_url() ?>admin/user">
                                    <i class="uil-users-alt"></i>
                                    <span>Akun</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>admin/order">
                                    <i class="uil-shopping-cart-alt"></i>
                                    <span>Transaksi</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>admin/chat">
                                    <i class="uil-comment"></i>
                                    <span>Chat</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>admin/category">
                                    <i class="uil-list-ul"></i>
                                    <span>Kategori</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>admin/payment_method">
                                    <i class="uil-credit-card"></i>
                                    <span>Metode Payment</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>admin/mutation">
                                    <i class="uil-modem"></i>
                                    <span>Mutasi</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>admin/level">
                                    <i class="uil-arrow-up"></i>
                                    <span>Level</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>admin/fee">
                                    <i class="uil-dollar-sign"></i>
                                    <span>Fee</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--- End Sidebar Menu -->
                </div>
                <!--- End Sidebar Menu Scroll -->
            </div>
            <!-- End Left Sidebar -->
            <?php endif ?>

            <!-- Start Main Content -->
            <div class="main-content">
                <!-- Start Page Content -->
                <div class="page-content">
                    <!-- Start Container -->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12"><?php $this->load->view('result') ?></div>
                        </div>
<?= $content ?>

                    </div>
                    <!-- End Container -->
                </div>
                <!-- End Page Content -->

                <!-- Start Footer -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <?= $config['footer'] ?>

                            </div>
                        </div>
                    </div>
                </footer>
                <!-- End Footer -->
            </div>
            <!-- End Main Content -->
        </div>
        <!-- End Layout Wrapper -->

        <!-- Start Modal Data -->
        <div class="modal fade bs-example-modal-center" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="uil-trash text-primary"></i> Hapus Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin?
                    </div>
        			<div class="modal-footer">
        			    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        				<a href="#" class="btn btn-primary" id="btn-yes">Ya, Hapus</a>
        			</div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="uil-search text-primary"></i> Detail Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modal-detail-body"></div>
        			<div class="modal-footer">
        			    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        			</div>
                </div>
            </div>
        </div>
        <!-- End Modal Data -->

        <script type="text/javascript">
            function confirm_delete(url) {
            	$('#modal-delete #btn-yes').attr({'href' : url});
            	$('#modal-delete').modal("show");
            }
            function detail(url) {
            	$.ajax({
            		type: "GET",
            		url: url,
            		beforeSend: function() {
            			$('#modal-detail-body').html('Sedang memuat...');
            		},
            		success: function(result) {
            			$('#modal-detail-body').html(result);
            		},
            		error: function() {
            			$('#modal-detail-body').html('Terjadi kesalahan.');
            		}
            	});
            	$('#modal-detail').modal("show");
            }
        </script>

        <!-- Start JS -->
        <script src="<?= base_url() ?>assets/admin/libs/jquery/jquery.min.js"></script>
        <script src="<?= base_url() ?>assets/admin/js/pages/highcharts.js"></script>
        <script src="<?= base_url() ?>assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url() ?>assets/admin/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?= base_url() ?>assets/admin/libs/simplebar/simplebar.min.js"></script>
        <script src="<?= base_url() ?>assets/admin/libs/node-waves/waves.min.js"></script>
        <script src="<?= base_url() ?>assets/admin/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="<?= base_url() ?>assets/admin/libs/jquery.counterup/jquery.counterup.min.js"></script>

        <!-- App JS -->
        <script src="<?= base_url() ?>assets/admin/js/app.js"></script>
    </body>

</html>