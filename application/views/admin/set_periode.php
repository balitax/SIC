<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
        </ul>
        
<div class="maincontent">
<div class="maincontentinner">
	<div class="widgetbox box-inverse">
                <h4 class="widgettitle">Setting Periode</h4>
                <div class="widgetcontent nopadding">
                    <form class="stdform stdform2"  method="post" action="<?php echo base_url(); ?>admin/periode/save">
					<input  type="hidden" value="<?php echo $kode; ?>" name="kode" />
                <p>
                    <label>Setting Periode Sistem Elektabilitas</label>
                    <span class="field">
					<select name="periode" class="uniformselect">
						<option>-- Silahkan Pilih Periode --</option>
						<option value="dibuka">Di Buka</option>
						<option value="ditutup">Di Tutup</option>
                    </select>
					</span>
                </p>                          
                <p class="stdformbutton">
                    <button class="btn btn-primary">Simpan</button>&nbsp;&nbsp;
					<a class="btn btn-primary" href="<?php echo base_url(); ?>admin/users">Batal</a>
                </p>
                    </form>
                </div><!--widgetcontent-->
            </div>
        