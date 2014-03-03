<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>ukm/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
            <li><a href="<?php echo base_url(); ?>ukm/alur/berkas">Alur Berkas</a></li>
        </ul>
        
<div class="maincontent">
    <div class="maincontentinner">
	<a href="<?php echo base_url(); ?>ukm/alur/berkas/print" target="_blank" class="btn btn-primary">PRINT TABEL</a>
	<br />
	<h4 class="widgettitle">Data Alur Berkas</h4>
	<table id="dyntable" class="table table-bordered">
            <thead>
                <tr>
                    <th class="head1">No</th>
                    <th class="head0">Nama Kegiatan</th>
                    <th class="head1">Proposal</th>
                    <th class="head1">LPJ</th>
                </tr>
            </thead>
            <tbody>
			<?php
			$no = 1;
				foreach($alur as $a){
					?>
			<tr class="gradeX">
                <td><?php echo $no++; ?></td>
                <td><?php echo $a['judul_kegiatan'] ?></td>
                <?php if(($alur[0]['b_prp']) == null){ $propo = 'Belum'; ?>
				<td><?php echo $propo ?></td>
				<?php }
				else {
					$propo = 'Ada'; ?>
				 <td><a target="_blank" href="<?php echo base_url();?>assets/proposal/<?php echo $a['b_prp'] ?>"><?php echo $propo ?></a></td>
				<?php } 
				if(($alur[0]['b_lpj']) == null){ $lpj = 'Belum'; ?>
				<td><?php echo $lpj ?></td>
				<?php }else {$lpj = 'Ada'; ?>
				<td><a target="_blank" href="<?php echo base_url(); ?>assets/lpj/<?php echo $a['b_lpj'] ?>"><?php echo $lpj ?></a></td>
				<?php } ?>
				</tr>
					<?php
				}
			?>
            </tbody>
	</table>
<br /><br />