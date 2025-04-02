<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Film Management</h4>
                <h6>Update Theater List</h6>
                <?php
                $theater = $data['theater'];
                ?>
            </div>
        </div>
        <form class="card" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                <div class="row">
                <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" value="<?=$theater[0]['name']?>" name="name" required />
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" value="<?=$theater[0]['location']?>" name="location" maxlength="50" required />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <input type="submit" value="Submit" class="btn btn-submit me-2">
                        <a href="categorylist.html" class="btn btn-cancel">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>