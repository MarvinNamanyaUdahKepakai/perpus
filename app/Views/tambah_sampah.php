<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">

        <form class="form-horizontal form-label-left" novalidate action="<?= base_url('/home/aksi_tambah_sampah/?')?>"method="post">

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="petugas">Nama Petugas<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" id="petugas" placehoder="Enter petugas" name="petugas" >
                <option value="<?php echo $jojo->petugas?>">-PILIH-</option>
                <?php 

                foreach ($okta as $evan) {
                  ?>
                  <option value ="<?= $evan->id_petugas?>"><?php echo $evan->nama_petugas?>

                </option>
              <?php } ?>
            </select>
          </div>
        </div>

         <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rw">RT/RW<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" id="rw" placehoder="Enter blok" name="rw">
                <option value="<?php echo $jojo->rw?>">-PILIH-</option>
                <?php

                foreach ($okt as $evan) {
                  ?>
                  <option value ="<?= $evan->id_rw?>"><?php echo $evan->nama_rw?>

                </option>
              <?php } ?>
            </select>
          </div>
        </div>

         <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sampah_organik">Sampah Organik<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="sampah_organik" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="sampah_organik" placeholder="Isi sampah_organik" required="required" type="text">
            </div>
          </div>

           <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sampah_anorganik">Sampah Anorganik<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="sampah_anorganik" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="sampah_anorganik" placeholder="Isi sampah_anorganik" required="required" type="text">
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sampah_b3">Sampah B3<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="sampah_b3" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="sampah_b3" placeholder="Isi sampah_b3" required="required" type="text">
            </div>
          </div>


<div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal">Tanggal<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="tanggal" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="tanggal" placeholder="Isi Tanggal" required="required" type="date">
            </div>
          </div>


        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-6 col-md-offset-3">
            <button type="submit" class="btn btn-primary">Cancel</button>
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>