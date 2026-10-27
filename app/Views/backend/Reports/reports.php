<?php $model = new App\Models\backend\ReportsModel(); ?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="mb-0">Reports</h3>
                        </div>
                        <div class="row mb-3 px-3">
                            <div class="col-md-3">
                                <b>Booking Id:</b>
                                <input type="text" id="filterBookingId" class="form-control"
                                    placeholder="Search Booking ID">
                            </div>

                            <div class="col-md-3">
                                <b> Mobile Number: </b>
                                <input type="text" id="filterMobile" class="form-control"
                                    placeholder="Search Mobile">
                            </div>

                            <div class="col-md-3">
                                <b>From Date:</b>
                                <input type="date" id="filterFromDate" class="form-control">
                            </div>

                            <div class="col-md-3">
                                <b>To Date:</b>
                                <input type="date" id="filterToDate" class="form-control">
                            </div>
                        </div>

                        <div class="mx-5 mb-3 font-size-16">
                            Total Bookings: <span id="totalBookings">0</span> |
                            Total Revenue: <span id="totalRevenue">₹0</span> |
                            Total Paid: <span id="totalPaid">₹0</span> |
                            Top Room: <span id="topRoom">N/A</span>
                        </div>

                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>SNO</th>
                                            <th>Booking Id</th>
                                            <th>Mobile Number</th>
                                            <th>No. of Rooms</th>
                                            <th>Total Amount</th>
                                            <th>Paid Amount</th>
                                            <th>Balance Amount</th>
                                            <th class="none">Guest Name</th>
                                            <th class="none">Email</th>
                                            <th class="none">Address</th>
                                            <th class="none">Check IN</th>
                                            <th class="none">Check Out</th>
                                            <th class="none">No Of People</th>
                                            <th class="none">Booking Source</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($getAllBookingDetails)) { ?>
                                            <tr>
                                                <td colspan="8" class="text-center">No Bookings Available</td>
                                            </tr>
                                        <?php } else { ?>
                                            <?php $a = 1;
                                            foreach ($getAllBookingDetails as $book) {

                                                $payment = $model->getPaymentTotalsByBookingId($book->booking_id);
                                                $rooms   = $model->getAllBookingRoomDetailsBySno($book->sno);
                                            ?>

                                                <?php
                                                $roomNames = [];
                                                foreach ($rooms as $r) {
                                                    // Fetch the room name from room_types table by ID
                                                    $roomType = $model->getRoomTypeById($r['roomtype']); // You need a function like this in your model
                                                    if ($roomType) {
                                                        $roomNames[] = $roomType['roomtype']; // 'roomtype' column has the name
                                                    }
                                                }
                                                $roomNamesString = implode(',', $roomNames);
                                                ?>

                                                <tr class="report-row"
                                                    data-booking-id="<?= strtolower($book->booking_id) ?>"
                                                    data-mobile="<?= $book->mobile ?>"
                                                    data-date="<?= date('Y-m-d', strtotime($book->created_on)) ?>"
                                                    data-total="<?= $payment['total_amount'] ?? 0 ?>"
                                                    data-paid="<?= $payment['paid_amount'] ?? 0 ?>"
                                                    data-room="<?= $roomNamesString ?>">
                                                    <td><?= $a++; ?></td>
                                                    <td><?= $book->booking_id; ?></td>
                                                    <td><?= $book->mobile; ?></td>
                                                    <td><?= count($rooms); ?></td>
                                                    <td><?= $payment['total_amount'] ?? 0; ?></td>
                                                    <td><?= $payment['paid_amount'] ?? 0; ?></td>
                                                    <td><?= $payment['balance_amount'] ?? 0; ?></td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
        </div>
    </div>
</div>
<style>
    .action-icon {
        margin: 0 6px 0 0;
        font-size: 16px;
        cursor: pointer;
        display: inline-block;
    }

    .action-icon.view {
        color: #17a2b8;
    }

    .action-icon.edit {
        color: #ffc107;
    }

    .action-icon.delete {
        color: #dc3545;
    }

    .action-icon:hover {
        opacity: 1;
        transform: scale(1.1);
    }

    .none {
        display: none;
    }
</style>
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const bookingInput = document.getElementById('filterBookingId');
        const mobileInput = document.getElementById('filterMobile');
        const fromDate = document.getElementById('filterFromDate');
        const toDate = document.getElementById('filterToDate');

        function applyFilters() {

            const rows = document.querySelectorAll('.report-row');
            let totalBookings = 0;
            let totalRevenue = 0;
            let totalPaid = 0;
            let roomCount = {};

            rows.forEach(row => {

                let show = true;

                const bookingId = (row.dataset.bookingId || '').toLowerCase();
                const mobile = (row.dataset.mobile || '').toLowerCase();
                const date = row.dataset.date || '';
                const total = parseFloat(row.dataset.total) || 0;
                const paid = parseFloat(row.dataset.paid) || 0;
                const rooms = (row.dataset.room || '').split(',');

                if (bookingInput.value.trim() && !bookingId.includes(bookingInput.value.trim().toLowerCase())) {
                    show = false;
                }

                if (mobileInput.value.trim() && !mobile.includes(mobileInput.value.trim().toLowerCase())) {
                    show = false;
                }

                if (fromDate.value && date < fromDate.value) show = false;
                if (toDate.value && date > toDate.value) show = false;

                row.style.display = show ? '' : 'none';

                if (show) {
                    totalBookings++;
                    totalRevenue += total;
                    totalPaid += paid;

                    rooms.forEach(r => {
                        r = r.trim();
                        if (r) roomCount[r] = (roomCount[r] || 0) + 1;
                    });
                }
            });

            // Update summary
            document.getElementById('totalBookings').textContent = totalBookings;
            document.getElementById('totalRevenue').textContent = '₹' + totalRevenue;
            document.getElementById('totalPaid').textContent = '₹' + totalPaid;

            // Top room
            let topRoom = 'N/A',
                max = 0;
            for (let r in roomCount) {
                if (roomCount[r] > max) {
                    max = roomCount[r];
                    topRoom = r;
                }
            }
            document.getElementById('topRoom').textContent = topRoom;

            // ✅ Show "No Data Found" if nothing visible
            const tbody = document.querySelector('table tbody');
            let noDataRow = tbody.querySelector('.no-data-row');

            if (!noDataRow) {
                noDataRow = document.createElement('tr');
                noDataRow.classList.add('no-data-row');
                noDataRow.innerHTML = `<td colspan="14" class="text-center">No matching bookings found</td>`;
                tbody.appendChild(noDataRow);
            }

            noDataRow.style.display = (totalBookings === 0) ? '' : 'none';
        }

        // Event listeners
        bookingInput.addEventListener('input', applyFilters);
        mobileInput.addEventListener('input', applyFilters);
        fromDate.addEventListener('change', applyFilters);
        toDate.addEventListener('change', applyFilters);

        applyFilters(); // initial load
    });
</script>