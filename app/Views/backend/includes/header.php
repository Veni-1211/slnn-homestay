<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sri Lakshmi Narayana Nivasam Home Stay </title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="<?php echo base_url(); ?>utilities/frontend/img/icon2.png" rel="icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url(); ?>utilities/backend/assets/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>utilities/backend/assets/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url(); ?>utilities/backend/assets/icon/icofont/css/icofont.css">
    <link rel="stylesheet" href="<?= base_url(); ?>utilities/backend/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>utilities/backend/assets/css/jquery.mCustomScrollbar.css">
</head>

<body>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>

        <div class="pcoded-container navbar-wrapper">

            <!-- ================= HEADER ================= -->
            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>

                        <a href="<?= base_url('dashboard'); ?>">
                            <h6 class="fw-bold">Sri Lakshmi Narayana Nivas</h6><b>Home Stay</b>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <a href="javascript:void(0)" onclick="toggleFullScreen()">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>

                        <ul class="nav-right">
                            <li class="user-profile header-notification">
                                <a href="#!">
                                    <img src="<?php echo base_url(); ?>utilities/frontend/img/icon2.png"
                                        class="img-radius rounded">
                                    <span>Admin</span>
                                    <i class="ti-angle-down"></i>
                                </a>

                                <ul class="show-notification profile-notification">
                                    <li>
                                        <a href="<?= base_url('change-password'); ?>">
                                            <i class="ti-lock"></i> Change Password
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('logout'); ?>">
                                            <i class="ti-power-off"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>
            </nav>

            <!-- ================= MAIN ================= -->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    <!-- ================= SIDEBAR ================= -->
                    <nav class="pcoded-navbar">
                        <div class="pcoded-inner-navbar main-menu">

                            <!-- DASHBOARD -->
                            <div class="pcoded-navigatio-lavel">Dashboard</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="active">
                                    <a href="<?= base_url('dashboard'); ?>">
                                        <span class="pcoded-micon">
                                            <i class="ti-dashboard"></i>
                                        </span>
                                        <span class="pcoded-mtext">Dashboard</span>
                                    </a>
                                </li>
                            </ul>
                            
                            <!-- ENQUIRIES -->
                            <div class="pcoded-navigatio-lavel">Enquiries</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon">
                                            <i class="icofont icofont-bed"></i>
                                        </span>
                                        <span class="pcoded-mtext">Contact Enquires</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li><a href="<?= base_url('manage-contact-reply'); ?>">Manage Contact
                                                Enquires</a></li>
                                    </ul>
                                </li>
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon">
                                            <i class="icofont icofont-bed"></i>
                                        </span>
                                        <span class="pcoded-mtext">Booking Enquires</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li><a href="<?= base_url('manage-reply-bookings'); ?>">Manage Bookings
                                                Enquires</a></li>
                                    </ul>
                                </li>
                            </ul>
                            
                            
                            <!-- ROOMS -->
                            <div class="pcoded-navigatio-lavel">Rooms</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon">
                                            <i class="icofont icofont-bed"></i>
                                        </span>
                                        <span class="pcoded-mtext">Rooms</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li><a href="<?= base_url('manage-room-types'); ?>">Manage Room Types</a></li>
                                        <li><a href="<?= base_url('add-room-types'); ?>">Add Room Types</a></li>
                                        <li><a href="<?= base_url('manage-rooms'); ?>">Manage Rooms</a></li>
                                        <li><a href="<?= base_url('add-rooms'); ?>">Add Rooms</a></li>
                                    </ul>
                                </li>
                            </ul>

                            <!-- BOOKINGS -->
                            <div class="pcoded-navigatio-lavel">Bookings</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon">
                                            <i class="ti-calendar"></i>
                                        </span>
                                        <span class="pcoded-mtext">Room Bookings</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li><a href="<?= base_url('manage-bookings'); ?>">Manage Bookings</a></li>
                                        <li><a href="<?= base_url('add-bookings'); ?>">Add Booking</a></li>
                                    </ul>
                                </li>
                            </ul>
                            
                            <div class="pcoded-navigatio-lavel">Availability</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li>
                                    <a href="<?= base_url('rooms-availability'); ?>">
                                        <span class="pcoded-micon">
                                            <i class="ti-email"></i>
                                        </span>
                                        <span class="pcoded-mtext">Rooms Availability</span>
                                    </a>
                                </li>
                            </ul>
                            
                            
                            <!-- Testimonials -->
                            <div class="pcoded-navigatio-lavel">Reviews</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon">
                                            <i class="icofont icofont-star"></i>
                                        </span>
                                        <span class="pcoded-mtext">Reviews</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li><a href="<?= base_url('manage-testimonials'); ?>">Manage Feedbacks</a></li>
                                        <li><a href="<?= base_url('add-testimonials'); ?>">Add Feedback</a></li>
                                    </ul>
                                </li>
                            </ul>
                            
                             <!-- Reports -->
                            <div class="pcoded-navigatio-lavel">Reports</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="active">
                                    <a href="<?= base_url('reports'); ?>">
                                        <span class="pcoded-micon">
                                            <i class="icofont icofont-chart-bar-graph"></i>
                                        </span>
                                        <span class="pcoded-mtext">Report</span>
                                    </a>
                                </li>
                            </ul>

                            <!-- BILLINGS -->
                            <!-- <div class="pcoded-navigatio-lavel">Billings</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon">
                                            <i class="ti-receipt"></i>
                                        </span>
                                        <span class="pcoded-mtext">Billings</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li><a href="<= base_url('manage-billings'); ?>">Manage Billings</a></li>
                                        <li><a href="<= base_url('add-billing'); ?>">Create Billing</a></li>
                                    </ul>
                                </li>
                            </ul> -->

                            
                           
                            
                            
                            <!-- GUESTS -->
                            <!-- <div class="pcoded-navigatio-lavel">Guests</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li>
                                    <a href="<= base_url('manage-guests'); ?>">
                                        <span class="pcoded-micon">
                                            <i class="ti-id-badge"></i>
                                        </span>
                                        <span class="pcoded-mtext">Guest Details</span>
                                    </a>
                                </li>
                            </ul> -->

                            <!-- PAYMENTS -->
                            <!-- <div class="pcoded-navigatio-lavel">Payments</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li>
                                    <a href="<= base_url('payments'); ?>">
                                        <span class="pcoded-micon">
                                            <i class="ti-credit-card"></i>
                                        </span>
                                        <span class="pcoded-mtext">Payment History</span>
                                    </a>
                                </li>
                            </ul> -->

                            <!-- GALLERY -->
                            <!-- <div class="pcoded-navigatio-lavel">Gallery</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon">
                                            <i class="ti-image"></i>
                                        </span>
                                        <span class="pcoded-mtext">Gallery</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li><a href="<= base_url('manage-gallery'); ?>">Manage Gallery</a></li>
                                        <li><a href="<= base_url('add-gallery'); ?>">Add Images</a></li>
                                    </ul>
                                </li>
                            </ul> -->

                        </div>
                    </nav>
                    <style>
                        .pcoded .pcoded-item.pcoded-left-item>li:nth-child(2)>a>.pcoded-micon {
                            background-color: #4680ff;
                        }
                    </style>