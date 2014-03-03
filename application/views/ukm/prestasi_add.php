<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>ukm/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
            <li><a href="<?php echo base_url(); ?>ukm/prestasi">Prestasi</a></li>
        </ul>
			<div class="maincontent">    <div class="maincontentinner"><div class="widgetbox box-inverse">
			<h4 class="widgettitle"><?php if($status == "baru"){ ?>Tambah <?php }else{ ?> Edit <?php } ?> Prestasi</h4>
			<div class="widgetcontent nopadding">
			<form class="stdform stdform2" enctype="multipart/form-data" method="post" action="<?php echo base_url();?>ukm/prestasi/save">
			
			<input type="hidden" name="status" value="<?php echo $status; ?>" />
			<input type="hidden" name="kode" value="<?php echo $kode; ?>" />
			<input type="hidden" name="poin" value="<?php echo $poin; ?>" />
                 
			<label>Nama Prestasi</label>                    
			<span class="field">
			<input type="text" required="" name="nama" value="<?php echo $nama_p; ?>" class="input-xlarge"></span>            
			</p>
			<p>
				<label>Tingkat Presasi</label>
				<span class="field">
					<select name="tingkat">
						<option>-- Silahkan Pilih Tingkat --</option>
						<option value="kampus">Antar Kampus</option>
						<option value="daerah">Antar Daerah/ Provinsi</option>
						<option value="nasional">Nasional</option>
					</select>
				</span>
			</p>
			<p>                    
			<label>Tanggal</label>                    
			<span class="field">
			<input type="date" required="" name="tgl" value="<?php echo $tgl; ?>" class="input-xlarge"></span>                
			</p> 
			<p>                    
			<label>Berkas Prestasi</label>                    
			<span class="field">
			<input type="file" required="" name="berkas" class="input-xlarge"><br />
			<br />
			<span>* Berkas File Berupa Pdf/ JPG/ Png</span><br />
			<span>* Berkas bisa berupa Piagam / Foto / Sertifikat</span> <br />
			<span>* Ukuran Maksimal File 5Mb</span>
			</span>     
			</p> 
			<p>
			<p class="stdformbutton">
	            <button class="btn btn-primary"><?php if($status == "baru"){ ?>Simpan <?php }else{ ?> Update <?php } ?></button>&nbsp;&nbsp;
				<a class="btn btn-primary" href="<?php echo base_url(); ?>ukm/kegiatan">Batal</a>
            </p>			
			</p>                    
			</form>                
			</div><!--widgetcontent-->            
			</div>        
			<div class="maincontent">            
			<div class="maincontentinner">                
			<div class="row-fluid">                                    
			</div>                     <div class="footer-right">                        
			
        