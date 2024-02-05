 
<div class="container">
	<form action="<?= base_url('/home/aksi_edit_rw/?')?>"method="post">
		<input type="hidden" name="id" value="<?php echo $jojo->id_rw?>">

		<div class="mb-3 mt-3">
			<label for="nama" class="form-label">RW</label>
			<input type="text" class="form-control" id="nama_rw" placeholder="Isi nama_rw" name="nama_rw" value="<?php echo $jojo->nama_rw?>">
		</div>

		

		<button type="submit" class="btn btn-primary">Submit</button>
		
	</form>
</div>

</tr>
</body>
</html>