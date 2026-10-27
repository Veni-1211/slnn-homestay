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
                                <div class="card-header">
                                    <h2>View Room Types</h2>
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label"><b>Room Types</b></label>
                                            <span>: <?php echo $getRoomTypeDetailsById['roomtype']; ?></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label"><b>Price Per Night</b></label>
                                            <span>: <?php echo $getRoomTypeDetailsById['price_per_night']; ?></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label"><b>Max Adults</b></label>
                                            <span>: <?= ($getRoomTypeDetailsById['max_adults'] == '') ? 'NA' : $getRoomTypeDetailsById['max_adults']; ?></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label"><b>Max Children</b></label>
                                            <span>: <?= ($getRoomTypeDetailsById['max_children'] == '') ? 'NA' : $getRoomTypeDetailsById['max_children']; ?></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label"><b>Weekend Price</b></label>
                                            <span>: <?= ($getRoomTypeDetailsById['weekend_price'] == '') ? 'NA' : $getRoomTypeDetailsById['weekend_price']; ?></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label"><b>Seasonal Price</b></label>
                                            <span>: <?= ($getRoomTypeDetailsById['seasonal_price'] == '') ? 'NA' : $getRoomTypeDetailsById['seasonal_price']; ?></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label"><b>Extra Adult Price</b></label>
                                            <span>: <?= ($getRoomTypeDetailsById['extra_adult_price'] == '') ? 'NA' : $getRoomTypeDetailsById['extra_adult_price']; ?></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label"><b>Extra Children Price</b></label>
                                            <span>: <?= ($getRoomTypeDetailsById['extra_children_price'] == '') ? 'NA' : $getRoomTypeDetailsById['extra_children_price']; ?></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label"><b>Cleaning Fee</b></label>
                                            <span>: <?= ($getRoomTypeDetailsById['cleaning_fee'] == '') ? 'NA' : $getRoomTypeDetailsById['cleaning_fee']; ?></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label"><b>Service Charges</b></label>
                                            <span>: <?= ($getRoomTypeDetailsById['service_charges'] == '') ? 'NA' : $getRoomTypeDetailsById['service_charges']; ?></span>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-form-label"><b>Description</b></label>
                                            <span>: <?= ($getRoomTypeDetailsById['description'] == '') ? 'NA' : $getRoomTypeDetailsById['description']; ?></span>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-end">
                                            <a href="<?php echo base_url(); ?>manage-room-types" class="btn btn-secondary btn-md">
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