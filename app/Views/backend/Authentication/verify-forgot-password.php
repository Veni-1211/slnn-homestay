<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sri Lakshmi Narayana Nivasam Home Stay </title>
    <link href="<?php echo base_url(); ?>utilities/frontend/img/icon2.png" rel="icon">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">

    <!-- Required Framework -->
    <link rel="stylesheet" type="text/css"
        href="<?= base_url(); ?>utilities/backend/assets/css/bootstrap/css/bootstrap.min.css">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css"
        href="<?= base_url(); ?>utilities/backend/assets/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css"
        href="<?= base_url(); ?>utilities/backend/assets/icon/icofont/css/icofont.css">

    <!-- Style -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>utilities/backend/assets/css/style.css">
</head>

<body class="fix-menu">

    <section class="login-block bg-primary common-img-bg">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center align-items-center" style="min-height:100vh;">

                <!-- RESPONSIVE CENTERED COLUMN -->
                <div class="col-12 col-sm-8 col-md-6 col-lg-4">

                    <div class="auth-box card">
                        <div class="card-block">

                            <?= form_open('', ['method' => 'post', 'class' => 'md-float-material']); ?>

                            <div class="text-center m-0 p-0">
                                <img src="<?= base_url(); ?>utilities/frontend/img/logo2.png"
                                    alt="logo" style="height:180px;">
                            </div>

                            <h4 class="text-center txt-primary m-b-20">
                                Verify OTP
                            </h4>

                            <p class="text-center text-dark">
                                Please enter the 6-digit OTP sent to your email
                            </p>

                            <!-- ERROR MESSAGE -->
                            <?php if (isset($error)): ?>
                                <p class="text-danger text-center"><?= $error; ?></p>
                            <?php endif; ?>

                            <!-- OTP INPUT -->
                            <div class="input-group">
                                <input type="text" name="otp" class="form-control text-center" maxlength="20"
                                    placeholder="Enter OTP" autocomplete="off">
                                <span class="md-line"></span>
                            </div>

                            <!-- VALIDATION ERROR -->
                            <?php if (isset($validation)): ?>
                                <p class="text-danger text-center">
                                    <?= $validation->getError('otp'); ?>
                                </p>
                            <?php endif; ?>

                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="submit"
                                        class="btn btn-primary btn-md btn-block waves-effect text-center">
                                        Verify OTP
                                    </button>
                                </div>
                            </div>
                            <div class="row m-t-10">
                                <div class="col-md-12 text-center">
                                    <p class="text-muted">
                                        © <?= date('Y'); ?> Sri Lakshmi Narayana Nivas Homestays
                                    </p>
                                </div>
                            </div>

                            <?= form_close(); ?>

                        </div>
                    </div>

                </div>
                <!-- END COLUMN -->

            </div>
        </div>
    </section>

</body>

</html>