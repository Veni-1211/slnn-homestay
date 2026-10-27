<?php $model = new App\Models\backend\DashboardModel(); ?>
<?php
function formatIndianCurrency($number)
{
    $number = (string) $number;
    $decimal = '';

    if (strpos($number, '.') !== false) {
        [$number, $decimal] = explode('.', $number);
        $decimal = '.' . substr($decimal, 0, 2);
    }

    $lastThree = substr($number, -3);
    $restUnits = substr($number, 0, -3);
    if ($restUnits != '') {
        $restUnits = preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $restUnits) . ",";
    }
    return '₹ ' . $restUnits . $lastThree . $decimal;
}
?>

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">

                        <!-- ================= FIRST ROW (UNCHANGED) ================= -->

                        <div class="col-md-6 col-xl-3">
                            <div class="card widget-card-1">
                                <div class="card-block-small">
                                    <i class="icofont icofont-building bg-c-blue card1-icon"></i>
                                    <span class="text-c-blue f-w-600">Total Rooms</span>
                                    <h4><?= $model->getTotalRoomCount() ?></h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card widget-card-1">
                                <div class="card-block-small">
                                    <i class="icofont icofont-calendar bg-c-pink card1-icon"></i>
                                    <span class="text-c-pink f-w-600 ms-2">Total Bookings</span>
                                    <h4><?= $model->getTotalBookingCount() ?></h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card widget-card-1">
                                <div class="card-block-small">
                                    <i class="icofont icofont-money bg-c-yellow card1-icon"></i>
                                    <span class="text-c-yellow f-w-600">Total Revenue</span>
                                    <h4><?= formatIndianCurrency($model->getTotalRevenueFromPayments()) ?></h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card widget-card-1">
                                <div class="card-block-small">
                                    <i class="icofont icofont-money-bag bg-c-green card1-icon"></i>
                                    <span class="text-c-green f-w-600">Total Paid</span>
                                    <h4><?= formatIndianCurrency($model->getTotalPaidFromPayments()) ?></h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card widget-card-1">
                                <div class="card-block-large p-3">
                                    <i class="icofont icofont-users bg-c-green card1-icon"></i>
                                    <span class="text-c-green f-w-600">Total Occupied</span>
                                    <h4><?= $model->getTotalOccupiedRooms() ?></h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card widget-card-1">
                                <div class="card-block-large p-3">
                                    <i class="icofont icofont-check-alt bg-c-yellow card1-icon"></i>
                                    <span class="text-c-yellow f-w-600">Total Available</span>
                                    <h4><?php $occupied = $model->getTotalOccupiedRooms();
                                        $total = $model->getTotalRoomCount();
                                        echo $total - $occupied;
                                        ?></h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card widget-card-1">
                                <div class="card-block-large p-3">
                                    <i class="icofont icofont-comment bg-c-pink card1-icon"></i>
                                    <span class="text-c-pink f-w-600">Total Feedbacks</span>
                                    <h4><?= $model->getTotalFeedbacks();
                                        ?></h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card widget-card-1">
                                <div class="card-block-large p-3">
                                    <i class="icofont icofont-exit bg-c-blue card1-icon"></i>
                                    <span class="text-c-blue f-w-600">Today CheckOut</span>
                                    <h4><?= $model->getExpectedTodayCheckoutsCount();
                                        ?></h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card widget-card-1">
                                <div class="card-block-small">
                                    <i class="icofont icofont-ui-calendar bg-c-blue card1-icon"></i>
                                    <span class="text-c-blue f-w-600">Booking Enq.</span>
                                    <h4><?= $model->getTotalBookingEnquiries();
                                        ?></h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card widget-card-1">
                                <div class="card-block-large p-3">
                                    <i class="icofont icofont-alarm bg-c-pink card1-icon"></i>
                                    <span class="text-c-pink f-w-600">Pending Booking</span>
                                    <h4><?= $model->getPendingBookingEnquiries();
                                        ?></h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card widget-card-1">
                                <div class="card-block-large p-3">
                                    <i class="icofont icofont-envelope bg-c-yellow card1-icon"></i>
                                    <span class="text-c-yellow f-w-600">Contact Enquery</span>
                                    <h4><?= $model->getTotalContactEnquiries();
                                        ?></h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card widget-card-1">
                                <div class="card-block-large p-3">
                                    <i class="icofont icofont-email bg-c-green card1-icon"></i>
                                    <span class="text-c-green f-w-600">Pending Contact</span>
                                    <h4><?= $model->getPendingContactEnquiries();
                                        ?></h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>