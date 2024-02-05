<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">

        <form class="form-horizontal form-label-left" novalidate action="<?= base_url('/home/aksi_tambah_keluhan/?')?>"method="post">

           <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="nama" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="nama" placeholder="Isi nama" required="required" type="text">
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
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keluhan">Keluhan<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="keluhan" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="keluhan" placeholder="Isi keluhan" required="required" type="text">
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