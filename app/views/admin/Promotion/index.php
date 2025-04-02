<div class="page-wrapper">
        <div class="content">
          <div class="page-header">
            <div class="page-title">
              <h4>Sales Management</h4>
              <h6>Promotion List</h6>
            </div>
            <div class="page-btn">
              <a href="<?= BASEURL; ?>promotion/add" class="btn btn-added"
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
                      <th>Promotion ID</th>
                      <th>Title</th>
                      <th>Discount</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Note</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $number=1;
                        foreach($data['promotions'] AS $promotion):
                    ?>
                    <tr>
                      <td>
                        <?=$number?>
                      </td>
                      <td>PRM-CNM-<?=$promotion['id']?></td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img
                            src="<?=BASEURL;?>public/<?=$promotion['poster']?>"
                            alt="product"
                          />
                        </a>
                        <a href="javascript:void(0);"><?=$promotion['title']?></a>
                      </td>
                      <td><?=$promotion['discount_percentage']?>%</td>
                      <td><?=$promotion['start_date']?></td>
                      <td><?=$promotion['end_date']?></td>
                      <td><?=$promotion['note']?></td>
                      <td>
                      <?php
                        $hashId = hash('sha256',$promotion['id']);
                      ?>
                        <a class="me-3" href="<?= BASEURL; ?>promotion/edit&data=<?=urlencode($hashId)?>">
                          <img src="<?= BASEURL?>vendors/img/icons/edit.svg" alt="img" />
                        </a>
                        <a class="confirm-text" href="<?= BASEURL; ?>promotion/drop&data=<?=urlencode($hashId)?>">
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