      <div class="page-wrapper">
        <div class="content">
          <div class="row">
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <div class="dash-count">
                <div class="dash-counts">
                  <h4><?php echo $data['cards']['total_customers'] ?></h4>
                  <h5>Customers</h5>
                </div>
                <div class="dash-imgs">
                  <i data-feather="user"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <div class="dash-count das1">
                <div class="dash-counts">
                  <h4><?php echo $data['cards']['total_theaters'] ?></h4>
                  <h5>Theaters</h5>
                </div>
                <div class="dash-imgs">
                  <i data-feather="trello"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <div class="dash-count das2">
                <div class="dash-counts">
                  <h4><?php echo $data['cards']['total_tickets_completed'] ?></h4>
                  <h5>Ticket Sold</h5>
                </div>
                <div class="dash-imgs">
                  <i data-feather="film"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <div class="dash-count das3">
                <div class="dash-counts">
                  <h4><?php echo "Rp " . number_format($data['cards']['total_revenue'], 0, ',', '.'); ?></h4>
                  <h5>Revenue</h5>
                </div>
                <div class="dash-imgs">
                  <i data-feather="dollar-sign"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="card mb-0">
            <div class="card-body">
              <h4 class="card-title">Promotion Lists</h4>
              <div class="table-responsive dataview">
                <table class="table datatable ">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Promotion ID</th>
                      <th>Movie Name</th>
                      <th>Discount</th>
                      <th>Description</th>
                      <th>Start Date</th>
                      <th>Expiry Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // Assuming data['table'] contains the active promotions
                    $promotions = $data['tables']; // This will be the array of active promotions
                    $counter = 1; // To number the promotions
                    foreach ($promotions as $promotion) : ?>
                      <tr>
                        <td><?= $counter++; ?></td>
                        <td><a href="javascript:void(0);">PRM-CNM-<?= htmlspecialchars($promotion['id']); ?></a></td>
                        <td class="productimgname">
                          <a class="product-img" href="productlist.html">
                            <!-- Assuming you have a field for the movie's image -->
                            <img src="<?= BASEURL ?>public/<?= htmlspecialchars($promotion['poster']); ?>" alt="product">
                          </a>
                          <a href="productlist.html"><?= htmlspecialchars($promotion['title']); ?></a>
                        </td>
                        <td><?= htmlspecialchars($promotion['discount_percentage']); ?>%</td>
                        <td><?= htmlspecialchars($promotion['description']); ?></td>
                        <td><?= htmlspecialchars($promotion['start_date']); ?></td>
                        <td><?= htmlspecialchars($promotion['end_date']); ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>