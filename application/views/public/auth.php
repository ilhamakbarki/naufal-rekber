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

        <!-- CSS -->
        <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="authentication-bg">
        <div class="account-pages my-5">
            <div class="container">
<?= $content ?>

            </div>
        </div>

        <!-- App JS -->
        <script src="<?= base_url() ?>assets/js/vendor.min.js"></script>
        <script src="<?= base_url() ?>assets/js/app.min.js"></script>
    </body>
</html>