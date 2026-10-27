<?php

use App\Models\backend\BookingsModel;

$bookingModel = new BookingsModel(); ?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="mb-0">Manage Bookings</h3>
                            <a href="<?= base_url('add-bookings') ?>" class="btn btn-primary btn-sm">Add</a>
                        </div>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>SNO</th>
                                            <th>Booking Id</th>
                                            <th>Guest Mobile</th>
                                            <th>Check In</th>
                                            <th>Check Out</th>
                                            <th>STATUS</th>
                                            <th>ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($getAllBookingDetails)) { ?>
                                            <tr>
                                                <td colspan="8" class="text-center">No Bookings Available</td>
                                            </tr>
                                            <?php } else {
                                            $a = 1;
                                            foreach ($getAllBookingDetails as $book) {
                                                // Get all rooms for this booking
                                                $rooms = $bookingModel->getRoomsByBooking($book->booking_id);

                                                // Sum of extra charges for all rooms
                                                $hasExtra = 0;
                                                foreach ($rooms as $r) {
                                                    $hasExtra += $bookingModel->getTotalExtra($book->booking_id, $r['roomtype_sno'], $r['room_no']);
                                                }
                                            ?>
                                                <tr>
                                                    <th><?= $a++; ?></th>
                                                    <td><?= $book->booking_id; ?></td>
                                                    <td><?= $book->mobile; ?></td>
                                                    <td><?= $book->check_in; ?></td>
                                                    <td><?= $book->check_out; ?></td>
                                                    <td>
                                                        <?php if ($book->status == 1) { ?>
                                                            <label class="label label-success">Active</label>
                                                        <?php } else { ?>
                                                            <label class="label label-danger">Inactive</label>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-left">
                                                        <a href="<?= base_url('view-bookings/' . $book->sno) ?>" data-toggle="tooltip" title="View"><i class="ti-eye"></i></a>
                                                        <a href="<?= base_url('edit-bookings/' . $book->sno) ?>" data-toggle="tooltip" title="Edit"><i class="ti-pencil-alt"></i></a>
                                                        <a href="<?= base_url('delete-bookings/' . $book->sno . '/' . $book->status) ?>" data-toggle="tooltip" title="Delete"><i class="ti-trash"></i></a>

                                                        <a href="javascript:void(0)"
                                                            title="<?= $book->invoice ? 'Update Invoice' : 'Generate Invoice' ?>"
                                                            onclick="openInvoiceModal(
                                                                '<?= $book->booking_id ?>',
                                                                '<?= $book->invoice ? $book->invoice->invoice_date : date('Y-m-d') ?>',
                                                                '<?= $book->invoice ? $book->invoice->sub_total : $book->total_amount ?>',
                                                                '<?= $book->invoice ? $book->invoice->tax_amount : 0 ?>',
                                                                '<?= $book->invoice ? $book->invoice->status : 1 ?>'
                                                                )" data-toggle="tooltip">
                                                            <i class="ti-receipt <?= $book->invoice ? 'text-success' : 'text-primary' ?>"></i>
                                                        </a>
                                                        <a href="javascript:void(0)"
                                                            data-toggle="tooltip"
                                                            title="Print Invoice"
                                                            onclick="openInvoiceBillModal('<?= $book->booking_id ?>')">
                                                            <i class="ti-printer text-secondary"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" data-toggle="tooltip" title="Add Payment"
                                                            onclick="openPaymentModal('<?= $book->booking_id ?>')">
                                                            <i class="ti-wallet text-warning"></i>
                                                        </a>

                                                        <a href="javascript:void(0)" data-toggle="tooltip" title="Add Extra Charges"
                                                            onclick="openExtraChargesModal('<?= $book->booking_id ?>')">
                                                            <i class="ti-plus"></i>
                                                        </a>

                                                        <a href="javascript:void(0)" data-toggle="tooltip" title="Checkout"
                                                            onclick="openCheckoutModal('<?= $book->booking_id ?>')">
                                                            <i class="ti-shopping-cart text-danger"></i>
                                                        </a>
                                                        <a href="javascript:void(0)"
                                                            data-toggle="tooltip"
                                                            title="Print Bill"
                                                            onclick="openBillModal('<?= $book->booking_id ?>')">
                                                            <i class="ti-layout-list-thumb text-info"></i>
                                                        </a>

                                                    </td>
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
    <div class="modal fade" id="invoiceModal" tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Invoice Details</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <form method="post" action="<?= base_url('add-invoice') ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Booking ID -->
                                <div class="form-group">
                                    <label>Booking ID</label>
                                    <input type="text" id="inv_booking_id" class="form-control" readonly name="booking_id">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Invoice Date -->
                                <div class="form-group">
                                    <label>Invoice Date</label>
                                    <input type="date" id="inv_date" class="form-control" name="invoice_date">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Sub Total -->
                                <div class="form-group">
                                    <label>Sub Total</label>
                                    <input type="number" id="inv_sub_total" class="form-control" readonly name="sub_total">
                                </div>
                            </div>
                            <!-- Tax -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tax Percentage(GST)</label>
                                    <input type="number" id="inv_tax" class="form-control" value="0" name="tax_amount">
                                </div>
                            </div>
                        </div>
                        <!-- Invoice Status -->
                        <div class="form-group">
                            <label>Invoice Status</label>
                            <select class="form-control" name="invoice_status">
                                <option value="open">Open</option>
                                <option value="closed">Closed</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-success" type="submit" onclick="this.disabled=true; this.innerText='Submitting...'; this.form.submit();">Save Invoice</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Add Payment</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- ================== Add Payment Modal ================== -->
                <div class="modal-body">
                    <form id="paymentForm" method="post" action="<?= base_url('add-payment') ?>" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <!-- Hidden Inputs -->
                        <input type="hidden" id="pay_booking_id_hidden" name="booking_id">
                        <input type="hidden" id="pay_base_amount" name="base_amount">

                        <!-- Room wise hidden inputs -->
                        <input type="hidden" id="pay_roomtype_sno" name="roomtype_sno">
                        <input type="hidden" id="pay_room_no_hidden" name="room_no">

                        <!-- Booking ID + Payment Date -->
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label>Booking ID</label>
                                <input type="text" id="pay_booking_id_text" class="form-control" readonly>
                            </div>
                            <div class="col-md-6">
                                <label>Payment Date</label>
                                <input type="date" class="form-control" name="payment_date" id="pay_date" value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>

                        <!-- Select Room -->
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label>Select Room</label>
                                <select class="form-control" id="pay_room_select" onchange="onPaymentRoomChange()">
                                    <option value="">Select Room</option>
                                </select>
                            </div>
                        </div>

                        <!-- Total + Paid -->
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label>Total Amount</label>
                                <input type="number" class="form-control" name="total_amount" id="pay_total_amount" readonly>
                            </div>
                            <div class="col-md-6">
                                <label>Paid Amount (Room Wise)</label>
                                <input type="number" class="form-control" name="paid_amount" id="pay_paid_amount" readonly>
                            </div>
                        </div>

                        <!-- Pay Now + Balance -->
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label>Payment Amount</label>
                                <input type="number" class="form-control" name="payment_amount" id="pay_amount" oninput="calculateBalance()">
                            </div>
                            <div class="col-md-6">
                                <label>Balance</label>
                                <input type="number" class="form-control" name="balance" id="pay_balance" readonly>
                            </div>
                        </div>

                        <!-- Payment Type & Method -->
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label>Payment Method</label>
                                <select class="form-control" name="payment_method">
                                    <option value="">Select Method</option>
                                    <option value="cash">Cash</option>
                                    <option value="upi">UPI</option>
                                    <option value="check">Check</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Payment Type</label>
                                <select class="form-control" name="payment_type">
                                    <option value="">Select Type</option>
                                    <option value="advance">Advance</option>
                                    <option value="full">Full Payment</option>
                                </select>
                            </div>
                        </div>

                        <!-- Reference -->
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label>Reference File</label>
                                <input type="file" class="form-control" name="reference_file">
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save Payment</button>
                        </div>

                    </form>
                </div>


            </div>
        </div>

    </div>
    <!-- Add Charges Modal -->
    <div class="modal fade" id="extraChargesModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <!-- HEADER -->
                <div class="modal-header">
                    <h5 class="modal-title">Add Extra Charges</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- BODY -->
                <div class="modal-body">
                    <form id="extraChargesForm" method="post"
                        action="<?= base_url('add-charges') ?>">
                        <?= csrf_field() ?>


                        <!-- Booking & Charge Type -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Booking ID</label>
                                <input type="text" id="charge_booking_id" name="booking_id"
                                    class="form-control" readonly>
                            </div>

                            <div class="col-md-6">
                                <label>Charge Type</label>
                                <select class="form-control" id="charge_type"
                                    name="charge_type"
                                    onchange="onChargeTypeChange()" disabled>
                                    <option value="">Select Charge Type</option>
                                    <option value="extra_room">Extra Room</option>
                                    <option value="extra_adult">Extra Adult</option>
                                    <option value="extra_child">Extra Child</option>
                                    <option value="extra_night">Extra Night</option>
                                </select>
                            </div>
                        </div>

                        <!-- Room Type -->
                        <div class="row mb-3" id="roomTypeRow" style="display:none;">
                            <div class="col-md-6">
                                <label>Room Type</label>
                                <select class="form-control" id="charge_room_type"
                                    name="room_id"
                                    onchange="onRoomTypeChange()">
                                    <option value="">Select Room</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Room No (Extra Room)</label>
                                <input type="text" class="form-control"
                                    id="charge_room_no" name="room_no">
                            </div>
                        </div>
                        <!-- Quantity & Price -->
                        <div class="row mb-3" id="quantityRow" style="display:none;">
                            <div class="col-md-6">
                                <label id="quantityLabel">Quantity</label>
                                <input type="number" class="form-control"
                                    id="charge_quantity" name="quantity"
                                    value="1" min="1"
                                    oninput="calculateChargeTotal()">
                            </div>

                            <div class="col-md-6" id="priceDiv" style="display:none;">
                                <label>Price</label>
                                <input type="number" class="form-control"
                                    id="charge_price" name="price"
                                    oninput="calculateChargeTotal()">
                            </div>
                        </div>

                        <!-- Total Price -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Total Price</label>
                                <input type="number" class="form-control"
                                    id="charge_total_price" name="total_price" readonly>
                            </div>
                            <div class="col-md-6">
                                <label>Total Amount</label>
                                <input type="number" class="form-control"
                                    id="charge_total"
                                    name="total_amount" readonly>
                            </div>
                        </div>
                        <!-- FOOTER -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">
                                Save Charges
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout Modal -->
    <div class="modal fade" id="openCheckoutModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title">Checkout Summary</h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <!-- Booking Details Top -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label><b>Booking ID:</b></label>
                            <span id="modal_booking_id"></span>
                        </div>
                    </div>

                    <hr>

                    <!-- Room Table -->
                    <h5>Room Details</h5>
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Select</th>
                                <th>Room Type</th>
                                <th>Room No</th>
                                <th>Total Amount</th>
                                <th>Paid Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="room_list"></tbody>
                    </table>

                    <p class="text-right fw-bold">
                        Final Payable: <b id="final_payable">₹0</b>
                    </p>

                    <div class="modal-footer">
                        <!-- Checkout Button -->
                        <button type="button" class="btn btn-primary" onclick="completeCheckout()">Checkout</button>
                        <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- Bill -->
    <div class="modal fade" id="billModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <!-- HEADER -->
                <div class="modal-header border-bottom p-0 hotel-header">
                    <div class="container-fluid">
                        <button type="button" class="close text-dark" data-dismiss="modal">
                            <span>&times;</span>
                        </button>

                        <div class="row align-items-center text-center text-md-start">
                            <!-- Logo -->
                            <div class="col-12 col-md-2 mb-2 mb-md-0 text-center text-md-start">
                                <img src="<?= base_url('utilities/backend/assets/images/icon.png') ?>"
                                    class="hotel-logo" alt="Logo">
                            </div>

                            <!-- Hotel Name -->
                            <div class="col-12 col-md-7 text-center">
                                <h3 class="fw-bold mb-0 slnn">Sri Lakshmi Narayana Nivas</h3>
                                <h2 class="mt-1 mb-0 home"><b>Home Stay</b></h2>
                                <h6 class="fst-italic mt-1 mb-2">Luxury With Home Feel</h6>
                            </div>

                            <!-- Mobile Numbers -->
                            <div class="col-12 col-md-3 mt-2 mt-md-0 text-center text-md-end">
                                <div class="mobile-box">
                                    <div><b>Mobile:</b> 9876543210</div>
                                    <div style="margin-left: 55px;">9123456789</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid mt-2">
                    <div class="row">
                        <div class="col-6">
                            <div class="mt-1">
                                <b>Check-in:</b> <span id="billcheckInDate"></span>
                            </div>
                            <div class="mt-1">
                                <b>Check-out:</b> <span id="billcheckOutDate"></span>
                            </div>

                            <div class="mt-1">
                                <b>Guest Name:</b> <span id="billguestName"></span>
                            </div>

                            <div class="mt-1">
                                <b>Mobile No:</b> <span id="billmobileNo"></span>
                            </div>

                            <div class="mt-1">
                                <b>Address:</b><br>
                                <span id="billguestAddress" style="line-height:20px;"></span>
                            </div>
                        </div>

                        <div class="col-6">
                            <h5><b>Address:</b></h5>
                            <h6 style="line-height: 20px;">
                                Flat No103, Yathi SR Towers,<br>
                                near Oteru Road, Doctors Colony,<br>
                                Ganesh Nagar, Ambedhkar Colony,<br>
                                Tirupati, Avilali,<br>
                                Andhra Pradesh 517501
                            </h6>
                        </div>
                    </div>
                </div>
                <!-- BODY -->
                <div class="modal-body">
                    <h3 class="text-center fw-bold mb-3"><b>HOTEL BILL</b></h3>

                    <!-- Room Table -->
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>S.No</th>
                                <th>Room Type</th>
                                <th>Room No</th>
                                <th>No of Days</th>
                                <th class="text-end">Amount (₹)</th>
                            </tr>
                        </thead>
                        <tbody id="billRooms"></tbody>
                    </table>

                    <!-- Billing Summary -->
                    <div id="billingSummary" class="mt-3 d-flex justify-content-end"></div>
                </div>

                <!-- FOOTER -->
                <div class="modal-footer border-top py-3 d-flex flex-column align-items-center">
                    <!-- PDF Button (will be hidden during PDF generation) -->
                    <div class="d-block justify-content-end">
                        <button class="btn btn-danger mb-3 no-pdf" onclick="downloadBillPDF()">
                            <i class="fa fa-file-pdf-o"></i> Download PDF
                        </button>
                        <button class="btn btn-primary mb-3 no-print" onclick="printBill()">
                            <i class="fa fa-print"></i> Print
                        </button>
                    </div>
                    <div class="border-footer"></div>
                    <p class="fst-italic text-center mb-2" style="font-size: 0.9rem; color: #1c154a;">
                        <strong>Thank you for staying with us! We hope to see you again soon.</strong>
                    </p>
                    <small class="text-center fs-3 text-dark">
                        <b>Sri Lakshmi Narayana Nivas Home Stay, Luxury With Home Feel</b>
                    </small>
                </div>

            </div>
        </div>
    </div>
    <div id="billPrintWrapper" style="display:none;"></div>

    <script>
        function openBillModal(bookingId) {
            $('#billRooms').html('');
            $('#billingSummary').html('');
            $('#billModal').modal('show');

            fetch("<?= base_url('get-bill-details') ?>/" + bookingId)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('billguestName').innerText = data.name;
                    document.getElementById('billmobileNo').innerText = data.mobile;
                    document.getElementById('billguestAddress').innerText = data.address;
                    document.getElementById('billcheckInDate').innerText = data.checkin; // only date
                    document.getElementById('billcheckOutDate').innerText = data.checkout; // only date

                    let rows = "";
                    let roomTotal = 0;
                    let extraItems = [];
                    let extraTotal = 0;

                    data.rooms.forEach((r, i) => {
                        let amt = Number(r.amount || 0);
                        roomTotal += amt;

                        rows += `
                    <tr>
                        <td>${i + 1}</td>
                        <td>${r.roomtype}</td>
                        <td>${r.room_no}</td>
                        <td>${r.days}</td>
                        <td class="text-end">₹ ${amt.toLocaleString()}</td>
                    </tr>`;

                        if (r.extra_adult > 0) {
                            extraItems.push({
                                label: `${r.roomtype} (${r.room_no}) - Extra Adult *${r.extra_adult_qty}`,
                                amount: Number(r.extra_adult)
                            });
                            extraTotal += Number(r.extra_adult);
                        }
                        if (r.extra_child > 0) {
                            extraItems.push({
                                label: `${r.roomtype} (${r.room_no}) - Extra Child *${r.extra_child_qty}`,
                                amount: Number(r.extra_child)
                            });
                            extraTotal += Number(r.extra_child);
                        }
                        if (r.extra_night > 0) {
                            extraItems.push({
                                label: `${r.roomtype} (${r.room_no}) - Extra Night`,
                                amount: Number(r.extra_night)
                            });
                            extraTotal += Number(r.extra_night);
                        }
                    });

                    $('#billRooms').html(rows);

                    let totalAmount = roomTotal + extraTotal;
                    let paid = Number(data.paid || 0);
                    let balance = totalAmount - paid;

                    let summaryHtml = `
                    <table class="table table-bordered table-sm invoice-summary">
                    <tbody>
                        <tr>
                            <td><b>Total Room Amount</b></td>
                            <td class="money">₹ ${roomTotal.toLocaleString()}</td>
                        </tr>`;

                    if (extraItems.length > 0) {
                        summaryHtml += `<tr><td colspan="2" class="section-title">Extra Charges</td></tr>`;
                        extraItems.forEach(item => {
                            summaryHtml += `<tr>
                        <td style="padding-left:25px;">${item.label}</td>
                        <td class="money">₹ ${item.amount.toLocaleString()}</td>
                    </tr>`;
                        });
                    }

                    summaryHtml += `
                        <tr>
                            <td><b>Paid Amount</b></td>
                            <td class="money">₹ ${paid.toLocaleString()}</td>
                        </tr>
                        <tr>
                            <td><b>Balance</b></td>
                            <td class="money text-danger">₹ ${balance.toLocaleString()}</td>
                        </tr>
                    </tbody>
                </table>`;

                    $('#billingSummary').html(summaryHtml);
                })
                .catch(() => alert("Failed to load bill!"));
        }

        function printBill() {
            const modalContent = document.querySelector('#billModal .modal-content');
            const printWrapper = document.getElementById('billPrintWrapper');

            // Ensure wrapper is empty
            printWrapper.innerHTML = '';

            // Clone the modal content
            const clone = modalContent.cloneNode(true);

            // Remove non-print elements
            clone.querySelectorAll('.no-print, .btn, .close').forEach(e => e.remove());

            // Append clone
            printWrapper.appendChild(clone);
            printWrapper.style.display = 'block';

            // Print
            window.print();

            // Clear wrapper after print
            printWrapper.style.display = 'none';
            printWrapper.innerHTML = '';
        }

        function downloadBillPDF() {
            const element = document.querySelector('#billModal .modal-content');
            const printButton = element.querySelector('.no-print');
            const pdfButton = element.querySelector('.no-pdf');

            // Hide button before PDF
            pdfButton.style.display = 'none';
            printButton.style.display = 'none';


            const opt = {
                margin: 0.3,
                filename: 'Hotel_Bill.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4',
                    orientation: 'portrait'
                }
            };

            html2pdf().set(opt).from(element).save().finally(() => {
                // Show button again
                pdfButton.style.display = 'inline-block';
                printButton.style.display = 'inline-block';
            });
        }
    </script>
    <style>
        @media print {
            body * {
                visibility: hidden !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .pcoded[theme-layout="vertical"] .pcoded-navbar .pcoded-item li.pcoded-hasmenu[dropdown-icon="style1"]>a::after {
                display: none !important;
                content: none !important;
            }

            .border-top {
                border: none;
            }

            .border-footer {
                border-top: 0.9px solid gray;
                width: 2000px;
                margin-bottom: 10px !important;
            }

            #billPrintWrapper,
            #billPrintWrapper * {
                visibility: visible !important;
                padding: 5px;
                font-size: 18px;
            }

            #billPrintWrapper {
                display: block !important;
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                padding: 0 50px !important;
            }

            #billPrintWrapper .modal-content {
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                border: none !important;
                box-shadow: none !important;
                overflow: visible !important;
            }

            #billPrintWrapper .modal-header {
                display: block !important;
                padding: 20px 10px 10px 10px !important;
                page-break-inside: avoid !important;
            }

            #billPrintWrapper .modal-header .row {
                display: grid !important;
                grid-template-columns: 140px 1fr 220px !important;
                align-items: center !important;
                margin: 0 !important;
                padding-top: 10px !important;
            }

            #billPrintWrapper .col-lg-2 {
                grid-column: 1;
                text-align: left !important;
            }

            #billPrintWrapper .col-lg-7 {
                grid-column: 2;
                text-align: center !important;
            }

            #billPrintWrapper .col-lg-3 {
                grid-column: 3;
                text-align: right !important;
                font-size: 13px;
                line-height: 1.4;
            }

            #billPrintWrapper .hotel-logo {
                max-width: 200px !important;
                max-height: 200px !important;
            }

            #billPrintWrapper h2,
            #billPrintWrapper h3,
            #billPrintWrapper h6 {
                margin: 3px 0 !important;
                line-height: 1.25 !important;
            }

            .print-booking-row .row {
                display: grid !important;
                grid-template-columns: 1.3fr 1fr !important;
                gap: 12px !important;
                align-items: start !important;
            }

            .print-booking-row .col-md-6 {
                width: 100% !important;
                max-width: 100% !important;
                flex: unset !important;
            }

            .print-booking-row h5 {
                font-size: 14px !important;
                margin-bottom: 4px !important;
            }

            .print-booking-row div,
            .print-booking-row h6 {
                font-size: 12.5px !important;
                line-height: 1.35 !important;
                margin-top: 2px !important;
            }

            .print-booking-row {
                page-break-inside: avoid !important;
                break-inside: avoid !important;
                padding-bottom: 6px;
                margin-bottom: 6px;
            }

            #billPrintWrapper table {
                width: 100% !important;
                border-collapse: collapse !important;
                font-size: 13px !important;
                page-break-inside: avoid !important;
            }

            #billPrintWrapper table th,
            #billPrintWrapper table td {
                padding: 6px 8px !important;
            }

            #billPrintWrapper .invoice-summary {
                width: 60% !important;
                margin-left: auto !important;
                border-collapse: collapse !important;
                font-size: 13px !important;
                margin-top: 10px !important;
                table-layout: fixed !important;
            }

            #billPrintWrapper .invoice-summary td {
                padding: 4px 6px !important;
            }

            #billPrintWrapper .invoice-summary td:first-child {
                text-align: right !important;
                padding-right: 16px !important;
                white-space: nowrap !important;
            }

            #billPrintWrapper .invoice-summary td.money {
                text-align: right !important;
                white-space: nowrap !important;
                width: 120px !important;
            }

            #billPrintWrapper .row.mt-4 {
                margin-top: 20px !important;
            }

            #billPrintWrapper .space-line {
                display: inline-block;
                width: 120px;
                margin-left: 5px;
            }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <!-- Modal Body -->

    <!-- Invoice Modal -->
    <div class="modal fade" id="invoicePrintModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <!-- HEADER -->
                <div class="modal-header border-bottom p-0 hotel-header">
                    <div class="container-fluid">
                        <button type="button" class="close text-dark" data-dismiss="modal">
                            <span>&times;</span>
                        </button>

                        <div class="row align-items-center text-center text-md-start">
                            <!-- Logo -->
                            <div class="col-12 col-md-2 mb-2 mb-md-0 text-center text-md-start">
                                <img src="<?= base_url('utilities/backend/assets/images/icon.png') ?>"
                                    class="hotel-logo" alt="Logo">
                            </div>

                            <!-- Hotel Name -->
                            <div class="col-12 col-md-7 text-center">
                                <h3 class="fw-bold mb-0 slnn">Sri Lakshmi Narayana Nivas</h3>
                                <h2 class="mt-1 mb-0 home"><b>Home Stay</b></h2>
                                <h6 class="fst-italic mt-1 mb-2">Luxury With Home Feel</h6>
                            </div>

                            <!-- Mobile Numbers -->
                            <div class="col-12 col-md-3 mt-2 mt-md-0 text-center text-md-end">
                                <div class="mobile-box">
                                    <div><b>Mobile:</b> 9876543210</div>
                                    <div style="margin-left: 55px;">9123456789</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid mt-2">
                    <div class="row">
                        <div class="col-6">
                            <h5><b>Booking ID:</b> <span id="bookingId"></span></h5>
                            <div class="mt-1">
                                <b>Check-in:</b> <span id="checkInDate"></span>
                            </div>
                            <div class="mt-1">
                                <b>Check-out:</b> <span id="checkOutDate"></span>
                            </div>

                            <div class="mt-1">
                                <b>Guest Name:</b> <span id="guestName"></span>
                            </div>

                            <div class="mt-1">
                                <b>Mobile No:</b> <span id="mobileNo"></span>
                            </div>

                            <div class="mt-1">
                                <b>Address:</b><br>
                                <span id="guestAddress" style="line-height:20px;"></span>
                            </div>
                        </div>

                        <div class="col-6">
                            <h5><b>Address:</b></h5>
                            <h6 style="line-height: 20px;">
                                Flat No103, Yathi SR Towers,<br>
                                near Oteru Road, Doctors Colony,<br>
                                Ganesh Nagar, Ambedhkar Colony,<br>
                                Tirupati, Avilali,<br>
                                Andhra Pradesh 517501
                            </h6>
                        </div>
                    </div>
                </div>
                <!-- BODY -->
                <div class="modal-body">
                    <h3 class="text-center fw-bold mb-3"><b>Invoice BILL</b></h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>S.No</th>
                                    <th>Room Type</th>
                                    <th>Room No</th>
                                    <th>No of Days</th>
                                    <th class="text-end">Amount (₹)</th>
                                </tr>
                            </thead>
                            <tbody id="invoiceBillRooms"></tbody>
                        </table>
                    </div>

                    <div id="invoiceSummary" class="mt-3 invoice-summary-wrapper"></div>
                </div>
                <!-- Footer -->

                <div class="modal-footer border-top py-3 d-flex flex-column align-items-center">
                    <!-- PDF Button (will be hidden during PDF generation) -->
                    <div class="d-block justify-content-end">
                        <button class="btn btn-danger no-print" onclick="downloadInvoicePDF()">
                            <i class="fa fa-file-pdf-o"></i> Download PDF
                        </button>
                        <button class="btn btn-primary no-print" onclick="printInvoice()" style="margin-right: 5px;">
                            <i class="fa fa-print"></i> Print
                        </button>
                    </div>
                    <div class="border-footer"></div>
                </div>
                <div class="row align-items-center mb-4">
                    <div class="col-md-6">
                        <strong class="date-label">Date:</strong>
                    </div>
                    <div class="col-md-6 text-end">
                        <strong>Signature:</strong>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div id="invoicePrintWrapper" style="display:none;"></div>

    <script>
        function openInvoiceBillModal(bookingId) {
            document.getElementById('invoiceBillRooms').innerHTML = '';
            document.getElementById('invoiceSummary').innerHTML = '';
            document.getElementById('guestAddress').innerHTML = '';
            $('#invoicePrintModal').modal('show');

            fetch("<?= base_url('get-bill-details') ?>/" + bookingId)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('bookingId').innerText = data.booking_id;
                    document.getElementById('guestName').innerText = data.name;
                    document.getElementById('mobileNo').innerText = data.mobile;
                    document.getElementById('guestAddress').innerHTML = data.address.replace(/\n/g, '<br>');
                    document.getElementById('checkInDate').innerText = data.checkin;
                    document.getElementById('checkOutDate').innerText = data.checkout;
                    // document.getElementById('invoiceDate').innerText = data.invoice_date || '';

                    let rows = '',
                        roomTotal = 0,
                        extraItems = [],
                        extraTotal = 0;
                    data.rooms.forEach((r, i) => {
                        let amt = Number(r.amount || 0);
                        roomTotal += amt;
                        rows += `<tr>
                    <td>${i+1}</td>
                    <td>${r.roomtype}</td>
                    <td>${r.room_no}</td>
                    <td>${r.days}</td>
                    <td class="money">₹ ${amt.toLocaleString()}</td>
                </tr>`;

                        if (r.extra_adult > 0) {
                            extraItems.push({
                                label: `${r.roomtype} (${r.room_no}) - Extra Adult *${r.extra_adult_qty}`,
                                amount: Number(r.extra_adult)
                            });
                            extraTotal += Number(r.extra_adult);
                        }
                        if (r.extra_child > 0) {
                            extraItems.push({
                                label: `${r.roomtype} (${r.room_no}) - Extra Child *${r.extra_child_qty}`,
                                amount: Number(r.extra_child)
                            });
                            extraTotal += Number(r.extra_child);
                        }
                        if (r.extra_night > 0) {
                            extraItems.push({
                                label: `${r.roomtype} (${r.room_no}) - Extra Night`,
                                amount: Number(r.extra_night)
                            });
                            extraTotal += Number(r.extra_night);
                        }
                    });
                    document.getElementById('invoiceBillRooms').innerHTML = rows;

                    let subTotal = roomTotal + extraTotal;
                    let gstPercent = Number(data.tax_percentage || 0);
                    let gstAmt = subTotal * gstPercent / 100;
                    let grandTotal = subTotal + gstAmt;
                    let paid = Number(data.paid || 0);
                    let balance = grandTotal - paid;

                    let summaryHtml = `<table class="table table-bordered table-sm invoice-summary"><tbody>
                <tr><td><b>Total Room Amount</b></td><td class="money">₹ ${roomTotal.toLocaleString()}</td></tr>`;
                    if (extraItems.length > 0) {
                        summaryHtml += `<tr><td colspan="2" class="section-title">Extra Charges</td></tr>`;
                        extraItems.forEach(item => {
                            summaryHtml += `<tr><td style="padding-left:25px;">${item.label}</td><td class="money">₹ ${item.amount.toLocaleString()}</td></tr>`;
                        });
                    }
                    summaryHtml += `<tr><td><b>GST (${gstPercent}%)</b></td><td class="money">₹ ${gstAmt.toLocaleString()}</td></tr>
                <tr><td><b>Paid Amount</b></td><td class="money">₹ ${paid.toLocaleString()}</td></tr>
                <tr><td><b>Balance</b></td><td class="money balance text-danger">₹ ${balance.toLocaleString()}</td></tr>
            </tbody></table>`;
                    document.getElementById('invoiceSummary').innerHTML = summaryHtml;
                })
                .catch(() => alert("Failed to load invoice!"));
        }

        // Print invoice
        function printInvoice() {
            const modalContent = document.querySelector('#invoicePrintModal .modal-content');
            const printWrapper = document.getElementById('invoicePrintWrapper');

            // Ensure wrapper is empty
            printWrapper.innerHTML = '';

            // Clone the modal content
            const clone = modalContent.cloneNode(true);

            // Remove non-print elements
            clone.querySelectorAll('.no-print, .btn, .close').forEach(e => e.remove());

            // Append clone
            printWrapper.appendChild(clone);
            printWrapper.style.display = 'block';

            // Print
            window.print();

            // Clear wrapper after print
            printWrapper.style.display = 'none';
            printWrapper.innerHTML = '';
        }


        // PDF download
        function downloadInvoicePDF() {

            // hide buttons & close icon
            document.querySelectorAll('.no-print').forEach(el => {
                el.style.display = 'none';
            });

            const element = document.querySelector('#invoicePrintModal .modal-content');

            const opt = {
                margin: 0.3,
                filename: 'Invoice.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                }
            };

            html2pdf().set(opt).from(element).save().then(() => {

                // show back buttons
                document.querySelectorAll('.no-print').forEach(el => {
                    el.style.display = '';
                });

            });
        }
    </script>
    <style>
        .date-label {
            margin-left: 50px;
        }

        @media print {
            body * {
                visibility: hidden !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .date-label {
                margin-left: 0 !important;
            }

            .pcoded[theme-layout="vertical"] .pcoded-navbar .pcoded-item li.pcoded-hasmenu[dropdown-icon="style1"]>a::after {
                display: none !important;
                content: none !important;
            }

            #invoicePrintWrapper,
            #invoicePrintWrapper * {
                visibility: visible !important;
                padding: 5px;
                font-size: 18px;
            }

            .border-footer {
                border-top: 0.9px solid gray;
                margin-bottom: 10px !important;
            }

            #invoicePrintWrapper {
                display: block !important;
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                padding: 0 50px !important;
            }

            #invoicePrintWrapper .modal-content {
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                border: none !important;
                box-shadow: none !important;
                overflow: visible !important;
            }

            #invoicePrintWrapper .modal-header {
                display: block !important;
                padding: 20px 10px 10px 10px !important;
                page-break-inside: avoid !important;
            }

            #invoicePrintWrapper .modal-header .row {
                display: grid !important;
                grid-template-columns: 140px 1fr 220px !important;
                align-items: center !important;
                margin: 0 !important;
                padding-top: 10px !important;
            }

            #invoicePrintWrapper .col-lg-2 {
                grid-column: 1;
                text-align: left !important;
            }

            #invoicePrintWrapper .col-lg-7 {
                grid-column: 2;
                text-align: center !important;
            }

            #invoicePrintWrapper .col-lg-3 {
                grid-column: 3;
                text-align: right !important;
                font-size: 13px;
                line-height: 1.4;
            }

            #invoicePrintWrapper .hotel-logo {
                max-width: 200px !important;
                max-height: 200px !important;
            }

            #invoicePrintWrapper h2,
            #invoicePrintWrapper h3,
            #invoicePrintWrapper h6 {
                margin: 3px 0 !important;
                line-height: 1.25 !important;
            }

            .print-booking-row .row {
                display: grid !important;
                grid-template-columns: 1.3fr 1fr !important;
                gap: 12px !important;
                align-items: start !important;
            }

            .print-booking-row .col-md-6 {
                width: 100% !important;
                max-width: 100% !important;
                flex: unset !important;
            }

            .print-booking-row h5 {
                font-size: 14px !important;
                margin-bottom: 4px !important;
            }

            .print-booking-row div,
            .print-booking-row h6 {
                font-size: 12.5px !important;
                line-height: 1.35 !important;
                margin-top: 2px !important;
            }

            .print-booking-row {
                page-break-inside: avoid !important;
                break-inside: avoid !important;
                padding-bottom: 6px;
                margin-bottom: 6px;
            }

            #invoicePrintWrapper table {
                width: 100% !important;
                border-collapse: collapse !important;
                font-size: 13px !important;
                page-break-inside: avoid !important;
            }

            #invoicePrintWrapper table th,
            #invoicePrintWrapper table td {
                padding: 6px 8px !important;
            }

            #invoicePrintWrapper .invoice-summary {
                width: 60% !important;
                margin-left: auto !important;
                border-collapse: collapse !important;
                font-size: 13px !important;
                margin-top: 10px !important;
                table-layout: fixed !important;
            }

            #invoicePrintWrapper .invoice-summary td {
                padding: 4px 6px !important;
            }

            #invoicePrintWrapper .invoice-summary td:first-child {
                text-align: right !important;
                padding-right: 16px !important;
                white-space: nowrap !important;
            }

            #invoicePrintWrapper .invoice-summary td.money {
                text-align: right !important;
                white-space: nowrap !important;
                width: 120px !important;
            }

            #invoicePrintWrapper .row.mt-4 {
                margin-top: 20px !important;
            }

            #invoicePrintWrapper .space-line {
                display: inline-block;
                width: 120px;
                margin-left: 5px;
            }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</div>
<style>
    .no-print {
        display: inline-block;
    }

    .space-line {
        display: inline-block;
        width: 200px;
        margin-left: 10px;
    }

    .invoice-summary {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.95rem;
    }

    .invoice-summary td {
        padding: 4px 8px;
    }

    .invoice-summary .money {
        text-align: right;
    }
</style>
<script>
    let bookingRoomsData = [];

    /* OPEN MODAL */
    function openExtraChargesModal(bookingId) {
        $('#extraChargesForm')[0].reset();
        $('#charge_booking_id').val(bookingId);

        $('#roomTypeRow, #quantityRow, #priceDiv').hide();
        $('#roomNoCol').hide();

        $('#charge_type').prop('disabled', true);
        $('#charge_room_type').html('<option value="">Select Room</option>');
        $('#quantityLabel').text('Quantity');

        bookingRoomsData = [];

        $.get("<?= base_url('getBookingRooms') ?>/" + bookingId, function(res) {
            if (res.status === 'success') {
                bookingRoomsData = res.data;
                $('#charge_type').prop('disabled', false);
            }
        }, 'json');

        $('#extraChargesModal').modal('show');
    }

    /* CHARGE TYPE CHANGE */
    function onChargeTypeChange() {
        const type = $('#charge_type').val();

        $('#roomTypeRow, #quantityRow, #priceDiv').hide();
        $('#roomNoCol').hide();

        $('#charge_room_type').html('<option value="">Select Room</option>');
        $('#charge_room_no').val('').prop('readonly', false);
        $('#charge_quantity').val(1);
        $('#charge_price, #charge_total, #charge_total_price').val('');
        $('#quantityLabel').text('Quantity');

        if (!type) return;

        $('#roomTypeRow, #quantityRow, #priceDiv').show();

        /* EXTRA ROOM */
        if (type === 'extra_room') {

            $.get("<?= base_url('getAllRooms') ?>", function(rooms) {
                rooms.forEach(room => {
                    $('#charge_room_type').append(`
                        <option value="${room.sno}"
                                data-price="${room.price_per_night}">
                            ${room.roomtype}
                        </option>
                    `);
                });

                autoSelectRoom();
                $('#roomNoCol').show();
                $('#charge_room_no').val('').prop('readonly', false);
            }, 'json');

        } else {

            if (bookingRoomsData.length === 0) return;

            bookingRoomsData.forEach(room => {
                let price = 0;

                if (type === 'extra_adult')
                    price = parseFloat(room.extra_adult_price ?? 0);

                if (type === 'extra_child')
                    price = parseFloat(room.extra_children_price ?? 0);

                if (type === 'extra_night') {
                    price = parseFloat(room.price_per_night ?? 0);
                    $('#quantityLabel').text('Extra Nights');
                }

                $('#charge_room_type').append(`
                    <option value="${room.roomtype_sno}"
                            data-price="${price}"
                            data-roomno="${room.room_no}">
                        ${room.roomtype} (Room ${room.room_no})
                    </option>
                `);
            });

            autoSelectRoom();
        }
    }

    /* AUTO SELECT FIRST ROOM */
    function autoSelectRoom() {
        const firstVal = $('#charge_room_type option:eq(1)').val();
        if (firstVal) {
            $('#charge_room_type').val(firstVal);
            onRoomTypeChange();
        }
    }

    /* ROOM CHANGE */
    function onRoomTypeChange() {
        const selected = $('#charge_room_type option:selected');
        if (!selected.val()) return;

        const price = parseFloat(selected.data('price') || 0);
        const roomNo = selected.data('roomno');

        $('#charge_price').val(price);

        if (roomNo !== undefined) {
            // Adult / Child / Night → auto fill & lock
            $('#charge_room_no').val(roomNo).prop('readonly', false);
        } else {
            // Extra Room → manual entry
            $('#charge_room_no').val('').prop('readonly', false);
        }

        $('#roomNoCol').show();
        calculateChargeTotal();
    }

    /* TOTAL CALCULATION */
    function calculateChargeTotal() {
        const qty = parseFloat($('#charge_quantity').val() || 1);
        const price = parseFloat($('#charge_price').val() || 0);
        const total = qty * price;

        $('#charge_total_price').val(total);
        $('#charge_total').val(total);
    }

    $('#charge_quantity, #charge_price').on('input', calculateChargeTotal);
</script>
<script>
    let selectedRoomPrice = 0; // Base room price
    let selectedExtraCharges = 0; // Extra charges (display only)

    // Open Payment Modal
    function openPaymentModal(bookingId) {
        $('#paymentForm')[0].reset();
        selectedRoomPrice = 0;
        selectedExtraCharges = 0;

        $('#pay_booking_id_hidden').val(bookingId);
        $('#pay_booking_id_text').val(bookingId);
        $('#pay_room_select').html('<option value="">Select Room</option>');
        $('#pay_total_amount, #pay_paid_amount, #pay_balance, #pay_amount').val('');

        // Fetch Rooms for this booking including extra charges
        $.get("<?= base_url('getBookingRooms') ?>/" + bookingId, function(res) {
            console.log(res);
            if (res.status === 'success') {
                res.data.forEach(room => {
                    const extra = parseFloat(room.extraCharges) || 0; // Ensure numeric
                    $('#pay_room_select').append(`
                    <option value="${room.br_id}" 
                        data-roomtype="${room.roomtype_sno}" 
                        data-roomno="${room.room_no}" 
                        data-price="${room.price_per_night}" 
                        data-extracharges="${extra}">
                        ${room.roomtype} (Room No: ${room.room_no})
                    </option>
                `);
                });
            }
        }, 'json');

        $('#paymentModal').modal('show');
    }

    // When Room Selected
    function onPaymentRoomChange() {
        const sel = $('#pay_room_select option:selected');
        if (!sel.val()) return;

        selectedRoomPrice = parseFloat(sel.data("price")) || 0;
        selectedExtraCharges = parseFloat(sel.data("extracharges")) || 0;

        // Display total including extra charges
        const displayTotal = selectedRoomPrice + selectedExtraCharges;
        $('#pay_total_amount').val(displayTotal);

        $('#pay_roomtype_sno').val(sel.data("roomtype"));
        $('#pay_room_no_hidden').val(sel.data("roomno"));

        // Fetch previous paid amount
        $.get(`<?= base_url('getRoomPayments') ?>/${sel.data("roomtype")}/${sel.data("roomno")}`, function(res) {
            const paid = parseFloat(res.paid) || 0;
            $('#pay_paid_amount').val(paid);
            $('#pay_balance').val(displayTotal - paid);
        }, 'json');
    }

    // Live Balance Update (display only)
    function calculateBalance() {
        const now = parseFloat($('#pay_amount').val()) || 0;
        const paid = parseFloat($('#pay_paid_amount').val()) || 0;
        const displayTotal = selectedRoomPrice + selectedExtraCharges;
        $('#pay_balance').val(displayTotal - (paid + now));
    }

    // Event listeners
    $('#pay_room_select').on('change', onPaymentRoomChange);
    $('#pay_amount').on('input', calculateBalance);

    // Submit Payment (DB receives only base price if you want, extra charges optional)
    $('#paymentForm').on('submit', function(e) {
        e.preventDefault();

        const data = {
            booking_id: $('#pay_booking_id_hidden').val(),
            roomtype_sno: $('#pay_roomtype_sno').val(),
            room_no: $('#pay_room_no_hidden').val(),
            amount: selectedRoomPrice, // base price
            extra_charges: selectedExtraCharges, // optional for backend
            payment_amount: parseFloat($('#pay_amount').val()) || 0,
            payment_date: $('#pay_date').val(),
            payment_method: $('select[name="payment_method"]').val(),
            payment_type: $('select[name="payment_type"]').val()
        };

        $.post('<?= base_url("savePayment") ?>', data, function(res) {
            if (res.status === 'success') {
                alert('Payment saved successfully!');
                $('#paymentModal').modal('hide');
                location.reload();
            } else {
                alert('Error saving payment: ' + (res.message || 'Unknown'));
            }
        }, 'json');
    });
</script>

<script>
    let roomData = [];

    function openCheckoutModal(bookingId) {
        $('#modal_booking_id').text(bookingId);
        $('#room_list').html('<tr><td colspan="6" class="text-center">Loading...</td></tr>');

        fetch("<?= base_url('checkout-summary') ?>/" + bookingId)
            .then(res => res.json())
            .then(data => {
                roomData = data.rooms || [];
                console.log("Fetched rooms:", roomData);

                let html = '';
                let totalPaid = 0;

                if (!roomData.length) {
                    html = `<tr><td colspan="6" class="text-center text-danger">No room details found</td></tr>`;
                } else {
                    roomData.forEach(room => {

                        const roomType = room.roomtype_sno || room.roomtype || '';
                        if (!roomType) return;

                        const totalAmount = parseFloat(room.total_amount) || 0;
                        const paidAmount = parseFloat(room.paid_amount) || 0;
                        const fullyPaid = (totalAmount - paidAmount) <= 0;

                        // 🔥 Check if room is already checked-out
                        const checkedOut = room.status == 0;

                        let checkboxColumn = '';

                        if (checkedOut) {
                            checkboxColumn = `<span class="text-success fw-bold fs-5">✔</span>`; // Tick instead of checkbox
                        } else {
                            checkboxColumn = `
                            <input type="checkbox" class="checkout-room"
                                data-roomno="${room.room_no}"
                                data-roomtype="${roomType}">
                        `;
                        }

                        // Status UI
                        const statusHtml = checkedOut ?
                            `<span class="badge badge-success">Checked Out</span>` :
                            fullyPaid ?
                            `<span class="badge badge-success">Fully Paid</span>` :
                            `<span class="badge badge-warning">Pending</span>`;

                        html += `
                        <tr>
                            <td class="text-center">${checkboxColumn}</td>
                            <td>${room.roomtype_name}</td>
                            <td>${room.room_no}</td>
                            <td>₹${totalAmount}</td>
                            <td>₹${paidAmount}</td>
                            <td>${statusHtml}</td>
                        </tr>
                    `;

                        totalPaid += paidAmount;
                    });
                }

                $('#room_list').html(html);
                $('#final_payable').text('₹' + totalPaid);
                $('#openCheckoutModal').modal('show');
            });
    }


    // ================================
    // 2. Update total when checkbox selected
    // ================================
    $(document).on('change', '.checkout-room', function() {
        let totalPaid = 0;

        $('.checkout-room:checked').each(function() {
            const roomNo = $(this).data('roomno');
            const room = roomData.find(r => r.room_no == roomNo);
            if (room) totalPaid += parseFloat(room.paid_amount) || 0;
        });

        $('#final_payable').text('₹' + totalPaid);
    });


    // ================================
    // 3. Complete Checkout
    // ================================
    function completeCheckout() {
        const bookingId = $('#modal_booking_id').text().trim();
        let selectedRooms = [];

        $('.checkout-room:checked').each(function() {
            selectedRooms.push({
                room_no: $(this).data('roomno'),
                roomtype_sno: $(this).data('roomtype')
            });
        });

        if (!bookingId || !selectedRooms.length) return;

        console.log("Sending:", bookingId, selectedRooms);

        fetch("<?= base_url('update-room-checkout') ?>", {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                },
                body: JSON.stringify({
                    booking_id: bookingId,
                    rooms: selectedRooms
                })
            })
            .then(res => res.text())
            .then(text => {
                console.log("Response:", text);

                let resp = {};
                try {
                    resp = JSON.parse(text);
                } catch (e) {
                    console.error("❌ Invalid JSON:", e);
                    return;
                }

                if (resp.status === 'success') {
                    $('#openCheckoutModal').modal('hide');
                    location.reload();
                }
            })
            .catch(err => console.error("Fetch Error:", err));
    }
</script>

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
</style>
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<script>
    function openInvoiceModal(bookingId, date, subTotal, tax, status) {

        $('#inv_booking_id').val(bookingId);
        $('#inv_date').val(date);
        $('#inv_sub_total').val(subTotal);
        $('#inv_tax').val(tax);

        if (status == 1) {
            $('select[name="invoice_status"]').val('open');
        } else {
            $('select[name="invoice_status"]').val('closed');
        }

        $('#invoiceModal').modal('show');
    }
</script>
<style>
    .hotel-header {
        border-bottom: 4px solid black;
    }

    /* Logo */
    .hotel-logo {
        height: 110px;
        max-width: 100%;
        object-fit: contain;
    }

    /* Text styles */
    .slnn {
        letter-spacing: 1px;
    }

    .home {
        color: black;
        font-family: 'Gill Sans', Calibri, 'Trebuchet MS', sans-serif;
    }

    /* Mobile numbers */
    .mobile-box {
        font-size: 15px;
        line-height: 1.5;
        color: #000;
        font-weight: 500;
    }

    /* -------- RESPONSIVE -------- */
    @media (max-width: 992px) {
        .hotel-logo {
            height: 85px;
        }
    }

    @media (max-width: 768px) {
        .hotel-logo {
            height: 65px;
            margin-bottom: 6px;
        }

        .slnn {
            font-size: 1.25rem;
        }

        .home {
            font-size: 1.05rem;
        }

        .mobile-box {
            font-size: 14px;
        }
    }

    /* Extra small screens */
    @media (max-width: 480px) {
        .hotel-logo {
            height: 55px;
        }

        .slnn {
            font-size: 1.1rem;
        }

        .home {
            font-size: 0.95rem;
        }

        .mobile-box {
            font-size: 13px;
        }
    }

    /* Print support (invoice) */
    @media print {
        .hotel-logo {
            height: 90px;
        }

        .mobile-box {
            font-size: 14px;
        }
    }

    .invoice-summary-wrapper {
        display: flex;
        justify-content: flex-end;
    }

    .invoice-summary {
        width: 45%;
        min-width: 280px;
    }

    .invoice-summary td {
        padding: 6px 10px;
        font-size: 15px;
    }

    .section-title {
        font-weight: bold;
        background: #f8f9fa;
    }

    /* Tablets */
    @media (max-width: 992px) {
        .invoice-summary {
            width: 65%;
        }
    }

    /* Mobile */
    @media (max-width: 576px) {
        .invoice-summary-wrapper {
            justify-content: center;
        }

        .invoice-summary {
            width: 100%;
            font-size: 14px;
        }
    }
</style>
<style>
    .space-line {
        display: inline-block;
        width: 150px;
        vertical-align: middle;
    }

    .d-flex {
        display: flex;
    }

    .flex-column {
        flex-direction: column;
    }

    .align-items-end {
        align-items: flex-end;
        /* aligns content to right */
    }

    .mb-2 {
        margin-bottom: 0.5rem;
    }

    /* Money alignment */
    .money {
        font-family: monospace;
        font-variant-numeric: tabular-nums;
        text-align: right;
        white-space: nowrap;
        font-size: 16px;
        /* BIGGER AMOUNT TEXT */
        font-weight: 600;
    }

    /* Summary table text size */
    .invoice-summary td {
        font-size: 15px;
        padding: 6px 10px;
    }

    .invoice-summary,
    .invoice-summary td,
    .invoice-summary tr {
        border: none !important;
    }

    /* Extra charges heading style */
    .invoice-summary .section-title {
        font-weight: 700;
        padding-top: 8px;
    }

    /* Balance highlight */
    .invoice-summary .balance {
        font-size: 17px;
        font-weight: 700;
    }
</style>