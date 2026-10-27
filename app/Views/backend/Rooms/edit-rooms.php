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
                                    <h3 class="mb-0">Edit Rooms</h3>
                                    <a href="<?= base_url('manage-rooms') ?>" class="btn btn-primary btn-sm">Manage</a>
                                </div>

                                <div class="card-block">
                                    <form method="POST">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Room Types</b></label>
                                                <select class="form-control" name="roomtype_id">
                                                    <option value="">Select One </option>
                                                    <?php if (!empty($getAllRoomTypeDetails)) { ?>
                                                        <?php foreach ($getAllRoomTypeDetails as $room) { ?>
                                                            <option value="<?php echo $room->sno; ?>" <?php if($getRoomDetailsById['roomtype_id'] == $room->sno) {echo 'selected'; } ?>><?php echo $room->roomtype; ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                                <span style="color: red;">
                                                    <?php
                                                    if (isset($validation)) {
                                                        if ($validation->hasError('roomtype_id')) {
                                                            echo $validation->getError('roomtype_id');
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Room Number</b></label>
                                                <input type="text" class="form-control"
                                                    placeholder="Ex: 101 / 204" name="room_number" value="<?php echo $getRoomDetailsById['room_number']; ?>">
                                                <span style="color: red;">
                                                    <?php
                                                    if (isset($validation)) {
                                                        if ($validation->hasError('room_number')) {
                                                            echo $validation->getError('room_number');
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="col-md-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary btn-md" onclick="this.disabled=true; this.innerText='Submitting...'; this.form.submit();">
                                                    Submit
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