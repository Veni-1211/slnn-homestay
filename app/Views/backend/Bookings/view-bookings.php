<?php $model = new App\Models\backend\BookingsModel(); ?>
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
                                            <label class="col-form-label"><b>Booking Id</b></label>
                                            <span>: <?php echo $getBookingDetailsById['booking_id']; ?></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label"><b>Guest Name</b></label>
                                            <span>: <?php echo $getBookingDetailsById['name']; ?></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label"><b>Guest Mobile</b></label>
                                            <span>: <?= ($getBookingDetailsById['mobile'] == '') ? 'NA' : $getBookingDetailsById['mobile']; ?></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label"><b>Guest Email</b></label>
                                            <span>: <?= ($getBookingDetailsById['email'] == '') ? 'NA' : $getBookingDetailsById['email']; ?></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label"><b>Aadhar Card</b></label>
                                            <span>:
                                                <?= empty($getBookingDetailsById['aadhar'])
                                                    ? 'NA'
                                                    : '<a href="' . base_url('utilities/backend/GuestAadhar/' . $getBookingDetailsById['aadhar']) . '" target="_blank">View</a>'
                                                ?>
                                            </span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label"><b>Check In</b></label>
                                            <span>: <?= ($getBookingDetailsById['check_in'] == '') ? 'NA' : $getBookingDetailsById['check_in']; ?></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label"><b>Check Out</b></label>
                                            <span>: <?= ($getBookingDetailsById['check_out'] == '') ? 'NA' : $getBookingDetailsById['check_out']; ?></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label"><b>No. Of Adults</b></label>
                                            <span>: <?= ($getBookingDetailsById['no_of_adults'] == '') ? 'NA' : $getBookingDetailsById['no_of_adults']; ?></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label"><b>No. Of Children</b></label>
                                            <span>: <?= ($getBookingDetailsById['no_of_children'] == '') ? 'NA' : $getBookingDetailsById['no_of_children']; ?></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label"><b>Booking Source</b></label>
                                            <span>: <?= ($getBookingDetailsById['booking_source'] == '') ? 'NA' : $getBookingDetailsById['booking_source']; ?></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label"><b>Booking Status</b></label>
                                            <span>: <?= ($getBookingDetailsById['booking_status'] == '') ? 'NA' : $getBookingDetailsById['booking_status']; ?></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label"><b>Booking Date</b></label>
                                            <span>: <?= ($getBookingDetailsById['booking_date'] == '') ? 'NA' : $getBookingDetailsById['booking_date']; ?></span>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-form-label"><b>Room Details</b></label>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>SNO</th>
                                                    <th>ROOM TYPE</th>
                                                    <th>ROOM NUMBER</th>
                                                </tr>
                                                <?php if (!empty($getBookingRoomDetailsById)) { ?>
                                                    <?php $a = 1;
                                                    foreach ($getBookingRoomDetailsById as $room) { ?>
                                                    <tr>
                                                        <td><?= $a++; ?></td>
                                                        <td><?= $model->getRoomTypeDetailsById($room['roomtype_id'])['roomtype']; ?></td>
                                                        <td><?= $room['room_no']; ?></td>
                                                    </tr>
                                                    <?php }
                                                } else { ?>
                                                    <tr>
                                                        <td class="text-center">No Details</td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-end">
                                            <a href="<?php echo base_url(); ?>manage-bookings" class="btn btn-secondary btn-md">
                                                Back
                                            </a>
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