

          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">User</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <!--  <a href="<?= base_url('/home/tambah_user')?>"><button class="btn btn-success"><i class="fa fa-plus"></i></button></a> -->
                      <tr>
                        <th>NO</th>
                        <th>Foto</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Reset pasword</th>
                      </tr>
                    </thead>
                   <!--  <tbody>
                      <tr>
                        <td><a href="#">RA0449</a></td>
                        <td>Udin Wayang</td>
                        <td>Nasi Padang</td>
                        <td><span class="badge badge-success">Delivered</span></td>
                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                      </tr>
                      <tr>
                        <td><a href="#">RA5324</a></td>
                        <td>Jaenab Bajigur</td>
                        <td>Gundam 90' Edition</td>
                        <td><span class="badge badge-warning">Shipping</span></td>
                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                      </tr>
                      <tr>
                        <td><a href="#">RA8568</a></td>
                        <td>Rivat Mahesa</td>
                        <td>Oblong T-Shirt</td>
                        <td><span class="badge badge-danger">Pending</span></td>
                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                      </tr>
                      <tr>
                        <td><a href="#">RA1453</a></td>
                        <td>Indri Junanda</td>
                        <td>Hat Rounded</td>
                        <td><span class="badge badge-info">Processing</span></td>
                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                      </tr>
                      <tr>
                        <td><a href="#">RA1998</a></td>
                        <td>Udin Cilok</td>
                        <td>Baby Powder</td>
                        <td><span class="badge badge-success">Delivered</span></td>
                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                      </tr>
                    </tbody> -->
                 <!--  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div> -->
           <tbody>
                        <?php
      $no=1;
      foreach ($okta as $evan) {

        ?>

       <tr>

          <td><?php echo $no++ ?></td>
          <td><img src="<?=base_url('images/'.$evan->foto)?>" height="100px"></td>
          <td><?php echo $evan->username?> </td>
          <td><?php echo $evan->nama_level?> </td>



          <td>
          <a class="btn btn-warning" href="<?php echo base_url('home/reset_password/'. $evan->id_user) ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
              <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
            </svg>
          Reset Password</a>
        </td>
          <!-- <td><?php echo $evan->sesi?> </td> -->
        <!--   <td><?php echo $evan->nik?> </td> -->
          
          
          <!--  <td> 
            <a href="<?=base_url('/home/edit_jadwal/'.$evan->id_guru)?>"> <button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
            <a href="<?=base_url('/home/hapus_jadwal/'.$evan->id_jadwal)?>"> <button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>

          </td> 
          

        </tr> -->
        <?php
      }
      ?>
                        
                        
                      </tbody>
                    </table>
                  </div>
                </div>
