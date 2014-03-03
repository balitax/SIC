<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>kemahasiswaan/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
            <li><a href="<?php echo base_url(); ?>kemahasiswaan/penilaian_elektabilitas/">eletabilitas UKM</a></li>
        </ul>
        
<div class="maincontent">
    <div class="maincontentinner">
<div class="widgetbox box-inverse">
        <h4 class="widgettitle">Elektabilitas UKM</h4>
        <div class="widgetcontent nopadding">
            <form class="stdform stdform2" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>kemahasiswaan/simpan_elektabilitas">
			<input type="hidden" value="<?php echo $kode; ?>" name="kode" />
				<p>
                <label>Nama UKM</label>
                <span class="field">
					<input type="text" name="nama" readonly="" required="" class="input-xlarge" value="<?php echo $judul; ?>">
				</span>
                </p>
				<p>
                <label>Nilai LPJ</label>
                <span class="field">
					<input type="text" name="lpj" readonly="" required="" class="input-xlarge" value="<?php echo $lpj; ?>">
				</span>
                </p>
				<p>
                <label>Anggota</label>
                <span class="field">
					<input type="text" name="anggota" readonly="" required="" class="input-xlarge" value="<?php echo $anggota; ?>">
				</span>
                </p> 				
				<p>
                <label>Poin Prestasi</label>
                <span class="field">
					<input type="text" name="prestasi" readonly="" required="" class="input-xlarge" value="<?php echo $prestasi; ?>">
				</span>
                </p> 
                <p class="stdformbutton">
                    <button class="btn btn-primary">Simpan</button>&nbsp;&nbsp;
					<a class="btn btn-primary" href="<?php echo base_url(); ?>kemahasiswaan/penilaian_elektabilitas">Batal</a>
                </p>
                    </form>
                </div><!--widgetcontent-->
            </div>
        