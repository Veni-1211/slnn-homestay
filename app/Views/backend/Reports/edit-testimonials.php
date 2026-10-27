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
                                    <h3 class="mb-0">Update Testimonials</h3>
                                    <a href="<?= base_url('manage-testimonials') ?>" class="btn btn-primary btn-sm">Manage</a>
                                </div>
                                <div class="card-block">
                                    <form method="post">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Name</b></label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter Name.." name="name" value="<?= $getAllTestimonialDetailsById['name']; ?>">
                                                <span style="color: red;">
                                                    <?php
                                                    if (isset($validation)) {
                                                        if ($validation->hasError('name')) {
                                                            echo $validation->getError('name');
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Ratings</b></label>
                                                <input
                                                    type="number"
                                                    class="form-control"
                                                    name="ratings"
                                                    placeholder="Enter rating (0 – 5)"
                                                    min="0"
                                                    max="5"
                                                    step="0.1" value="<?= $getAllTestimonialDetailsById['ratings']; ?>">
                                                <span style="color: red;">
                                                    <?php
                                                    if (isset($validation)) {
                                                        if ($validation->hasError('ratings')) {
                                                            echo $validation->getError('ratings');
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-form-label"><b>Feedback</b></label>
                                                <textarea rows="5" cols="5" class="form-control" name="feedback"
                                                    placeholder="Enter Feedback"><?= $getAllTestimonialDetailsById['feedback']; ?></textarea>
                                                    
                                                <span style="color: red;">
                                                    <?php
                                                    if (isset($validation)) {
                                                        if ($validation->hasError('feedback')) {
                                                            echo $validation->getError('feedback');
                                                        }
                                                    }
                                                    ?>
                                                </span>

                                            </div>
                                            <div class="col-md-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary btn-md" onclick="this.disabled=true; this.innerText='Submitting...'; this.form.submit();">
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                    </form>
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
