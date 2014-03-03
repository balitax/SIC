<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>ukm/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
            <li><a href="<?php echo base_url(); ?>ukm/prestasi">Prestasi</a></li>
        </ul>
        
<div class="maincontent">
    <div class="maincontentinner">
	<a class="btn btn-primary" href="<?php echo base_url(); ?>ukm/prestasi/add" >Tambah Prestasi</a>
	<a class="btn btn-primary" href="<?php echo base_url(); ?>ukm/prestasi/print" target="_blank" >PRINT TABEL</a>
	
	<br />
	<br />
	<h4 class="widgettitle">Data Prestasi . Point Prestasi UKM Ini Sebanyak = <?php echo $point; ?> Point</h4>
	<table id="dyntable" class="table table-bordered">
            <thead>
                <tr>
					<th>No.</th>
                    <th class="head1">Nama Prestasi</th>
                    <th class="head1">Tingkat</th>
                    <th class="head0">Tanggal</th>
                    <th class="head0">Berkas</th>
                    <th class="head0">Aksi</th>
                </tr>
            </thead>
            <tbody>
			
			<?php 
			$no = 1;
				if($tampilpr >0){
			
			foreach($tampilpr1 as $r){
				?>
				<input type="hidden" value="<?php echo $r['id_ukm'] ?>" />
				<tr class="gradeX">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $r['nama_prestasi'] ?></td>
                    <td><?php echo $r['tingkat'] ?></td>
                    <td><?php echo $r['tanggal'] ?></td>
                    <td><a target="_blank" href="<?php echo base_url();?>assets/prestasi/<?php echo $r['berkas'] ?>"><?php echo $r['berkas'] ?></a></td>
                     <td>
						<a title="Edit Data" href="<?php echo base_url(); ?>ukm/prestasi/edit/<?php echo $r['id_prestasi'] ?>" class="iconsweets-create"></a> - 
						<a title="Hapus Data" href="<?php echo base_url(); ?>ukm/prestasi/del/<?php echo $r['id_prestasi'] ?>"
						onclick="return confirm('Apakah anda yakin akan menghapus data ini ?');" class="iconsweets-trashcan">							</a>
					</td>
                </tr>
				<?php
			}
		}
		else {
			echo  "
				<tr>
					<td colspan='5'>BELUM ADA DATA PRESTASI</td>
				</tr>
			";
		}
			 ?>
            </tbody>
	</table>
<br /><br />