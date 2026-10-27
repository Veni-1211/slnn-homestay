<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themewagon.github.io/guruable2/auth-normal-sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 Dec 2025 16:03:45 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <title>Sri Lakshmi Narayana Nivasam Home Stay </title>
    <link href="<?php echo base_url(); ?>utilities/frontend/img/icon2.png" rel="icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="CodedThemes">
    <meta name="keywords"
        content=" Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="CodedThemes">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url(); ?>utilities/backend/assets/css/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url(); ?>utilities/backend/assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url(); ?>utilities/backend/assets/icon/icofont/css/icofont.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>utilities/backend/assets/css/style.css">
</head>

<body class="fix-menu">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="login-card card-block auth-body mr-auto ml-auto">

                        <?php
                        $attributes = [
                            'class' => 'md-float-material',
                            'method' => 'post'
                        ];
                        echo form_open('', $attributes);
                        ?>

                        <div class="auth-box">
                            <div class="text-center">
                                <img src="<?php echo base_url(); ?>utilities/frontend/img/logo2.png"
                                    alt="logo.png" style="height:180px;">
                            </div>

                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="txt-primary text-center">Sign In</h3>
                                </div>
                            </div>

                            <hr />

                            <!-- EMAIL / MOBILE -->
                            <div class="form-group text-left">
                                <input type="text" name="login" id="login" class="form-control"
                                    placeholder="Email or Mobile" value="<?= set_value('login'); ?>">

                                <?php if (isset($validation) && $validation->hasError('login')): ?>
                                    <small class="text-danger">
                                        <?= $validation->getError('login'); ?>
                                    </small>
                                <?php endif; ?>
                            </div>

                            <!-- PASSWORD -->
                            <div class="form-group text-left">
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Password">

                                <?php if (isset($validation) && $validation->hasError('password')): ?>
                                    <small class="text-danger">
                                        <?= $validation->getError('password'); ?>
                                    </small>
                                <?php endif; ?>
                            </div>

                            <!-- GENERAL LOGIN ERROR -->
                            <?php if (isset($error)): ?>
                                <p class="text-danger text-center"><?= $error; ?></p>
                            <?php endif; ?>

                            <div class="row m-t-25">
                                <div class="col-sm-7">
                                    <a href="<?php echo base_url(); ?>forgot-password" class="f-w-600 text-inverse">
                                        Forgot Your Password?
                                    </a>
                                </div>
                            </div>

                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-md btn-block waves-effect">
                                        Sign in
                                    </button>
                                </div>
                            </div>
                        </div>

                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Required Jquery -->
    <script type="text/javascript"
        src="<?php echo base_url(); ?>utilities/backend/assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript"
        src="<?php echo base_url(); ?>utilities/backend/assets/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript"
        src="<?php echo base_url(); ?>utilities/backend/assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript"
        src="<?php echo base_url(); ?>utilities/backend/assets/js/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript"
        src="<?php echo base_url(); ?>utilities/backend/assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript"
        src="<?php echo base_url(); ?>utilities/backend/assets/js/modernizr/modernizr.js"></script>
    <script type="text/javascript"
        src="<?php echo base_url(); ?>utilities/backend/assets/js/modernizr/css-scrollbars.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>utilities/backend/assets/js/common-pages.js"></script>
</body>


<!-- Mirrored from themewagon.github.io/guruable2/auth-normal-sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 Dec 2025 16:03:47 GMT -->

</html>