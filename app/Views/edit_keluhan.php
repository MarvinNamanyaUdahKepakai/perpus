
<div class="container">
  <form action="<?= base_url('/home/aksi_edit_keluhan/?')?>"method="post">
    <input type="hidden" name="id" value="<?php echo $jojo->id_keluhan?>">

<div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="nama" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="nama" placeholder="Isi Tanggal nama" required="required" type="text" value="<?php echo $jojo->nama?>">
            </div>
          </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rw">Ketua RT/RW<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" id="rw" placehoder="Enter rw" name="rw" >
                <option value="<?php echo $jojo->rw?>">-PILIH-</option>
                <?php

                foreach ($jesss as $evan) {
                  ?>
                  <option value ="<?= $evan->id_rw?>"><?php echo $evan->nama_rw?>

                </option>
              <?php } ?>
            </select>
          </div>  
        </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Keluhan">Keluhan<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="keluhan" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="keluhan" placeholder="Isi Tanggal keluhan" required="required" type="text" value="<?php echo $jojo->keluhan?>">
            </div>
          </div>

            <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal">Tanggal<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="tanggal" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="tanggal" placeholder="Isi Tanggal " required="required" type="date" value="<?php echo $jojo->tanggal?>">
            </div>
          </div>

           <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" name ="status">
                <option value="<?php echo $jojo->status?>">Pilih</option>
                <option value="✅">Di periksa</option>
                <option value="❌">Belum diperiksa</option>
              </select>
            </div>
          </div>


         
       
    <button type="submit" class="btn btn-primary">Submit</button>
    
  </form>
</div>

</tr>
</body>
</html>

