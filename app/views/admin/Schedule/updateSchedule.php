<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Film Management</h4>
                <h6>Update Schedule List</h6>
            </div>
        </div>
        <form class="card" method="POST" enctype="multipart/form-data">
            <?php
            $schedule = $data['schedule'];
            ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Movie</label>
                            <select name="movie" id="">
                            <option value="<?=$schedule[0]['movie_id']?>"><?=$schedule[0]['title']?></option>
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
                            <label>Theater</label>
                            <select name="theater" id="">
                            <option value="<?=$schedule[0]['theater_id']?>"><?=$schedule[0]['name']?></option>
                                <?php
                                foreach($data['theaters'] as $theater):
                                ?>
                                <option value="<?=$theater['theater_id']?>"><?=$theater['name']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Showtime</label>
                            <input type="datetime-local" value="<?=$schedule[0]['show_time']?>" name="show" maxlength="50" required />
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" maxlength="12" value="<?=$schedule[0]['price']?>" name="price" required />
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