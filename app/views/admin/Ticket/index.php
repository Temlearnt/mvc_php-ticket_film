<div class="page-wrapper">
        <div class="content">
          <div class="page-header">
            <div class="page-title">
              <h4>Sales Management</h4>
              <h6>Tickets List</h6>
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
                      <th>Ticket ID</th>
                      <th>Name</th>
                      <th>Seat Number</th>
                      <th>Booking Time</th>
                      <th>Showtime</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $number=1;
                        foreach($data['tickets'] AS $ticket):
                    ?>
                    <tr>
                      <td>
                        <?=$number?>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img
                            src="<?=BASEURL;?>public/<?=$ticket['poster']?>"
                            alt="product"
                          />
                        </a>
                        <a href="javascript:void(0);"><?=$ticket['title']?></a>
                      </td>
                      <td>TKT-CNM-<?=$ticket['ticket_id']?></td>
                      <td><?=$ticket['name']?></td>
                      <td><?=$ticket['seat_number']?></td>
                      <td><?=$ticket['booking_time']?></td>
                      <td><?=$ticket['show_time']?></td>                      
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