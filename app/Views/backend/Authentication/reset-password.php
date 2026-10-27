<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sri Lakshmi Narayana Nivasam Home Stay </title>
    <link href="<?php echo base_url(); ?>utilities/frontend/img/icon2.png" rel="icon">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet"
        href="<?= base_url(); ?>utilities/backend/assets/css/bootstrap/css/bootstrap.min.css">

    <!-- Icons -->
    <link rel="stylesheet"
        href="<?= base_url(); ?>utilities/backend/assets/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet"
        href="<?= base_url(); ?>utilities/backend/assets/icon/icofont/css/icofont.css">

    <!-- Theme Style -->
    <link rel="stylesheet"
        href="<?= base_url(); ?>utilities/backend/assets/css/style.css">
</head>

<body>

    <section class="login-block common-img-bg">
        <div class="container">
            <div class="row justify-content-center align-items-center" style="min-height:100vh;">

                <div class="col-md-5">

                    <div class="auth-box card">
                        <div class="card-block">

                            <?= form_open('', ['method' => 'post', 'class' => 'md-float-material']); ?>

                            <div class="text-center">
                                <img src="<?= base_url(); ?>utilities\frontend\img\logo2.png"
                                    style="height:180px;">
                            </div>

                            <h4 class="text-center txt-primary m-b-20">
                                Reset Password
                            </h4>

                            <p class="text-center text-muted">
                                Create a new password for your account
                            </p>

                            <?php if (isset($error)): ?>
                                <p class="text-danger text-center"><?= $error; ?></p>
                            <?php endif; ?>

                            <div class="input-group">
                                <input type="password" name="password"
                                    class="form-control"
                                    placeholder="New Password">
                                <span class="md-line"></span>

                            </div>
                            <?php if (isset($validation) && $validation->hasError('password')): ?>
                                <small class="text-danger">
                                    <?= $validation->getError('password'); ?>
                                </small>
                            <?php endif; ?>
                            <div class="input-group m-t-15">
                                <input type="password" name="confirm_password"
                                    class="form-control"
                                    placeholder="Confirm Password">
                                <span class="md-line"></span>
                            </div>
                            <?php if (isset($validation) && $validation->hasError('confirm_password')): ?>
                                <small class="text-danger">
                                    <?= $validation->getError('confirm_password'); ?>
                                </small>
                            <?php endif; ?>

                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="submit"
                                        class="btn btn-primary btn-md btn-block">
                                        Update Password
                                    </button>
                                </div>
                            </div>

                            <hr>

                            <p class="text-center text-muted">
                                © <?= date('Y'); ?> Sri Lakshmi Narayana Nivas Homestays
                            </p>

                            <?= form_close(); ?>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <script src="<?= base_url(); ?>utilities/backend/assets/js/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>utilities/backend/assets/js/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>