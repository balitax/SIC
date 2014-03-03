<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>ukm/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
            <li><a href="<?php echo base_url(); ?>ukm/proposal">Proposal</a></li>
        </ul>
        
<div class="maincontent">
    <div class="maincontentinner">
	<a class="btn btn-primary" href="<?php echo base_url(); ?>ukm/proposal/tambah" >Tambah Proposal</a>
	<a class="btn btn-primary" href="<?php echo base_url(); ?>ukm/proposal/print" target="_blank" >PRINT TABEL</a>
	
	<br />
	<br />
	<h4 class="widgettitle">Data Proposal</h4>
	<table id="dyntable" class="table table-bordered">
            <thead>
                <tr>
                    <th class="head1">Judul Proposal</th>
                    <th class="head0">Tanggal Mulai</th>
                    <th class="head1">Tanggal Selesai</th>
                    <th class="head0">Status</th>
                    <th class="head0">Aksi</th>
                </tr>
            </thead>
            <tbody>
			
			<?php
			$no = 1;
				foreach($tampil as $r){
					?>
					<tr class="gradeX">
                    <td><?php echo $r['judul'] ?></td>
                    <td><?php echo $r['tanggal_mulai'] ?></td>
                    <td><?php echo $r['tanggal_selesai'] ?></td>
					<td><?php echo $r['status'] ?></td>
                     <td>
						<a title="Edit Data" href="proposal/edit/<?php echo $r['id_proposal']  ?>" class="iconsweets-create"></a> - 
						<a title="Hapus Data" href="proposal/del/<?php echo $r['id_proposal']  ?>"
						onclick="return confirm('Apakah anda yakin akan menghapus data ini ?');" class="iconsweets-trashcan"></a>
					</td>
                </tr>
					<?php
				}
			?>
            </tbody>
	</table>
<br /><br />