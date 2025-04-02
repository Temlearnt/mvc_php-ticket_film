<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
              <h4>Film Management</h4>
              <h6>Add Promotion List</h6>
            </div>
        </div>
        <form class="card" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                <div class="row">
                <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Movie</label>
                            <select name="movie" id="">
                                <?php
                                foreach($data['movies'] as $movie):
                                ?>
                                <option value="<?=$movie['movie_id']?>"><?=$movie['title']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Discount Percentage</label>
                            <input type="number" maxlength="12" name="discount" required/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" name="start" maxlength="50" required/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" name="end" maxlength="50" required/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Note</label>
                            <input type="text" maxlength="100" name="note" required/>
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
