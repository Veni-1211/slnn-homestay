<div class="pcoded-content">
    <div class="pcoded-inner-content">

        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Basic Form Inputs card start -->
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3 class="mb-0">View Testimonials</h3>
                                    <a href="<?= base_url('manage-testimonials') ?>" class="btn btn-primary btn-sm">Manage</a>
                                </div>
                                <div class="card-block">
                                    <form method="post">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label class="col-form-label"><b>Name</b></label>
                                                <span>: <?= $getAllTestimonialDetailsById['name']; ?></span>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <div class="d-flex align-items-center">
                                                    <label class="col-form-label mb-0 me-2"><b>Ratings</b></label>
                                                    <span class="me-2">:</span>

                                                    <div class="rating-wrapper d-flex align-items-center">
                                                        <div class="stars-outer">
                                                            <div class="stars-inner"
                                                                style="width: <?= ($getAllTestimonialDetailsById['ratings'] / 5) * 100 ?>%;"></div>
                                                        </div>
                                                        <span class="rating-text ms-2">
                                                            (<?= $getAllTestimonialDetailsById['ratings']; ?>)
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-form-label"><b>Feedback</b></label>
                                                <span>: <?= $getAllTestimonialDetailsById['feedback']; ?></span>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page body end -->
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    .rating-wrapper {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .stars-outer {
        position: relative;
        display: inline-block;
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        color: #ccc;
    }

    .stars-outer::before {
        content: "★★★★★";
        font-size: 18px;
    }

    .stars-inner {
        position: absolute;
        top: 0;
        left: 0;
        white-space: nowrap;
        overflow: hidden;
        color: #f4c150;
    }

    .stars-inner::before {
        content: "★★★★★";
        font-size: 18px;
    }
</style>