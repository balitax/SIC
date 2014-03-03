<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>ukm/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
            <li><a href="<?php echo base_url(); ?>ukm/anggota">Anggota</a></li>
        </ul>
			<div class="maincontent">    <div class="maincontentinner"><div class="widgetbox box-inverse">
			<h4 class="widgettitle"><?php if($status == "baru"){ ?>Tambah <?php }else{ ?> Edit <?php } ?> Anggota</h4>
			<div class="widgetcontent nopadding">
			<form class="stdform stdform2" enctype="multipart/form-data" method="post" action="<?php echo base_url();?>ukm/anggota/save">
			
			<input type="hidden" name="status" value="<?php echo $status; ?>" />
			<input type="hidden" name="kode" value="<?php echo $kode; ?>" />
                 
			<label>Jumlah Anggota</label>                    
			<span class="field">
			<input type="number" required="" name="jumlah" value="<?php echo $jumlah; ?>" class="input-xlarge"></span>                
			</p>
			<p>                    
			<label>Tahun Periode</label>                    
			<span class="field">
			<input type="text" required="" disabled="disabled" name="thn_periode" value="<?php echo date('Y') ?>" class="input-xlarge"></span>                
			</p> 
			<label>Berkas</label>                    
			<span class="field">
				<input type="file" name="berkas_agt" class="input-xxlarge" />
				<br />
				<br />
				<span>* Berkas File Harus Berupa Pdf</span><br />
				<span>* Ukuran Maksimal File 5 Mb</span>
			</span>                
			</p> 
			<p>
			<p class="stdformbutton">
	            <button class="btn btn-primary"><?php if($status == "baru"){ ?>Simpan <?php }else{ ?> Update <?php } ?></button>&nbsp;&nbsp;
				<a class="btn btn-primary" href="<?php echo base_url(); ?>ukm/lpj">Batal</a>
            </p>			
			</p>                    
			</form>                
			</div><!--widgetcontent-->            
			</div>        
			<div class="maincontent">            
			<div class="maincontentinner">                
			<div class="row-fluid">                                    
			</div>                     <div class="footer-right">                        
			
        