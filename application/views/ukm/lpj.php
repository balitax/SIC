<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>ukm/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
            <li><a href="<?php echo base_url(); ?>ukm/lpj">LPJ</a></li>
        </ul>
        
<div class="maincontent">
    <div class="maincontentinner">
	<a class="btn btn-primary" href="<?php echo base_url(); ?>ukm/lpj/add" >Tambah LPJ</a>
	<a class="btn btn-primary" href="<?php echo base_url(); ?>ukm/lpj/print" target="_blank" >PRINT TABEL</a>
	
	<br />
	<br />
	<h4 class="widgettitle">Data Table</h4>
	<table id="dyntable" class="table table-bordered responsive">
            <thead>
                <tr>
                    <th class="head0">No.</th>
                    <th class="head1">Nama Lpj</th>
                    <th class="head0">Tanggal</th>
                    <th class="head0">Berkas</th>
                    <th class="head0">Status</th>
                    <th class="head0">Aksi</th>
                </tr>
            </thead>
            <tbody>
			<?php 
			$no = 1;
			foreach($lpj as $l){
				?>
				<tr class="gradeX">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $l['nama_lpj'] ?></td>
                    <td><?php echo $l['tanggal'] ?></td>
                    <td><a target="_blank" href="<?php echo base_url(); ?>assets/lpj/<?php echo $l['berkas'] ?>"><?php echo $l['berkas'] ?></a></td>
					<td><?php echo $l['status'] ?></td>
                     <td>
						<a title="Edit Data" href="<?php echo base_url(); ?>ukm/lpj/edit/<?php echo $l['id_lpj'] ?>" class="iconsweets-create"></a> - 
						<a title="Hapus Data" href="<?php echo base_url(); ?>ukm/lpj/del/<?php echo $l['id_lpj'] ?>"
						onclick="return confirm('Apakah anda yakin akan menghapus data ini ?');" class="iconsweets-trashcan">							</a>
					</td>
                </tr>
				<?php
			}
			 ?>
            </tbody>
	</table>
<br /><br />