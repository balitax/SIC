<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>ukm/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
            <li><a href="<?php echo base_url(); ?>ukm/lpj">Kegiatan</a></li>
        </ul>
        
<div class="maincontent">
    <div class="maincontentinner">
	<a class="btn btn-primary" href="<?php echo base_url(); ?>ukm/kegiatan/add" >Tambah Kegiatan</a>
	<a class="btn btn-primary" href="<?php echo base_url(); ?>ukm/kegiatan/print" target="_blank" >PRINT TABEL</a>
	
	<br />
	<br />
	<h4 class="widgettitle">Data Kegiatan</h4>
	<table id="dyntable" class="table table-bordered">
            <thead>
                <tr>
					<th>No.</th>
                    <th class="head1">Nama Kegiatan</th>
                    <th class="head0">Aksi</th>
                </tr>
            </thead>
            <tbody>
			
			<?php 
			$no = 1;
				if($tampil >0){
			
			foreach($tampilkg1 as $r){
				?>
				<input type="hidden" value="<?php echo $r['id_ukm'] ?>" />
				<tr class="gradeX">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $r['judul_kegiatan'] ?></td>
                     <td>
						<a title="Edit Data" href="<?php echo base_url(); ?>ukm/kegiatan/edit/<?php echo $r['id_kegiatan'] ?>" class="iconsweets-create"></a> - 
						<a title="Hapus Data" href="<?php echo base_url(); ?>ukm/kegiatan/del/<?php echo $r['id_kegiatan'] ?>"
						onclick="return confirm('Apakah anda yakin akan menghapus data ini ?');" class="iconsweets-trashcan">							</a>
					</td>
                </tr>
				<?php
			}
		}
		else {
			echo  "
				<tr>
					<td colspan='5'>BELUM ADA DATA KEGIATAN</td>
				</tr>
			";
		}
			 ?>
            </tbody>
	</table>
<br /><br />