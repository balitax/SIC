<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>ukm/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
            <li><a href="<?php echo base_url(); ?>ukm/struktur">Struktur</a></li>
        </ul>
        
<div class="maincontent">
    <div class="maincontentinner">
<div class="widgetbox box-inverse">
        <h4 class="widgettitle">Struktur UKM</h4>
        <div class="widgetcontent nopadding">
            <form class="stdform stdform2" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>ukm/struktur/save">  
			<input type="hidden" value="<?php echo $kode; ?>" name="kode" />    
            <p>
                <label>Nama UKM</label>
                <span class="field">
					<input type="text" required="" value="<?php echo $nama; ?>" readonly=""  name="nama" class="input-xxlarge">
				</span>
            </p>
			<p>
                <label>Struktur Organisasi</label>
                <span class="field">
					<input type="file" name="b_struktur" class="input-xxlarge" /><br />
					<br />
					<span>* File Harus Berupa Jpg/Png</span><br />
					<span>* Ukuran Maksimal File 10Mb</span>
				</span>
            </p> 
			
			<p>
                <label>Struktur Organisasi Preview</label>
                <span class="field">
					<?php echo $imgstr; ?>
				</span>
            </p> 
			                       
            <p class="stdformbutton">
                <button class="btn btn-primary">Simpan</button>&nbsp;&nbsp;
				<a class="btn btn-primary" href="<?php echo base_url(); ?>ukm/lpj">Batal</a>
            </p>
                </form>
            </div><!--widgetcontent-->
        </div>
        