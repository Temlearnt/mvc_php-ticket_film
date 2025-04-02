<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
              <h4>Film Management</h4>
              <h6>Update Promotion List</h6>
            </div>
        </div>
        <?php
        $promotion = $data['promotion'];
        ?>
        <form class="card" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                <div class="row">
                <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Promotion ID</label>
                            <input type="text" maxlength="12" name="promotion" value="PRM-CNM-<?=$promotion[0]['id']?>" disabled/>
                        </div>
                    </div>
                <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Movie</label>
                            <select name="movie" id="">
                                <option value="<?=$promotion[0]['movie_id']?>"><?=$promotion[0]['title']?></option>
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
                            <input type="number" maxlength="12" value="<?=$promotion[0]['discount_percentage']?>" name="discount" required/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" name="start" value="<?=$promotion[0]['start_date']?>" maxlength="50" required/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" name="end" value="<?=$promotion[0]['end_date']?>" maxlength="50" required/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Note</label>
                            <input type="text" maxlength="100" value="<?=$promotion[0]['note']?>" name="note" required/>
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
