<?php $model = new App\Models\backend\RoomsModel; ?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">

        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2>View Room Details</h2>
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label"><b>Room Type</b></label>
                                            <span>: <?php echo $model->getRoomTypeDetailsById($getRoomDetailsById['roomtype_id'])['roomtype']; ?></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label"><b>Room Number</b></label>
                                            <span>: <?php echo $getRoomDetailsById['room_number']; ?></span>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-end">
                                            <a href="<?php echo base_url(); ?>manage-rooms" class="btn btn-secondary btn-md">
                                                Back
                                            </a>
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