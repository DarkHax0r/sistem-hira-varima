<base href="<?php echo base_url('/login-assets') ?>/">
<!doctype html>
<html lang="en">

<head>
    <title>Selamat Datang di Sistem Varima</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/login-assets/css/style.css">
    <link rel="stylesheet" href="/login-assets/css/bootstap.min.css">
    <link rel="stylesheet" href="/login-assets/css/bootstrap/bootstap.min.css">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-user-o"></span>
                        </div>
                        <h3 class="text-center mb-4">Welcome</h3>
                        <?= session()->get('pesan'); ?>
                        <?= session()->get('auth'); ?>
                        <form action="<?= base_url('/proses_login') ?>" method="POST" class="login-form">

                            <div class="form-group">
                                <input type="text" class="form-control rounded-left" placeholder="Username" name="username" required>
                            </div>
                            <div class="form-group d-flex">
                                <input type="password" class="form-control rounded-left" placeholder="Password" name="password" required>
                            </div>
                            <div class="form-group d-md-flex">

                                <div class="w-80 text-md-left">
                                    <a href="<?= base_url('/register')?>">Create Account</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary rounded submit p-3 px-5">Get Started</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="/login-assets/js/jquery.min.js"></script>
    <script src="/login-assets/js/popper.js"></script>
    <script src="/login-assets/js/bootstrap.min.js"></script>
    <script src="/login-assets/js/main.js"></script>

</body>

</html>