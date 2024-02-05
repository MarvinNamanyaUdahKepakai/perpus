


        <form class="form-horizontal form-label-left" novalidate  action="<?= base_url('/home/aksi_edit_penduduk/?')?>"method="post">
          
          <input type="hidden" name="id" value="<?php echo $rizkan->id_user ?>">
          <input type="hidden" name="id2" value="<?php echo $jojo->user ?>">
      
       

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="username" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="username" placeholder="Isi Username" required="required" type="text" value="<?php echo $rizkan->username?>">
            </div>
          </div>

 <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="password" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="password" placeholder="Isi Password" required="required" type="password" value="<?php echo $rizkan->password?>">
            </div>
          </div> 

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_penduduk">Nama penduduk<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="nama_penduduk" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="nama_penduduk" placeholder="Isi nama nama_penduduk" required="required" type="text" value="<?php echo $jojo->nama_penduduk?>">
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rw">Ketua RT/RW<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" id="rw" placehoder="Enter rw" name="rw" >
                <option value="<?php echo $jojo->rw?>">-PILIH-</option>
                <?php

                foreach ($jes as $evan) {
                  ?>
                  <option value ="<?= $evan->id_rw?>"><?php echo $evan->nama_rw?>

                </option>
              <?php } ?>
            </select>
          </div> 
        </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jenis">Jenis Kelamin<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" name ="jk">
                <option value="<?php echo $jojo->jk?>">Pilih</option>
                <option value="Laki-laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal">Tanggal Lahir<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="tgl" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="tanggal" placeholder="Isi Tanggal Lahir" required="required" type="date" value="<?php echo $jojo->tanggal?>">
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