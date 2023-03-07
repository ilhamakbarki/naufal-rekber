<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?= $config['meta']['description'] ?>" />
		<meta name="keywords" content="<?= $config['meta']['keywords'] ?>" />
        <meta name="author" content="<?= $config['author'] ?>" />

        <!-- Favicon -->
        <link rel="shortcut icon" href="<?= base_url() ?>assets/images/logo.png">

        <!-- Title -->
        <title><?= $config['title'] ?></title>

        <!-- CSS -->
        <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="authentication-bg">
        
        <div class="account-pages my-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-5 col-8">
                        <div class="text-center">
                            
                            <div>
                                <img src="<?= base_url() ?>assets/images/not-found.png" alt="" class="img-fluid" />
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <h3 class="mt-3">We couldn’t connect the dots</h3>
                        <p class="text-muted mb-5">This page was not found. <br/> You may have mistyped the address or the page may have moved.</p>

                        <a href="<?= base_url() ?>" class="btn btn-lg btn-primary mt-4">Take me back to Home</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- App JS -->
        <script src="<?= base_url() ?>assets/js/vendor.min.js"></script>
        <script src="<?= base_url() ?>assets/js/app.min.js"></script>

    </body>
</html>