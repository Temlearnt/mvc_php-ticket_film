<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <?php
            $movie = $data['movies'];
            ?>
            <div class="page-title">
                <h4>Film Management</h4>
                <h6>Update Movies List</h6>
            </div>
        </div>
        <form class="card" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" value="<?=$movie['title']?>" maxlength="50" required />
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Genre</label>
                            <input type="text" name="genre" value="<?=$movie['genre']?>" maxlength="50" required />
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Release</label>
                            <input type="date" name="release" value="<?=date('Y-m-d', strtotime($movie['release_date']))?>" maxlength="50" required />
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="description" value="<?=$movie['description']?>" maxlength="100" required />
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Duration(In Minutes)</label>
                            <input type="number" maxlength="12" name="duration" value="<?=$movie['duration_minutes']?>" required />
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Rating</label>
                            <input type="number" maxlength="12" name="rating" required/>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Poster/label>
                            <div class="image-upload">
                                <input type="file" name="file" />
                                <div class="image-uploads">
                                    <img src="<?= BASEURL ?>/vendors/img/icons/upload.svg" alt="img" />
                                    <h4>Drag and drop a file to upload</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="product-list">
                            <ul class="row">
                                <li class="ps-0">
                                    <div class="productviews">
                                        <div class="productviewsimg">
                                            <img src="<?= BASEURL ?>public/<?= $movie['poster'] ?>" alt="img" />
                                        </div>
                                        <div class="productviewscontent">
                                            <div class="productviewsname">
                                            </div>
                                            <a href="javascript:void(0);" class="hideset">x</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
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