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
                                    <h3 class="mb-0">Edit Bookings</h3>
                                    <a href="<?= base_url('manage-bookings') ?>" class="btn btn-primary btn-sm">Manage</a>
                                </div>
                                <div class="card-block">
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Guest Name</b></label>
                                                <input type="text" class="form-control"
                                                    placeholder="Please enter name" name="name" value="<?= $getBookingDetailsById['name']; ?>">
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
                                                    placeholder="Please enter mobile" name="mobile" value="<?= $getBookingDetailsById['mobile']; ?>" maxlength="10" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
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
                                                    placeholder="Please enter email" name="email" value="<?= $getBookingDetailsById['email']; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Guest Address</b></label>
                                                <textarea rows="1" cols="1" class="form-control" name="address"
                                                    placeholder="Please Enter Address"><?= $getBookingDetailsById['address']; ?></textarea>
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
                                                    name="aadhar" value="<?= $getBookingDetailsById['aadhar']; ?>" id="aadharInput" required>
                                                <div id="aadharPreview" style="margin-top:10px;"></div>
                                                <?php if (!empty($getBookingDetailsById['aadhar'])): ?>
                                                    <div style="margin-top:10px;">
                                                        <?php
                                                        $file = base_url('utilities/backend/GuestAadhar/' . $getBookingDetailsById['aadhar']);
                                                        $ext = pathinfo($getBookingDetailsById['aadhar'], PATHINFO_EXTENSION);
                                                        ?>

                                                        <?php if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])): ?>
                                                            <img src="<?= $file ?>" style="max-width:150px;border:1px solid #ccc;">
                                                            <a href="<?= $file ?>" target="_blank">Open File</a>
                                                        <?php elseif ($ext === 'pdf'): ?>
                                                            <a href="<?= $file ?>" target="_blank">Open existing PDF</a>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-form-label"><b>No. Of Rooms</b></label>
                                                <input type="number" class="form-control" id="no_of_rooms" name="no_of_rooms" min="1" value="<?= $getBookingDetailsById['no_of_rooms']; ?>">
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
                                                    name="check_in" value="<?php echo date('Y-m-d', strtotime($getBookingDetailsById['check_in'])); ?>">
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
                                                    name="check_out" value="<?php echo date('Y-m-d', strtotime($getBookingDetailsById['check_out'])); ?>">
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
                                                    placeholder="Ex: 5 or 6" name="no_of_adults" value="<?= $getBookingDetailsById['no_of_adults']; ?>">
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
                                                    placeholder="Ex: 5 or 6" name="no_of_children" value="<?= $getBookingDetailsById['no_of_children']; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Booking Source</b></label>
                                                <select class="form-control" name="booking_source">
                                                    <option value="">Select Booking Source</option>
                                                    <option value="walkin" <?php if ($getBookingDetailsById['booking_source'] ==  'walkin') {
                                                                                echo 'selected';
                                                                            } ?>>Walk-in</option>
                                                    <option value="phone" <?php if ($getBookingDetailsById['booking_source'] ==  'phone') {
                                                                                echo 'selected';
                                                                            } ?>>Phone Call</option>
                                                    <option value="whatsapp" <?php if ($getBookingDetailsById['booking_source'] ==  'whatsapp') {
                                                                                    echo 'selected';
                                                                                } ?>>WhatsApp</option>
                                                    <option value="website" <?php if ($getBookingDetailsById['booking_source'] ==  'webiste') {
                                                                                echo 'selected';
                                                                            } ?>>Website</option>
                                                    <option value="booking_com" <?php if ($getBookingDetailsById['booking_source'] ==  'booking_com') {
                                                                                    echo 'selected';
                                                                                } ?>>Booking.com</option>
                                                    <option value="makemytrip" <?php if ($getBookingDetailsById['booking_source'] ==  'makemytrip') {
                                                                                    echo 'selected';
                                                                                } ?>>MakeMyTrip</option>
                                                    <option value="goibibo" <?php if ($getBookingDetailsById['booking_source'] ==  'goibibo') {
                                                                                echo 'selected';
                                                                            } ?>>Goibibo</option>
                                                    <option value="agent" <?php if ($getBookingDetailsById['booking_source'] ==  'agent') {
                                                                                echo 'selected';
                                                                            } ?>>Travel Agent</option>
                                                    <option value="corporate" <?php if ($getBookingDetailsById['booking_source'] ==  'corporate') {
                                                                                    echo 'selected';
                                                                                } ?>>Corporate</option>
                                                    <option value="referral" <?php if ($getBookingDetailsById['booking_source'] ==  'referral') {
                                                                                    echo 'selected';
                                                                                } ?>>Referral</option>
                                                    <option value="other" <?php if ($getBookingDetailsById['booking_source'] ==  'other') {
                                                                                echo 'selected';
                                                                            } ?>>Other</option>
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
                                                    <option value="pending" <?php if ($getBookingDetailsById['booking_status'] ==  'pening') {
                                                                                echo 'selected';
                                                                            } ?>>Pending</option>
                                                    <option value="confirmed" <?php if ($getBookingDetailsById['booking_status'] ==  'confirmed') {
                                                                                    echo 'selected';
                                                                                } ?>>Confirmed</option>
                                                    <option value="checked_in" <?php if ($getBookingDetailsById['booking_status'] ==  'checked_in') {
                                                                                    echo 'selected';
                                                                                } ?>>Checked-in</option>
                                                    <option value="checked_out" <?php if ($getBookingDetailsById['booking_status'] ==  'checked_out') {
                                                                                    echo 'selected';
                                                                                } ?>>Checked-out</option>
                                                    <option value="cancelled" <?php if ($getBookingDetailsById['booking_status'] ==  'cancelled') {
                                                                                    echo 'selected';
                                                                                } ?>>Cancelled</option>
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
                                                    name="booking_date" value="<?php echo $getBookingDetailsById['booking_date']; ?>">
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

<script>
    const roomTypes = <?= json_encode($getAllRoomTypeDetails); ?>;
    const allRooms = <?= json_encode($getAllRooms); ?>; // all rooms from DB
    const existingRooms = <?= json_encode($getBookingRoomDetailsById ?? []); ?>;

    function renderRooms(count, existing = []) {
        const container = document.getElementById('roomTypeContainer');
        container.innerHTML = '';

        for (let i = 0; i < count; i++) {

            // ROOM TYPE OPTIONS
            let roomTypeOptions = `<option value="">Select Room Type</option>`;
            roomTypes.forEach(rt => {
                const selected = String(existing[i]?.roomtype_id) === String(rt.sno) ? 'selected' : '';
                roomTypeOptions += `<option value="${rt.sno}" ${selected}>${rt.roomtype}</option>`;
            });

            // ROOM NUMBER OPTIONS
            let roomNumberOptions = `<option value="">Select Room Number</option>`;
            const selectedRoomNo = existing[i]?.room_no ?? '';
            const selectedTypeId = existing[i]?.roomtype_id ?? null;

            allRooms.forEach(room => {
                if (selectedTypeId && parseInt(room.roomtype_id) === parseInt(selectedTypeId)) {
                    const selectedRoom = String(room.room_number) === String(selectedRoomNo) ? 'selected' : '';
                    roomNumberOptions += `<option value="${room.room_number}" ${selectedRoom}>${room.room_number}</option>`;
                }
            });

            // CREATE ROW
            const row = document.createElement('div');
            row.className = 'row mb-2 room-row';
            row.innerHTML = `
                <div class="form-group col-md-5">
                    <label class="col-form-label"><b>Room ${i + 1} Type</b></label>
                    <select class="form-control roomTypeSelect" name="room_type[]" data-index="${i}">
                        ${roomTypeOptions}
                    </select>
                </div>

                <div class="form-group col-md-5">
                    <label class="col-form-label"><b>Room ${i + 1} Number</b></label>
                    <select class="form-control roomNumberSelect" name="room_number[]" data-index="${i}">
                        ${roomNumberOptions}
                    </select>
                </div>

                <div class="form-group col-md-2 d-flex align-items-end">
                    <button type="button"
                        class="btn btn-danger btn-sm w-100"
                        onclick="removeRoom(this)">
                        Delete
                    </button>
                </div>
            `;

            container.appendChild(row);
        }

        // ADD CHANGE EVENT TO ROOM TYPE DROPDOWN
        document.querySelectorAll('.roomTypeSelect').forEach(select => {
            select.addEventListener('change', function() {
                const index = this.dataset.index;
                const selectedType = parseInt(this.value);

                const roomNumberSelect = container.querySelector(`.roomNumberSelect[data-index="${index}"]`);
                roomNumberSelect.innerHTML = `<option value="">Select Room Number</option>`;

                allRooms.forEach(room => {
                    if (parseInt(room.roomtype_id) === selectedType) {
                        roomNumberSelect.innerHTML += `<option value="${room.sno}">${room.room_number}</option>`;
                    }
                });
            });
        });
    }

    function removeRoom(btn) {
        const row = btn.closest('.room-row');
        row.remove();

        const container = document.getElementById('roomTypeContainer');
        const roomCount = container.querySelectorAll('.room-row').length;
        document.getElementById('no_of_rooms').value = roomCount;
    }

    // LOAD ROOMS ON PAGE LOAD
    document.addEventListener('DOMContentLoaded', function() {
        const count = parseInt(document.getElementById('no_of_rooms').value) || 0;
        renderRooms(count, existingRooms);
    });

    // CHANGE ROOMS WHEN NO_OF_ROOMS CHANGES
    document.getElementById('no_of_rooms').addEventListener('input', function() {
        renderRooms(parseInt(this.value) || 0, existingRooms);
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