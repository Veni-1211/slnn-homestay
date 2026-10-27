<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sri Lakshmi Narayana Nivasam Home Stay </title>
    <link href="<?php echo base_url(); ?>utilities/frontend/img/icon2.png" rel="icon">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet"
        href="<?= base_url(); ?>utilities/backend/assets/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="<?= base_url(); ?>utilities/backend/assets/css/style.css">
</head>

<body class="fix-menu">

    <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
        <div class="container">
            <div class="row justify-content-center align-items-center" style="min-height:100vh;">
                <div class="col-md-6">

                    <div class="auth-box card">
                        <div class="card-block">

                            <?= form_open('', ['method' => 'post', 'class' => 'md-float-material']); ?>

                            <div class="text-center">
                                <img src="<?= base_url(); ?>utilities/frontend/img/logo2.png"
                                    style="height:180px;">
                            </div>

                            <h4 class="text-center text-dark m-b-20 mt-2">
                                Verify OTP
                            </h4>

                            <?php if (isset($error)): ?>
                                <p class="text-danger text-center"><?= $error; ?></p>
                            <?php endif; ?>

                            <div class="input-group">
                                <input type="text"
                                    name="otp"
                                    class="form-control text-center"
                                    placeholder="Enter OTP"
                                    maxlength="20"
                                    required>
                            </div>

                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="submit"
                                        class="btn btn-primary btn-md btn-block">
                                        Verify & Change Password
                                    </button>
                                </div>
                            </div>

                            <?= form_close(); ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</body>

</html>