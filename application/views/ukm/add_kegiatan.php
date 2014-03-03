<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>ukm/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
            <li><a href="<?php echo base_url(); ?>ukm/Kegiatan">Kegiatan</a></li>
        </ul>
			<div class="maincontent">    <div class="maincontentinner"><div class="widgetbox box-inverse">
			<h4 class="widgettitle"><?php if($status == "baru"){ ?>Tambah <?php }else{ ?> Edit <?php } ?> Kegiatan</h4>
			<div class="widgetcontent nopadding">
			<form class="stdform stdform2" enctype="multipart/form-data" method="post" action="<?php echo base_url();?>ukm/kegiatan/save">
			
			<input type="hidden" name="status" value="<?php echo $status; ?>" />
			<input type="hidden" name="kode" value="<?php echo $kode; ?>" />
             <p>   
			<label>Nama Kegiatan</label>                    
			<span class="field">
			<input type="text" required="" name="judul" value="<?php echo $judul; ?>" class="input-xlarge"></span>                
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
			
        