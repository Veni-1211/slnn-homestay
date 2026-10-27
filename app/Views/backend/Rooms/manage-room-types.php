<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="mb-0">Manage Room Types</h3>
                            <a href="<?= base_url('add-room-types') ?>" class="btn btn-primary btn-sm">Add</a>
                        </div>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>SNO</th>
                                            <th>ROOM TYPE</th>
                                            <th>PRICE PER NIGHT</th>
                                            <th>STATUS</th>
                                            <th>ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($getAllRoomTypeDetails)) { ?>
                                            <tr>
                                                <td colspan="5"> No Room Types Available</td>
                                            </tr>
                                        <?php } else { ?>
                                            <?php $a = 1;
                                            foreach ($getAllRoomTypeDetails as $room) { ?>
                                                <tr>
                                                    <th><?php echo $a++; ?></th>
                                                    <td><?php echo $room->roomtype; ?></td>
                                                    <td><?php echo $room->price_per_night; ?></td>
                                                    <td>
                                                        <?php if ($room->status == 1) { ?>
                                                            <label class="label label-success">Active</label>
                                                        <?php } else { ?>
                                                            <label class="label label-danger">Inactive</label>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-left">
                                                        <a href="<?php echo base_url(); ?>view-room-types/<?php echo $room->sno; ?>" class="action-icon view" data-toggle="tooltip" title="View">
                                                            <i class="ti-eye"></i>
                                                        </a>
                                                        <a href="<?php echo base_url(); ?>edit-room-types/<?php echo $room->sno; ?>" class="action-icon edit" data-toggle="tooltip" title="Edit">
                                                            <i class="ti-pencil-alt"></i>
                                                        </a>
                                                        <a href="<?php echo base_url(); ?>delete-room-types/<?php echo $room->sno; ?>/<?php echo $room->status; ?>" class="action-icon delete" data-toggle="tooltip" title="Delete">
                                                            <i class="ti-trash"></i>
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
</style>
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>