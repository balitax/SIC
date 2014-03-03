<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>kemahasiswaan/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
            <li><a href="<?php echo base_url(); ?>kemahasiswaan/verifikasi_lpj">Verifikasi LPJ</a></li>
        </ul>
        
<div class="maincontent">
    <div class="maincontentinner">
<div class="widgetbox box-inverse">
        <h4 class="widgettitle">Verifikasi LPJ UKM</h4>
        <div class="widgetcontent nopadding">
            <form class="stdform stdform2" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>kemahasiswaan/v_lpj/save">
			<input type="hidden" value="<?php echo $kode; ?>" name="kode" />
				<p>
                <label>Nama LPJ</label>
                <span class="field">
					<input type="text" name="nama" readonly="" required="" class="input-xlarge" value="<?php echo $nama; ?>">
				</span>
                </p>           
                <p>
                    <label>Status Verifikasi</label>
                    <span class="field">
					<select name="status" class="uniformselect">
                       <option>-- Silahkan Pilih Status--</option>
						<option value="diterima">Di Terima</option>
						<option value="ditolak">Di Tolak</option>
                    </select>
					</span>
                </p>                              
                <p class="stdformbutton">
                    <button class="btn btn-primary">Simpan</button>&nbsp;&nbsp;
					<a class="btn btn-primary" href="<?php echo base_url(); ?>kemahasiswaan/verifikasi_lpj">Batal</a>
                </p>
                    </form>
                </div><!--widgetcontent-->
            </div>
        