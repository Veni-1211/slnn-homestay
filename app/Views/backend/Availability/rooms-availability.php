<?php
$today = date('Y-m-d');

$groupedRooms = [];

if (!empty($rooms)) {

    $groupedRooms = [];

    foreach ($rooms as $row) {

        if (!empty($row['occupied_room'])) {
            $class = 'badge-occupied';
            $title = 'Currently Occupied';
        } else {
            $class = 'badge-available';
            $title = 'Available';
        }

        $groupedRooms[$row['roomtype']][] = [
            'room_number' => $row['room_number'],
            'class' => $class,
            'title' => $title
        ];
    }

}
?>

<style>
    /* CARD */
    .availability-card {
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
    }

    /* HEADER */
    .availability-header {
        background: linear-gradient(135deg, #4e73df, #224abe);
        color: #fff;
        padding: 15px 20px;
    }

    /* ROOM BADGE BASE */
    .room-badge {
        padding: 7px 12px;
        font-size: 13px;
        border-radius: 20px;
        margin: 3px;
        display: inline-block;
        color: #fff;
        box-shadow: 0 3px 6px rgba(0, 0, 0, .15);
    }

    /* 🟢 AVAILABLE */
    .badge-available {
        background: #1cc88a;
    }

    /* 🔳 OCCUPIED */
    .badge-occupied {
        background-color: red;
    }
</style>

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">

                    <div class="card availability-card">

                        <!-- HEADER -->
                        <div class="availability-header d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Room Availability</h4>

                            <form method="get" class="form-inline">
                                
                                <div class="">
                                    <span class="room-badge badge-available">Free</span>
                                    <span class="room-badge badge-occupied">Booked</span>
                                </div>
                                <label class="mr-2">Filter By Date: </label>
                                <input type="date"
                                    name="date"
                                    class="form-control form-control-sm"
                                    value="<?= esc($date) ?>"
                                    min="<?= date('Y-m-d'); ?>"
                                    onchange="this.form.submit()">

                                
                            </form>
                        </div>

                        <!-- TABLE -->
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th width="25%">Room Type</th>
                                            <th>Room Numbers</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php if (!empty($groupedRooms)): ?>
                                            <?php foreach ($groupedRooms as $roomType => $roomList): ?>
                                                <tr>
                                                    <td><strong><?= esc($roomType) ?></strong></td>
                                                    <td>
                                                        <?php foreach ($roomList as $room): ?>
                                                            <span class="room-badge <?= $room['class'] ?>"
                                                                title="<?= esc($room['title']) ?>">
                                                                <?= esc($room['room_number']) ?>
                                                            </span>
                                                        <?php endforeach; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="2" class="text-center text-muted py-4">
                                                    No rooms found
                                                </td>
                                            </tr>
                                        <?php endif; ?>
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