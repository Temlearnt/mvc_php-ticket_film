<div class="page-wrapper">
        <div class="content">
          <div class="page-header">
            <div class="page-title">
              <h4>Film Management</h4>
              <h6>Schedules List</h6>
            </div>
            <div class="page-btn">
              <a href="<?= BASEURL; ?>schedule/add" class="btn btn-added"
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
                      <th>Schedule ID</th>
                      <th>Theater</th>
                      <th>Location</th>
                      <th>Duration</th>
                      <th>Showtime</th>
                      <th>Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $number=1;
                        foreach($data['schedules'] AS $schedule):
                    ?>
                    <tr>
                      <td>
                        <?=$number?>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img
                            src="<?=BASEURL;?>public/<?=$schedule['poster']?>"
                            alt="product"
                          />
                        </a>
                        <a href="javascript:void(0);"><?=$schedule['title']?></a>
                      </td>
                      <td>SCH-CNM-<?=$schedule['schedule_id']?></td>
                      <td><?=$schedule['name']?></td>
                      <td><?=$schedule['location']?></td>
                      <td><?=$schedule['duration_minutes']?> minutes</td>
                      <td><?=$schedule['show_time']?></td>
                      <td>Rp <?=number_format($schedule['price'], 0, ',', '.')?></td>
                      <td>
                      <?php
                        $hashId = hash('sha256',$schedule['schedule_id']);
                      ?>
                        <a class="me-3" href="<?= BASEURL; ?>schedule/edit&data=<?=urlencode($hashId)?>">
                          <img src="<?= BASEURL?>vendors/img/icons/edit.svg" alt="img" />
                        </a>
                        <a class="confirm-text" href="<?= BASEURL; ?>schedule/drop&data=<?=urlencode($hashId)?>">
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