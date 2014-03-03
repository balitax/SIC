<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>ukm/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
            <li><a href="<?php echo base_url(); ?>ukm/setting">Profil</a></li>
        </ul>
        
<div class="maincontent">
    <div class="maincontentinner">
<div class="widgetbox box-inverse">
    <h4 class="widgettitle">Setting Profil</h4>
    <div class="widgetcontent nopadding">
        <form class="stdform stdform2" enctype="multipart/form-data" method="post" 
		action="<?php echo base_url(); ?>ukm/setting/save">
			
			<input type="hidden" name="kode" value="<?php echo $kode; ?>"/>
			<p>
            <label>Nama Lengkap</label>
            <span class="field">
				<input type="text" name="nama" required="" class="input-xlarge" 
				value="<?php echo $namalengkap; ?>">
			</span>
        	</p>        
                <p>
                    <label>Username</label>
                    <span class="field">
						<input type="text" name="username" value="<?php echo $username; ?>" required="" class="input-xlarge">
					</span>
                </p>       
                <p>
                    <label>Password</label>
                    <span class="field">
						<input type="password" required="" placeholder="Ganti Password Anda"  name="password" class="input-xlarge">
					</span>
                </p>
				<p>
					<label>Foto</label>
					<span class="field">
						<input type="file" name="foto"  class="input-xlarge" required="" />
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
                <p class="stdformbutton">
                    <button class="btn btn-primary">Simpan</button> &nbsp;
					<a class="btn btn-primary" href="<?php echo base_url(); ?>ukm/users">Batal</a>
                </p>
				
          </form>
</div><!--widgetcontent-->
</div>
        