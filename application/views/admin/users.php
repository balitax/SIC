<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
            <li><a href="<?php echo base_url(); ?>admin/users">Manajemen User</a></li>
        </ul>
        
<div class="maincontent">
    <div class="maincontentinner">
	<a class="btn btn-primary" href="<?php echo base_url(); ?>admin/users/new" >Tambah User</a>
	
	<br />
	<br />
	<h4 class="widgettitle">Data Table</h4>
	<table id="dyntable" class="table table-bordered responsive">
            <thead>
                <tr>
                    <th class="head0">No.</th>
                    <th class="head1">Nama Lengkap</th>
                    <th class="head0">Username</th>
                    <th class="head1">Level</th>
                    <th class="head0">Aktif</th>
                    <th class="head0">Aksi</th>
                </tr>
            </thead>
            <tbody>
			
			<?php
			$no = 1;
				foreach($user as $u){
					?>
					<tr class="gradeX">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $u['nama_lengkap'] ?></td>
                    <td><?php echo $u['username'] ?></td>
                    <td><?php echo $u['level'] ?></td>
                    <td><?php echo $u['aktif'] ?></td>
                    <td>
						<a title="Edit Data" href="users/edit/<?php echo $u['id']  ?>" class="iconsweets-create"></a> - 
						<a title="Hapus Data" href="<?php echo base_url(); ?>admin/users/del/<?php echo $u['id']  ?>"
						onclick="return confirm('Apakah anda yakin akan menghapus data ini ?');" class="iconsweets-trashcan"></a> 
					</td>
                </tr>
					<?php
				}
			?>
            </tbody>
	</table>
<br /><br />