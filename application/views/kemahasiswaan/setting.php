<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
            <li><a href="<?php echo base_url(); ?>admin/setting">Profil</a></li>
        </ul>
        
<div class="maincontent">
    <div class="maincontentinner">
<div class="widgetbox box-inverse">
    <h4 class="widgettitle">Setting Profil</h4>
    <div class="widgetcontent nopadding">
        <form class="stdform stdform2" enctype="multipart/form-data" method="post" 
		action="<?php echo base_url(); ?>kemahasiswaan/setting/save">
			
			<input type="hidden" name="kode" value="<?php echo $kode; ?>"/>
			<p>
            <label>Nama Lengkap</label>
            <span class="field">
				<input type="text" name="nama" required="" class="input-xxlarge" 
				value="<?php echo $namalengkap; ?>">
			</span>
        	</p>        
                <p>
                    <label>Username</label>
                    <span class="field">
						<input type="text" name="username" value="<?php echo $username; ?>" required="" class="input-xxlarge">
					</span>
                </p>       
                <p>
                    <label>Password</label>
                    <span class="field">
						<input type="password" required="" placeholder="Ganti Password Anda"  name="password" class="input-xxlarge">
					</span>
                </p>
				<p>
					<label>Foto</label>
					<span class="field">
						<input type="file" name="foto" value="<?php echo $foto; ?>" class="input-xxlarge" required=""/>
					</span>
				</p> 
				<p>
					<label>Images</label>
					<span class="field">
						<img src="<?php echo base_url(); ?>assets/foto_user/<?php 
							if(empty($foto)) { 
							?>gravatar.jpg<?php 
							}else{?><?php echo $foto; ?><?php } ?>"
						title="Setting Profil" />
					</span>
				</p>  
				<span class="field">
				<select name="periode">
					<?php
						foreach($tahun as $t){
							?>
								<option value="<?php echo $t['periode'] ?>"><?php echo $t['periode'] ?></option>
							<?php
						}
					?>
				</select>
			</span>  
                <p class="stdformbutton">
                    <button class="btn btn-primary">Simpan</button> &nbsp;
					<a class="btn btn-primary" href="<?php echo base_url(); ?>admin/users">Batal</a>
                </p>
				
          </form>
</div><!--widgetcontent-->
</div>
        