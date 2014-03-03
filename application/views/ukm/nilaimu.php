<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>ukm/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
        </ul>
        
<div class="maincontent">
    <div class="maincontentinner">
	<a class="btn btn-primary" href="<?php echo base_url(); ?>ukm/kegiatan/print" target="_blank" >PRINT TABEL</a>
	
	<br />
	<br />
	<h4 class="widgettitle">Data Kegiatan</h4>
	<table id="dyntable" class="table table-bordered">
            <thead>
                <tr>
                    <th class="head1">No.</th>
                    <th class="head1">Nama UKM</th>
                    <th class="head0">Point Elektabilitas</th>
                    <th class="head0">Tahun</th>
                    <th class="head0">Aksi</th>
                </tr>
            </thead>
            <tbody>
			<?php $no = 1;
				foreach($nilai as $n){
			?>
				<tr class="gradeX">
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $n['nama'];?></td>
                    <td><?php echo $n['point'];?></td>
                    <td><?php echo $n['tahun'];?></td>
                     <td>
						<a title="Edit Data" href="">Lihat Pint UKM Lain</a>
					</td>
                </tr>
				<?php } ?>
            </tbody>
	</table>
<br /><br />