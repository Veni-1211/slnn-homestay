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
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
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
                                    alt="logo.png" style="height:170px;">
                            </div>
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-left txt-primary text-center">Forgot Password</h3>
                                </div>
                            </div>
                            <hr />
                            <div class="input-group">
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                                <span class="md-line"></span>
                            </div>
                            <p class="text-danger" id="error">
                                <?php
                                if (isset($validation)) {
                                    if ($validation->hasError('email')) {
                                        echo $validation->getError('email');
                                    }
                                }
                                ?>
                            </p>
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
                                        class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Submit</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php echo form_close(); ?>
                    <!-- end of form -->
                </div>
                <!-- Authentication card end -->
            </div>
            <!-- end of col-sm-12 -->
        </div>
        <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 9]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
    <!-- Warning Section Ends -->
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