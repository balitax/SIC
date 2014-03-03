<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>ukm/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
            <li><a href="<?php echo base_url(); ?>ukm/anggota">Anggota</a></li>
        </ul>
        
<div class="maincontent">
    <div class="maincontentinner">
	
	<br />
	<br />
	<h4 class="widgettitle">Data Anggota</h4>
	<table id="dyntable" class="table table-bordered">
            <thead>
                <tr>
                    <th class="head0" width="100">No.</th>
                    <th class="head0" width="100">Jumlah</th>
                    <th class="head0" width="100">Peridoe Tahun</th>
                    <th class="head" width="100">Berkas</th>
                    <th class="head0" width="100">Aksi</th>
                </tr>
            </thead>
            <tbody>
			
			<?php
				if($liat >0){
					foreach($liat1 as $l){
						?>
					<tr class="gradeX">
                    <td>1</td>
                    <td><?php echo $l['jumlah_anggota'] ?></td>
                    <td><?php echo $l['tahun_periode'] ?></td>
                    <td><a target="_blank" href="<?php echo base_url(); ?>assets/anggota/<?php echo $l['berkas'] ?>"><?php echo $l['berkas'] ?></a></td>
                    <td>
						<a title="Edit Data" href="anggota/edit/<?php echo $l['id_anggota'] ?>" class="iconsweets-create"></a> - 
						<a title="Lihat Berkas" target="_blank" href="../assets/anggota/<?php echo $l['berkas'] ?>" class="iconsweets-magnifying"></a> 
					</td>
                	</tr>
						<?php
					}
				}
				else {
					echo "
						<tr>
							<td colspan='6'>
								<span>Data Masih Kosong</span>  &nbsp;&nbsp;<a class='btn btn-primary' href='anggota/add'>Tambah Data</a>
							</td>
						</tr>
					";
				}
			?>
            </tbody>
	</table>
<br /><br />