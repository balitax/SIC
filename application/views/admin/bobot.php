<div class="rightpanel">
        
	<ul class="breadcrumbs">
		<li><a href="<?php echo base_url(); ?>admin/bobot"><i class="iconfa-home"></i></a>
		<span class="separator"></span></li>
		<li><a href="<?php echo base_url(); ?>admin/bobot">Bobot</a></li>
	</ul> <br/>
		
		
<div class="maincontent">
<div class="maincontentinner">
	<div class="widgetbox box-inverse">
		<form class="stdform stdform2" method="post" action="<?php echo base_url();?>admin/updatebobot">
			<div class="widgetbox box-inverse">
				<h4 class="widgettitle">Bobot</h4>
				<input type="hidden" name="kode" value="<?php echo $kode; ?> required="" class="input-xxlarge"></span>
				<div class="widgetcontent nopadding">
					<label>LPJ</label>
						<span class="field">
							<input type="text" name="lpj" value="<?php echo $lpj; ?>" required="" class="input-xxlarge">
						</span>
					<label>Prestasi</label>
						<span class="field">
							<input type="text" name="prestasi" value="<?php echo $prestasi; ?>" required="" class="input-xxlarge">
					</span>  
					<label>Kegiatan</label>
						<span class="field">
							<input type="text" name="kegiatan" value="<?php echo $kegiatan; ?>" required="" class="input-xxlarge">
						</span>  
					<label>Anggota</label>
						<span class="field">
							<input type="text" name="anggota" value="<?php echo $anggota; ?>" required="" class="input-xxlarge">
					</span>  
				   <p class="stdformbutton">
						<button class="btn btn-primary">Simpan</button>
						<button type="reset" class="btn">Reset</button>
				   </p>         
				</div>
			</div>
		</form>
	</div><!--widgetcontent-->
	<br/>
	  <?php echo $erorpoints; ?>
	  <?php echo $erorlpjj; ?>
	<br/>
	<div class="widgetbox box-inverse">
		<form class="stdform stdform2" method="post" action="<?php echo base_url();?>admin/updatebobotlpj">
			<div class="widgetbox box-inverse">
				<h4 class="widgettitle">Bobot LPJ</h4>
				<input type="hidden" name="kode" value="<?php echo $kode; ?>" required="" class="input-xxlarge">
				<div class="widgetcontent nopadding">
					<label>LPJ Keuangan</label>
						<span class="field">
							<input type="text" name="lpjkeu" value="<?php echo $lpjkeu; ?>" required="" class="input-xxlarge">
						</span>
					<label>LPJ Kegiatan</label>
						<span class="field">
							* <span>Point lpj kegiatan harus lebih besar dari lpj keuangan.</span> <br />
							<input type="text" name="lpjkg" value="<?php echo $lpjkg; ?>" required="" class="input-xxlarge">
					</span>  
				   <p class="stdformbutton">
						<button class="btn btn-primary">Simpan</button>
						<button type="reset" class="btn">Reset</button>
				   </p>         
				</div>  
			</div>
		</form>
	</div><!--widgetcontent-->
	<br/>
	<div class="widgetbox box-inverse">
		<form class="stdform stdform2" method="post" action="<?php echo base_url();?>admin/telat">
			<div class="widgetbox box-inverse">
				<h4 class="widgettitle">Ketelatan LPJ</h4>
				<input type="hidden" name="kode" value="<?php echo $kode; ?>" required="" class="input-xxlarge">
				<div class="widgetcontent nopadding">
					<label>Opsi Pertama</label>
						<span class="field">
							<b>Hari      :     </b>   
							<input type="text" name="p_hari" value="<?php echo $p_hari; ?>" required="" class="input-small">
							<b>(-) Points     :     </b>   
							<input type="text" name="p_points" value="<?php echo $p_points; ?>" required="" class="input-small">
						</span>
					<label>Opsi Kedua</label>
						<span class="field">
							<b>Hari      : </b>        
							<input type="text" name="k_hari" value="<?php echo $k_hari; ?>" required="" class="input-small">
							<b>(-) Points     : </b>       
							<input type="text" name="k_points" value="<?php echo $k_points; ?>" required="" class="input-small">
						</span>
					<label>Opsi Ketiga</label>
						<span class="field">
							<b>Hari      : </b>       
							<input type="text" name="ke_hari" value="<?php echo $ke_hari; ?>" required="" class="input-small">
							<b>(-) Points     : </b>       
							<input type="text" name="ke_points" value="<?php echo $ke_points; ?>" required="" class="input-small">
						</span> 
				   <p class="stdformbutton">
						<button class="btn btn-primary">Simpan</button>
						<button type="reset" class="btn">Reset</button>
				   </p>         
				</div>  
			</div>
		</form>
	</div><!--widgetcontent-->
 </div>