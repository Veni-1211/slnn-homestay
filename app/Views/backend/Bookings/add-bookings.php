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
                                    <h3 class="mb-0">Add Bookings</h3>
                                    <a href="<?= base_url('manage-bookings') ?>" class="btn btn-primary btn-sm">Manage</a>
                                </div>
                                <div class="card-block">
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Guest Name</b></label>
                                                <input type="text" class="form-control"
                                                    placeholder="Please enter name" name="name" value="<?= set_value('name'); ?>">
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
                                                <label class="col-form-label"><b>Guest Phone Number</b></label>
                                                <input type="tel" class="form-control"
                                                    placeholder="Please enter mobile" name="mobile" value="<?= set_value('mobile'); ?>" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric">
                                                <span style="color: red;">
                                                    <?php
                                                    if (isset($validation)) {
                                                        if ($validation->hasError('mobile')) {
                                                            echo $validation->getError('mobile');
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Guest Email</b></label>
                                                <input type="text" class="form-control"
                                                    placeholder="Please enter email" name="email" value="<?= set_value('email'); ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Guest Address</b></label>
                                                <textarea rows="1" cols="1" class="form-control" name="address"
                                                    placeholder="Please Enter Address"><?= set_value('address'); ?></textarea>
                                                <span style="color: red;">
                                                    <?php
                                                    if (isset($validation)) {
                                                        if ($validation->hasError('address')) {
                                                            echo $validation->getError('address');
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-form-label"><b>Guest Aadhar Card</b></label>
                                                <input type="file" class="form-control"
                                                    name="aadhar" value="<?= set_value('aadhar'); ?>" id="aadharInput" required>
                                                <div id="aadharPreview" style="margin-top:10px;"></div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-form-label"><b>No. Of Rooms</b></label>
                                                <input type="number" class="form-control" id="no_of_rooms" name="no_of_rooms" min="1">
                                                <span style="color: red;">
                                                    <?php
                                                    if (isset($validation)) {
                                                        if ($validation->hasError('no_of_rooms')) {
                                                            echo $validation->getError('no_of_rooms');
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div id="roomTypeContainer"></div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Check-In Date</b></label>
                                                <input type="date" class="form-control"
                                                    name="check_in" value="<?php echo date('Y-m-d'); ?>">
                                                <span style="color: red;">
                                                    <?php
                                                    if (isset($validation)) {
                                                        if ($validation->hasError('check_in')) {
                                                            echo $validation->getError('check_in');
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Check-Out Date</b></label>
                                                <input type="date" class="form-control"
                                                    name="check_out" value="<?php echo date('Y-m-d'); ?>">
                                                <span style="color: red;">
                                                    <?php
                                                    if (isset($validation)) {
                                                        if ($validation->hasError('check_out')) {
                                                            echo $validation->getError('check_out');
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>No. Of Adults</b></label>
                                                <input type="text" class="form-control"
                                                    placeholder="Ex: 5 or 6" name="no_of_adults" value="<?= set_value('no_of_adults'); ?>">
                                                <span style="color: red;">
                                                    <?php
                                                    if (isset($validation)) {
                                                        if ($validation->hasError('no_of_adults')) {
                                                            echo $validation->getError('no_of_adults');
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>No. Of Children</b></label>
                                                <input type="text" class="form-control"
                                                    placeholder="Ex: 5 or 6" name="no_of_children" value="<?= set_value('no_of_children'); ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Booking Source</b></label>
                                                <select class="form-control" name="booking_source">
                                                    <option value="">Select Booking Source</option>
                                                    <option value="walkin" <?php echo set_select('booking_source', 'walkin'); ?>>Walk-in</option>
                                                    <option value="phone" <?php echo set_select('booking_source', 'phone'); ?>>Phone Call</option>
                                                    <option value="whatsapp" <?php echo set_select('booking_source', 'whatsapp'); ?>>WhatsApp</option>
                                                    <option value="website" <?php echo set_select('booking_source', 'webiste'); ?>>Website</option>
                                                    <option value="booking_com" <?php echo set_select('booking_source', 'booking_com'); ?>>Booking.com</option>
                                                    <option value="makemytrip" <?php echo set_select('booking_source', 'makemytrip'); ?>>MakeMyTrip</option>
                                                    <option value="goibibo" <?php echo set_select('booking_source', 'goibibo'); ?>>Goibibo</option>
                                                    <option value="agent" <?php echo set_select('booking_source', 'agent'); ?>>Travel Agent</option>
                                                    <option value="corporate" <?php echo set_select('booking_source', 'corporate'); ?>>Corporate</option>
                                                    <option value="referral" <?php echo set_select('booking_source', 'referral'); ?>>Referral</option>
                                                    <option value="other" <?php echo set_select('booking_source', 'other'); ?>>Other</option>
                                                </select>
                                                <span style="color: red;">
                                                    <?php
                                                    if (isset($validation)) {
                                                        if ($validation->hasError('booking_source')) {
                                                            echo $validation->getError('booking_source');
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Booking Status</b></label>
                                                <select class="form-control" name="booking_status">
                                                    <option value="">Select Booking Source</option>
                                                    <option value="pending" <?php echo set_select('booking_status', 'pening'); ?>>Pending</option>
                                                    <option value="confirmed" <?php echo set_select('booking_status', 'confirmed'); ?>>Confirmed</option>
                                                    <option value="checked_in" <?php echo set_select('booking_status', 'checked_in'); ?>>Checked-in</option>
                                                    <option value="checked_out" <?php echo set_select('booking_status', 'checked_out'); ?>>Checked-out</option>
                                                    <option value="cancelled" <?php echo set_select('booking_status', 'cancelled'); ?>>Cancelled</option>
                                                </select>
                                                <span style="color: red;">
                                                    <?php
                                                    if (isset($validation)) {
                                                        if ($validation->hasError('booking_status')) {
                                                            echo $validation->getError('booking_status');
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Booking Date</b></label>
                                                <input type="date" class="form-control"
                                                    name="booking_date" value="<?php echo date('Y-m-d'); ?>">
                                                <span style="color: red;">
                                                    <?php
                                                    if (isset($validation)) {
                                                        if ($validation->hasError('booking_date')) {
                                                            echo $validation->getError('booking_date');
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            </div>
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
<script>
    const roomTypes = <?= json_encode($getAllRoomTypeDetails); ?>;
    const rooms = <?= json_encode($getAllRooms); ?>;
    document.getElementById('no_of_rooms').addEventListener('input', function() {

        const count = parseInt(this.value) || 0;
        const container = document.getElementById('roomTypeContainer');

        container.innerHTML = ''; // clear old fields

        for (let i = 1; i <= count; i++) {

            // ROOM TYPE OPTIONS
            let roomTypeOptions = `<option value="">Select Room Type</option>`;
            roomTypes.forEach(rt => {
                roomTypeOptions += `<option value="${rt.sno}">${rt.roomtype}</option>`;
            });

            // Create row with Room Type & Room Number
            const row = document.createElement('div');
            row.className = 'row mb-2';
            row.innerHTML = `
            <div class="form-group col-md-6">
                <label class="col-form-label"><b>Room ${i} Type</b></label>
                <select class="form-control roomTypeSelect" name="room_type[]" data-index="${i}">
                    ${roomTypeOptions}
                </select>
            </div>

            <div class="form-group col-md-6">
                <label class="col-form-label"><b>Room ${i} Number</b></label>
                <select class="form-control roomNumberSelect" name="room_number[]" data-index="${i}">
                    <option value="">Select Room Number</option>
                </select>
            </div>
        `;

            container.appendChild(row);
        }

        // Add event listener for Room Type change
        document.querySelectorAll('.roomTypeSelect').forEach(select => {
            select.addEventListener('change', function() {
                const index = this.dataset.index;
                const selectedType = parseInt(this.value); // number

                const roomNumberSelect = container.querySelector(`.roomNumberSelect[data-index="${index}"]`);
                roomNumberSelect.innerHTML = `<option value="">Select Room Number</option>`;

                rooms.forEach(room => {
                    // Convert roomtype_id to number for comparison
                    if (parseInt(room.roomtype_id) === selectedType) {
                        roomNumberSelect.innerHTML += `<option value="${room.room_number}">${room.room_number}</option>`;
                    }
                });
            });
        });

    });
</script>

<script>
    document.getElementById('aadharInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('aadharPreview');
        preview.innerHTML = ''; // clear previous preview

        if (file) {
            const fileType = file.type;

            const reader = new FileReader();

            if (fileType.startsWith('image/')) {
                // For images, show small preview
                reader.onload = function(event) {
                    const img = document.createElement('img');
                    img.src = event.target.result;
                    img.style.maxWidth = '150px';
                    img.style.maxHeight = '100px';
                    img.style.border = '1px solid #ccc';
                    img.style.padding = '2px';
                    preview.appendChild(img);
                }
                reader.readAsDataURL(file);

            } else if (fileType === 'application/pdf') {
                // For PDF, show a clickable link
                const link = document.createElement('a');
                link.href = URL.createObjectURL(file);
                link.target = '_blank';
                link.textContent = 'Open PDF';
                link.style.display = 'inline-block';
                link.style.marginTop = '5px';
                link.style.textDecoration = 'underline';
                preview.appendChild(link);
            } else {
                preview.textContent = 'Preview not available for this file type';
            }
        }
    });
</script>