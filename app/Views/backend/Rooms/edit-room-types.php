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
                                    <h3 class="mb-0">Edit Room Types</h3>
                                    <a href="<?= base_url('manage-room-types') ?>" class="btn btn-primary btn-sm">Manage</a>
                                </div>

                                <div class="card-block">
                                    <form method="POST">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Room Types</b></label>
                                                <select class="form-control" name="roomtype">
                                                    <option value="">Select One </option>
                                                    <option value="deluxe" <?php if ($getRoomTypeDetailsById['roomtype'] == 'deluxe') {
                                                                                echo 'selected';
                                                                            } ?>>Deluxe</option>
                                                    <option value="super deluxe" <?php if ($getRoomTypeDetailsById['roomtype'] == 'super deluxe') {
                                                                                        echo 'selected';
                                                                                    } ?>>Super Deluxe</option>
                                                    <option value="super luxury" <?php if ($getRoomTypeDetailsById['roomtype'] == 'super luxury') {
                                                                                        echo 'selected';
                                                                                    } ?>>Super Luxury</option>
                                                    <option value="grand suite" <?php if ($getRoomTypeDetailsById['roomtype'] == 'grand suite') {
                                                                                    echo 'selected';
                                                                                } ?>>Grand Suite</option>
                                                </select>
                                                <span style="color: red;">
                                                    <?php
                                                    if (isset($validation)) {
                                                        if ($validation->hasError('roomtype')) {
                                                            echo $validation->getError('roomtype');
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Price Per Night</b></label>
                                                <input type="text" class="form-control"
                                                    placeholder="Ex: 1200 / 2000 / 2500" name="price_per_night" value="<?php echo $getRoomTypeDetailsById['price_per_night']; ?>">
                                                <span style="color: red;">
                                                    <?php
                                                    if (isset($validation)) {
                                                        if ($validation->hasError('price_per_night')) {
                                                            echo $validation->getError('price_per_night');
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Max Adults</b></label>
                                                <input type="text" class="form-control"
                                                    placeholder="Ex: 5 or 6" name="max_adults" value="<?php echo $getRoomTypeDetailsById['max_adults']; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Max Children</b></label>
                                                <input type="text" class="form-control"
                                                    placeholder="Ex: 3 or 4" name="max_children" value="<?php echo $getRoomTypeDetailsById['max_children']; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Weekend Price</b></label>
                                                <input type="text" class="form-control"
                                                    placeholder="Ex: 3000/3500" name="weekend_price" value="<?php echo $getRoomTypeDetailsById['weekend_price']; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Seasonal Price</b></label>
                                                <input type="text" class="form-control"
                                                    placeholder="Ex: 4000/ 6000" name="seasonal_price" value="<?php echo $getRoomTypeDetailsById['seasonal_price']; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Extra Adult Price</b></label>
                                                <input type="text" class="form-control"
                                                    placeholder="Ex: 800 / 1000" name="extra_adult_price" value="<?php echo $getRoomTypeDetailsById['extra_adult_price']; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Extra Children Price</b></label>
                                                <input type="text" class="form-control"
                                                    placeholder="Ex: 500 / 700" name="extra_children_price" value="<?php echo $getRoomTypeDetailsById['extra_children_price']; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Cleaning Fee</b></label>
                                                <input type="text" class="form-control"
                                                    placeholder="Ex: 150" name="cleaning_fee" value="<?php echo $getRoomTypeDetailsById['cleaning_fee']; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label"><b>Service Charges</b></label>
                                                <input type="text" class="form-control"
                                                    placeholder="Ex: 300" name="service_charges" value="<?php echo $getRoomTypeDetailsById['service_charges']; ?>">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="col-form-label"><b>Description</b></label>
                                                <textarea rows="5" cols="5" class="form-control" name="description"
                                                    placeholder="Ex: Deluxe Room..">
                                                    <?php echo $getRoomTypeDetailsById['description']; ?>
                                                </textarea>
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