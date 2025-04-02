<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Sales Management</h4>
                <h6>Update Payment List</h6>
                <?php
                $payment = $data['payments'];
                $user = $data['users'];
                ?>
            </div>
        </div>
        <form class="card" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Payment ID</label>
                            <input type="text" name="title" disabled value="PYMT-CNM-<?= $payment[0]['payment_id'] ?>" maxlength="50" required />
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" disabled value="<?= $payment[0]['title'] ?>" maxlength="50" required />
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Name Customer</label>
                            <input type="text" name="genre" disabled value="<?= $user['name'] ?>" maxlength="50" required />
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Booking Time</label>
                            <input type="datetime-local" disabled name="release" value="<?= $payment[0]['booking_time'] ?>" maxlength="50" required />
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" name="description" disabled value="<?= $payment[0]['location'] ?> - <?= $payment[0]['name'] ?>" maxlength="100" required />
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Number Seat</label>
                            <input type="text" maxlength="12" disabled name="duration" value="<?= $payment[0]['seat_number'] ?>" required />
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="number" disabled value="<?= $payment[0]['amount'] ?>" maxlength="12" name="rating" required />
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Method</label>
                            <input type="text" disabled value="<?= $payment[0]['payment_method'] ?>" maxlength="12" name="rating" required />
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="">
                                <option value="<?= $payment[0]['payment_status'] ?>"><?= $payment[0]['payment_status'] ?></option>
                                <option value="completed">completed</option>
                                <option value="pending">pending</option>
                                <option value="cancelled">cancelled</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <input type="submit" value="Submit" class="btn btn-submit me-2">
                        <a href="movielist.html" class="btn btn-cancel">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>