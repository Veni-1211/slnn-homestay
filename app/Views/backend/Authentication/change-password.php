<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <title>Sri Lakshmi Narayana Nivasam Home Stay </title>
    <link href="<?php echo base_url(); ?>utilities/frontend/img/icon2.png" rel="icon">

    <!-- Required Framework -->
    <link rel="stylesheet" type="text/css"
        href="<?= base_url(); ?>utilities/backend/assets/css/bootstrap/css/bootstrap.min.css">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css"
        href="<?= base_url(); ?>utilities/backend/assets/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css"
        href="<?= base_url(); ?>utilities/backend/assets/icon/icofont/css/icofont.css">

    <!-- Style -->
    <link rel="stylesheet" type="text/css"
        href="<?= base_url(); ?>utilities/backend/assets/css/style.css">
</head>

<body class="fix-menu">

    <!-- Pre-loader -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class="contain">
                <?php for ($i = 0; $i < 10; $i++): ?>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>

    <section class="login-block common-img-bg">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center align-items-center" style="min-height:100vh;">

                <div class="col-12 col-sm-8 col-md-6 col-lg-4">

                    <div class="auth-box card">
                        <div class="card-block">

                            <?= form_open('', ['method' => 'post', 'class' => 'md-float-material']); ?>

                            <div class="text-center">
                                <img src="<?= base_url(); ?>utilities/frontend/img/logo2.png"
                                    alt="logo" style="height:180px;">
                            </div>

                            <h4 class="text-center txt-primary m-b-20 mt-3">
                                Change Password
                            </h4>

                            <p class="text-center text-muted">
                                Enter your current password to receive OTP
                            </p>

                            <!-- FLASH ERROR -->
                            <?php if (session()->getFlashdata('error')): ?>
                                <p class="text-danger text-center">
                                    <?= session()->getFlashdata('error'); ?>
                                </p>
                            <?php endif; ?>

                            <!-- PASSWORD INPUT -->
                            <div class="input-group">
                                <input type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Current Password">
                                <span class="md-line"></span>
                            </div>

                            <!-- VALIDATION ERROR -->
                            <?php if (isset($validation)): ?>
                                <p class="text-danger text-center">
                                    <?= $validation->getError('password'); ?>
                                </p>
                            <?php endif; ?>
                            <p class="text-danger" id="error">
                                <?php
                                if (isset($error)) {
                                    echo $error;
                                }
                                ?>
                            </p>
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="submit"
                                        class="btn btn-primary btn-md btn-block waves-effect text-center">
                                        Send OTP
                                    </button>
                                    <div class="text-center mt-3">
                                        <a href="<?php echo base_url(); ?>dashboard" class="text-dark">Back</a>
                                    </div>
                                </div>
                            </div>

                            <hr />

                            <div class="row m-t-10">
                                <div class="col-md-12 text-center">
                                    <p class="text-muted">
                                        © <?= date('Y'); ?> Sri Lakshmi Narayana Nivas Homestay
                                    </p>
                                </div>
                            </div>

                            <?= form_close(); ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- JS -->
    <script src="<?= base_url(); ?>utilities/backend/assets/js/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>utilities/backend/assets/js/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>utilities/backend/assets/js/common-pages.js"></script>

</body>

</html>