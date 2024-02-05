

          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Altivity Log</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                   <thead class="green-header">
 <!--  <a href="<?= base_url('/home/tambah_guru') ?>"><button class="btn btn-success"><i class="fa fa-plus"></i></button></a> -->
  <tr>
    <th>NO</th>
    <th>Username</th>
    <th>Aktivitas</th>
    <th>Waktu</th>
    
  </tr>
</thead>
<style>
  .green-header {
    background-color: blue;
    color: white; /* You can adjust the text color as needed */
  }
</style>



       <style>      

@keyframes slideDown {
    from {
        transform: translateY(-100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.animated-header {
    animation: slideDown 0.5s ease-in-out forwards;
    /* Adjust animation duration and easing as needed */
}
</style>      

           <tbody>
                        <?php
      $no=1;
      foreach ($okta as $evan) {

        ?>

        <tr>

          <td><?php echo $no++ ?></td>
          <!-- <td><?php echo $evan->id_guru?> </td> -->
          <td><?php echo $evan->username?> </td>
          <td><?php echo $evan->aktiviti?> </td>
          <td><?php echo $evan->waktu?> </td>
         
          
        

        </tr>
        <?php
      }
      ?>
                        
                        
                      </tbody>
                    </table>
                  </div>
                </div>
