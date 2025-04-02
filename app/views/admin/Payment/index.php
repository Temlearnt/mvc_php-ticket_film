<div class="page-wrapper">
        <div class="content">
          <div class="page-header">
            <div class="page-title">
              <h4>Sales Management</h4>
              <h6>Payment List</h6>
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
                      <th>Payment ID</th>
                      <th>Ticket ID</th>
                      <th>Method</th>
                      <th>Amount</th>
                      <th>Status</th>
                      <th>Time</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $number=1;
                        foreach($data['payments'] AS $payment):
                    ?>
                    <tr>
                      <td>
                        <?=$number?>
                      </td>
                      <td>PYMT-CNM-<?=$payment['payment_id']?></td>
                      <td>TCKT-CNM-<?=$payment['ticket_id']?></td>
                      <td><?=$payment['payment_method']?></td>
                      <td>Rp <?=number_format($payment['amount'], 0, ',', '.')?></td>
                      <td>
                      <span class="<?php
                          if ($payment['payment_status'] == 'completed') {
                              $class = 'badges bg-lightgreen';
                            }elseif($payment['payment_status'] == 'pending'){
                              $class = 'badges bg-lightyellow';
                          }else {
                              $class = 'badges bg-lightred';
                            }
                          echo $class;
                      ?>"><?= $payment['payment_status'] ?>
                    </span></td>                      
                    <td><?=$payment['payment_time']?></td>
                      <td>
                      <?php
                        $hashId = hash('sha256',$payment['payment_id']);
                      ?>
                        <a class="me-3" href="<?= BASEURL; ?>payment/edit&data=<?=urlencode($hashId)?>">
                          <img src="<?= BASEURL?>vendors/img/icons/edit.svg" alt="img" />
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