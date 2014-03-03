<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>admin/pointsetting"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
            <li><a href="<?php echo base_url(); ?>admin/pointsetting">Manajemen Point </a></li>
        </ul> <br/>
		
<div class="maincontent">
<div class="maincontentinner">
	<div class="widgetbox box-inverse">
		<form class="stdform stdform2" method="post" action="<?php echo base_url();?>admin/points/save">
			<div class="widgetbox box-inverse">
					<h4 class="widgettitle">LPJ Keuangan</h4>
					<div class="widgetcontent nopadding">
						<label>Administrasi</label>
						<span class="field"><input type="text" name="lpj_administrasi" value="<?php echo $lpj_ad; ?>" required="" class="input-xxlarge"></span>
						<label>Keuangan</label>
						<span class="field"><input type="text" name="lpj_keuangan" value="<?php echo $lpj_ku; ?>" required="" class="input-xxlarge"></span>  
					<?php echo $e_keu; ?>
					</div>
					<h4 class="widgettitle">LPJ Kegiatan</h4>
					<div class="widgetcontent nopadding">
							<label>Lembar Pengesahan</label>
							<span class="field"><input type="text" name="lpj_pengesahan" value="<?php echo $lpj_pe; ?>" required="" class="input-xxlarge"></span>
							<label>Pendahuluan</label>
							<span class="field"><input type="text" name="lpj_pendahuluan" value="<?php echo $lpj_pen; ?>" required="" class="input-xxlarge"></span>
							<label>Struktur Kepanitiaan</label>
							<span class="field"><input type="text" name="lpj_struktur_kepanitiaan" value="<?php echo $lpj_str; ?>" required="" class="input-xxlarge"></span>
							<label>Job Diskripsi</label>
							<span class="field"><input type="text" name="lpj_job_diskripsi" value="<?php echo $lpj_job; ?>" required="" class="input-xxlarge"></span>
							<label>Hasil Pelaksanaan</label>
							<span class="field"><input type="text" name="lpj_hasil_pelaksanaan" value="<?php echo $lpj_hsl; ?>" required="" class="input-xxlarge"></span>
							<label>Penutup</label>
							<span class="field"><input type="text" name="lpj_penutup" value="<?php echo $lpj_pnp; ?>" required="" class="input-xxlarge"></span>
							<label>Lampiran</label>
							<span class="field"><input type="text" name="lpj_lampiran" value="<?php echo $lpj_lmp; ?>" required="" class="input-xxlarge"></span>
					<?php echo $e_keg; ?>
					</div>
				
					<h4 class="widgettitle">Prestasi</h4>
					<div class="widgetcontent nopadding">
							<label>Antar Kampus</label>
							<span class="field"><input type="text" name="pres_antar_kampus" value="<?php echo $pres_kmp; ?>" required="" class="input-xxlarge"></span>							   
							<label>Provinsi</label>
							<span class="field"><input type="text" name="pres_provinsi" value="<?php echo $pres_pvs; ?>" required="" class="input-xxlarge"></span>									
							<label>Nasional</label>
							<span class="field"><input type="text" name="pres_nasional" value="<?php echo $pres_nsl; ?>" required="" class="input-xxlarge"></span>
					<?php echo $e_pres; ?>
						<p class="stdformbutton">
							<button class="btn btn-primary">Simpan</button>
							<button type="reset" class="btn">Resets</button>
						</p> 
					</div>
            </div>
		</form>
	</div><!--widgetcontent-->
 </div>