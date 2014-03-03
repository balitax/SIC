<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
            <li><a href="<?php echo base_url(); ?>admin/users">Manajemen User</a></li>
        </ul>
        
<div class="maincontent">
<div class="maincontentinner">
	<div class="widgetbox box-inverse">
                <h4 class="widgettitle"><?php if($status == "baru"){ ?>Tambah <?php }else{ ?> Edit <?php } ?>User</h4>
                <div class="widgetcontent nopadding">
                    <form class="stdform stdform2" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>admin/users/save">
					
					<?php if($status == "baru"){ ?>
						<input type="hidden" value="<?php echo $kode; ?>" name="kode" />
						<input type="hidden" value="<?php echo $status; ?>" name="status" />
                            <p>
                    <label>Nama Lengkap</label>
                    <span class="field">
						<input type="text" name="nama" required="" class="input-xlarge" value="<?php echo $namalengkap; ?>">
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
						<input type="text" required=""  name="password" class="input-xlarge">
					</span>
                </p>
                <p>
                    <label>Level</label>
                    <span class="field">
					<select name="level" class="uniformselect">
						<option>-- Silahkan Pilih Level --</option>
						<option value="ukm">UKM</option>
						<option value="kemahasiswaan">Kemahasiswaan</option>
						<option value="admin">Administrator</option>
                    </select>
					</span>
                </p> 
				<p>
                    <label>Aktif</label>
                    <span class="field">
					<select name="aktif" class="uniformselect">
                       <option>-- Silahkan Pilih Status--</option>
						<option value="Y">Ya</option>
						<option value="T">Tidak</option>
                    </select>
					</span>
                </p>                             
                <p class="stdformbutton">
                    <button class="btn btn-primary">Simpan</button>&nbsp;&nbsp;
					<a class="btn btn-primary" href="<?php echo base_url(); ?>admin/users">Batal</a>
                </p>
					<?php }else{ ?>
						<input type="hidden" value="<?php echo $kode; ?>" name="kode" />
						<input type="hidden" value="<?php echo $status; ?>" name="status" />
                            <p>
                    <label>Nama Lengkap</label>
                    <span class="field">
						<input type="text" readonly="" name="nama" required="" class="input-xlarge" value="<?php echo $namalengkap; ?>">
					</span>
                </p>  
                <p>
                    <label>Level</label>
                    <span class="field">
					<select name="level" class="uniformselect">
						<option>-- Silahkan Pilih Level --</option>
						<option value="ukm">UKM</option>
						<option value="kemahasiswaan">Kemahasiswaan</option>
						<option value="admin">Administrator</option>
                    </select>
					</span>
                </p> 
				<p>
                    <label>Aktif</label>
                    <span class="field">
					<select name="aktif" class="uniformselect">
                       <option>-- Silahkan Pilih Status--</option>
						<option value="Y">Ya</option>
						<option value="T">Tidak</option>
                    </select>
					</span>
                </p>                          
                <p class="stdformbutton">
                    <button class="btn btn-primary">Update</button>&nbsp;&nbsp;
					<a class="btn btn-primary" href="<?php echo base_url(); ?>admin/users">Batal</a>
                </p>
					<?php } ?>
                    </form>
                </div><!--widgetcontent-->
            </div>
        