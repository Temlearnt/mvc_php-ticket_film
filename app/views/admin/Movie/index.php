<div class="page-wrapper">
        <div class="content">
          <div class="page-header">
            <div class="page-title">
              <h4>Film Management</h4>
              <h6>Movies List</h6>
            </div>
            <div class="page-btn">
              <a href="<?= BASEURL; ?>movie/add" class="btn btn-added"
                ><img
                  src="<?= BASEURL?>vendors/img/icons/plus.svg"
                  alt="img"
                  class="me-1"
                />Tambah Data</a
              >
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="table-top">
                <div class="search-set">
                <div class="search-path">
                    <a href="<?= BASEURL; ?>/tablemovies/printmovies" class="btn btn-filter" id="filter_search">
                      <img src="<?= BASEURL?>vendors/img/icons/printer.svg" alt="img">
                    </a>
                  </div>
                  <div class="search-input">
                    <a class="btn btn-searchset"
                      ><img src="<?= BASEURL?>vendors/img/icons/search-white.svg" alt="img"
                    /></a>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table datanew">
                  <thead>
                    <tr>
                      <th>
                        No.
                      </th>
                      <th>Title</th>
                      <th>Movie ID</th>
                      <th>Genre</th>
                      <th>Duration</th>
                      <th>Release</th>
                      <th>Rating</th>
                      <th>Description</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $number=1;
                        foreach($data['movies'] AS $movies):
                    ?>
                    <tr>
                      <td>
                        <?=$number?>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img
                            src="<?=BASEURL;?>public/<?=$movies['poster']?>"
                            alt="product"
                          />
                        </a>
                        <a href="javascript:void(0);"><?=$movies['title']?></a>
                      </td>
                      <td>MV-CNM-<?=$movies['movie_id']?></td>
                      <td><?=$movies['genre']?></td>
                      <td><?=$movies['duration_minutes']?> minutes</td>
                      <td><?=$movies['release_date']?></td>
                      <td><?=$movies['rating']?>/10</td>
                      <td><?=$movies['description']?></td>
                      <td>
                      <?php
                        $hashId = hash('sha256',$movies['movie_id']);
                      ?>
                        <a class="me-3" href="<?= BASEURL; ?>movie/edit?data=<?=urlencode($hashId)?>">
                          <img src="<?= BASEURL?>vendors/img/icons/edit.svg" alt="img" />
                        </a>
                        <a class="confirm-text" href="<?= BASEURL; ?>movie/drop?data=<?=urlencode($hashId)?>">
                          <img src="<?= BASEURL?>vendors/img/icons/delete.svg" alt="img" />
                        </a>
                      </td>
                    </tr>
                    <?php         
                        $number++;
                        endforeach;
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>