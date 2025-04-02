<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>Film Management</h4>
        <h6>Theaters List</h6>
      </div>
      <div class="page-btn">
        <a href="<?= BASEURL; ?>theater/add" class="btn btn-added"><img src="<?= BASEURL ?>vendors/img/icons/plus.svg" alt="img" class="me-1" />Tambah Data</a>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="table-top">
          <div class="search-set">
            <div class="search-path">
              <a href="<?= BASEURL; ?>/tablemovies/printmovies" class="btn btn-filter" id="filter_search">
                <img src="<?= BASEURL ?>vendors/img/icons/printer.svg" alt="img">
              </a>
            </div>
            <div class="search-input">
              <a class="btn btn-searchset"><img src="<?= BASEURL ?>vendors/img/icons/search-white.svg" alt="img" /></a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table datanew">
            <thead>
              <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Theater ID</th>
                <th>Location</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $number = 1;
              foreach ($data['theaters'] as $theater) : ?>
                <tr>
                  <td><?= $number ?></td>
                  <td><?= $theater['name'] ?></td>
                  <td>THR-CNM-<?= $theater['theater_id'] ?></td>
                  <td><?= $theater['location'] ?></td>
                  <td>
                  <?php
                  $hashId = hash('sha256', $theater['theater_id']);
                  ?>
                  <a class="me-3" href="<?= BASEURL; ?>theater/edit&data=<?= urlencode($hashId) ?>">
                    <img src="<?= BASEURL ?>vendors/img/icons/edit.svg" alt="img" />
                  </a>
                  <a class="confirm-text" href="<?= BASEURL; ?>theater/drop&data=<?= urlencode($hashId) ?>">
                    <img src="<?= BASEURL ?>vendors/img/icons/delete.svg" alt="img" />
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