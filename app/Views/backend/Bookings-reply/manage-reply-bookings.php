<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="mb-0">Manage Booking Replies</h3>
                        </div>

                        <div class="card-block table-border-style">

                            <!-- FLASH MESSAGES -->
                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success">
                                    <?= session()->getFlashdata('success') ?>
                                </div>
                            <?php endif; ?>

                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger">
                                    <?= session()->getFlashdata('error') ?>
                                </div>
                            <?php endif; ?>

                            <!-- SEARCH BOX -->
                            <div class="row mb-3 p-2">
                                <div class="col-md-4">
                                    <input type="text"
                                           id="bookingSearchBox"
                                           class="form-control" style="width:400px";
                                           placeholder="Search by name, email, mobile, room type">
                                </div>
                            </div>

                            <!-- TABLE -->
                            <div class="table-responsive p-2">
                                <table class="table table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>SNo</th>
                                            <th>Check In</th>
                                            <th>Check Out</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Room Type</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php if (empty($replyBookingsEnquires)) { ?>
                                        <tr>
                                            <td colspan="9" class="text-center text-muted">
                                                No Bookings Found
                                            </td>
                                        </tr>
                                    <?php } else { ?>
                                        <?php $i = 1; foreach ($replyBookingsEnquires as $booking) { ?>
                                            <tr class="booking-search-row">
                                                <td><?= $i++ ?></td>
                                                <td><?= esc(date('d M Y', strtotime($booking->check_in))); ?></td>
                                                <td><?= esc(date('d M Y', strtotime($booking->check_out))); ?></td>
                                                <td><?= esc($booking->name) ?></td>
                                                <td><?= esc($booking->email) ?></td>
                                                <td><?= esc($booking->mobile_no) ?></td>
                                                <td><?= esc($booking->room_type) ?></td>
                                                <td>
                                                    <?php if (!empty($bookingReplies[$booking->sno])) { ?>
                                                        <span class="label label-success">Replied</span>
                                                    <?php } else { ?>
                                                        <span class="label label-danger">Pending</span>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0);"
                                                       data-toggle="modal"
                                                       data-target="#bookingModal_<?= $booking->sno ?>"
                                                       class="action-icon report"
                                                       title="View Replies">
                                                        <i class="ti-comment-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>

                                    <!-- NO SEARCH RESULTS -->
                                    <tr id="noBookingResults" style="display:none;">
                                        <td colspan="9" class="text-center text-muted">
                                            No results found
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODALS ================= -->
<?php foreach ($replyBookingsEnquires as $booking): ?>
<div class="modal fade" id="bookingModal_<?= $booking->sno ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- HEADER -->
            <div class="modal-header">
                <h5 class="modal-title">Booking Replies</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- BODY -->
            <div class="modal-body">

                <h6 class="font-weight-bold">Previous Replies</h6>

                <?php if (!empty($bookingReplies[$booking->sno])): ?>
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th style="width:30px;">Id</th>
                                <th>Reply</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $j=1; foreach ($bookingReplies[$booking->sno] as $reply): ?>
                            <tr>
                                <td><?= $j++ ?></td>
                                <td><?= esc($reply->reply) ?></td>
                                <td><?= date('d M Y h:i A', strtotime($reply->created_at)) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center text-muted">No replies yet</p>
                <?php endif; ?>

                <hr>

                <!-- NEW REPLY -->
                <form method="post" action="<?= base_url('save-booking-reply') ?>">
                    <?= csrf_field() ?>
                    <input type="hidden" name="booking_id" value="<?= $booking->sno ?>">

                    <div class="form-group">
                        <h5>New Feedback</h5>
                        <textarea name="reply" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="text-right">
                        <button class="btn btn-primary btn-sm">
                            Send Reply
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- ================= SEARCH SCRIPT ================= -->
<script>
document.getElementById("bookingSearchBox").addEventListener("keyup", function () {
    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll(".booking-search-row");
    let visible = 0;

    rows.forEach(row => {
        if (row.innerText.toLowerCase().includes(value)) {
            row.style.display = "";
            visible++;
        } else {
            row.style.display = "none";
        }
    });

    document.getElementById("noBookingResults").style.display =
        visible === 0 ? "" : "none";
});
</script>

<!-- ================= SMALL UI STYLE ================= -->
<style>
.action-icon {
    font-size: 16px;
    cursor: pointer;
}
.action-icon.report {
    color: #6f42c1;
}
.table td, .table th {
    vertical-align: middle;
}
</style>
