<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <form class="form-horizontal form-label-left" novalidate action="<?= base_url('/home/aksi_tambah_rw/?')?>"method="post">


          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_barang">Nama RW<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="nama_rw" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="nama_rw" placeholder="Isi nama rw" required="required" type="text">
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