<?php

use App\Models\backend\ReplyContactModel;

$model = new ReplyContactModel();
?>

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">

                    <div class="card">
                        <div class="card-header">
                            <h3>Manage Contact Replies</h3>
                        </div>

                        <div class="card-block">

                            <!-- FLASH -->
                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                            <?php endif; ?>

                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                            <?php endif; ?>

                            <!-- SEARCH -->
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <input type="text" id="searchBox" class="form-control"
                                        placeholder="Search by Name or Email">
                                </div>
                            </div>

                            <!-- TABLE -->
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php if (!empty($replyContactEnquires)): ?>
                                            <?php $i = 1;
                                            foreach ($replyContactEnquires as $contact): ?>
                                                <tr class="search-row">
                                                    <td><?= $i++ ?></td>
                                                    <td><?= esc($contact->name) ?></td>
                                                    <td><?= esc($contact->email) ?></td>
                                                    <td><?= esc($contact->mobile) ?></td>
                                                    <!-- <td><= esc($contact->message) ?></td> -->
                                                    <td>
                                                        <?= $contact->status == 1 || $contact->email_status == 1
                                                            ? '<span class="label label-success">Replied</span>'
                                                            : '<span class="label label-danger">Pending</span>' ?>
                                                    </td>
                                                    <td>
                                                        <!-- MOBILE -->
                                                        <a href="javascript:void(0);" data-toggle="modal"
                                                            data-target="#replyModal_mobile_<?= $contact->sno ?>">
                                                            <i class="ti-mobile"></i>
                                                        </a>

                                                        &nbsp;&nbsp;

                                                        <!-- EMAIL -->
                                                        <?php if ($contact->email_status == 0): ?>
                                                            <a href="javascript:void(0);" data-toggle="modal"
                                                                data-target="#replyModal_email_<?= $contact->sno ?>">
                                                                <i class="ti-email"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">No records found</td>
                                            </tr>
                                        <?php endif; ?>
                                        <tr id="noResultsRow" style="display:none;">
                                            <td colspan="6" class="text-center text-muted">No data found</td>
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

<!-- ================= MOBILE MODALS ================= -->
<?php if (empty($replyContactEnquires)) { ?>
    <tr>
        <td colspan="9" class="text-center text-muted">
            No Enquries Found
        </td>
    </tr>
<?php } else { ?>
    <?php foreach ($replyContactEnquires as $contact):
        $mobileReplies = $model->getPreviousRepliesByType($contact->sno, 'mobile');
    ?>
        <div class="modal fade" id="replyModal_mobile_<?= $contact->sno ?>" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5>Mobile Replies</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="mt-2">
                                    <b>&nbsp;&nbsp;&nbsp;&nbsp;Subject:</b>&nbsp;&nbsp;<?php echo $contact->subject; ?>
                                </p>
                            </div>
                            <div class="col-md-12">
                                <p class="mt-0">
                                    <b>&nbsp;&nbsp;&nbsp;&nbsp;Message:</b>&nbsp;&nbsp;<?php echo $contact->message; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <?php if (!empty($mobileReplies)): ?>
                            <table class="table table-bordered table-sm">
                                <tbody>
                                    <tr>
                                        <th style="width:30px;">S.No</th>
                                        <th>Reply</th>
                                        <th>Date & Time</th>
                                    </tr>
                                    <?php $a=1; foreach ($mobileReplies as $reply): ?>
                                        <tr>
                                            <td><?= $a++; ?></td>
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
                        <h5>New Reply</h5>
                        <form method="post" action="<?= base_url('save-mobile-reply') ?>">
                            <?= csrf_field() ?>
                            <input type="hidden" name="contact_id" value="<?= $contact->sno ?>">
                            <textarea name="reply" class="form-control" rows="3" required></textarea>
                            <div class="text-right mt-2">
                                <button class="btn btn-primary btn-sm">Send</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php } ?>


<!-- ================= EMAIL MODALS ================= -->
<?php if (empty($replyContactEnquires)) { ?>
    <tr>
        <td colspan="9" class="text-center text-muted">
            No Enquiry Found
        </td>
    </tr>
<?php } else { ?>
    <?php foreach ($replyContactEnquires as $contact):
        $emailReplies = $model->getPreviousRepliesByType($contact->sno, 'email');
    ?>
        <div class="modal fade" id="replyModal_email_<?= $contact->sno ?>" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5>Email Replies</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="mt-2">
                                    <b>&nbsp;&nbsp;&nbsp;&nbsp;Subject:</b>&nbsp;&nbsp;<?php echo $contact->subject; ?>
                                </p>
                            </div>
                            <div class="col-md-12">
                                <p class="mt-0">
                                    <b>&nbsp;&nbsp;&nbsp;&nbsp;Message:</b>&nbsp;&nbsp;<?php echo $contact->message; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">

                        <?php if (!empty($emailReplies)): ?>
                            <table class="table table-bordered table-sm">
                                <tbody>
                                    <?php foreach ($emailReplies as $reply): ?>
                                        <tr>
                                            <td><?= esc($reply->reply) ?></td>
                                            <td><?= date('d M Y h:i A', strtotime($reply->created_at)) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p class="text-center text-muted">No email replies yet</p>
                        <?php endif; ?>

                        <hr>
                        <h5>New Reply</h5>
                        <form method="post" action="<?= base_url('saveEmailReply') ?>">
                            <?= csrf_field() ?>
                            <input type="hidden" name="contact_id" value="<?= $contact->sno ?>">
                            <textarea name="reply" class="form-control" rows="4" required></textarea>
                            <div class="text-right mt-2">
                                <button class="btn btn-primary btn-sm">Send Email</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php } ?>


<script>
    document.getElementById("searchBox").addEventListener("keyup", function () {
        let value = this.value.toLowerCase();
        let rows = document.querySelectorAll(".search-row");
        let visibleCount = 0;

        rows.forEach(row => {
            if (row.innerText.toLowerCase().includes(value)) {
                row.style.display = "";
                visibleCount++;
            } else {
                row.style.display = "none";
            }
        });

        // Show / hide "No data found"
        document.getElementById("noResultsRow").style.display =
            visibleCount === 0 ? "" : "none";
    });
</script>
