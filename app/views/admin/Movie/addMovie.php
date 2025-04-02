<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
              <h4>Film Management</h4>
              <h6>Add Movies List</h6>
            </div>
        </div>
        <form class="card" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" maxlength="50" required/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Genre</label>
                            <input type="text" name="genre" maxlength="50" required/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Release</label>
                            <input type="date" name="release" maxlength="50" required/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="description" maxlength="100" required/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Duration(In Minutes)</label>
                            <input type="number" maxlength="12" name="duration" required/>
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
                            <label>Poster</label>
                            <div class="image-upload">
                                <input type="file" maxlength="255" name="file"/>
                                <div class="image-uploads">
                                    <img src="<?= BASEURL; ?>/vendors/img/icons/upload.svg" alt="img" />
                                    <h4>Drag and drop a file to upload</h4>
                                </div>
                            </div>
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
