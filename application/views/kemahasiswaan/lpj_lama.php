<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>kemahasiswaan/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
            <li><a href="<?php echo base_url(); ?>kemahasiswaan/verifikasi_proposal">Proposal</a></li>
        </ul>
        
<div class="maincontent">
    <div class="maincontentinner">
	<a href="<?php echo base_url(); ?>kemahasiswaan/print_lpj_lama" class="btn btn-primary btn-lg" target="_blank">PRINT TABEL</a>
	<br />
	<h4 class="widgettitle">Daftar LPJ UKM Lama / Telah Di Setujui</h4>
	<table id="dyntable" class="table table-bordered">
            <thead>
                <tr>
					<th class="head1">No.</th>
                    <th class="head1">Judul LPJ</th>
                    <th class="head0">UKM</th>
                    <th class="head0">Berkas</th>
                    <th class="head0">Tahun</th>
                </tr>
            </thead>
            <tbody>
			<?php
			$no = 1;
				foreach($lpj as $l){
					?>
					<tr class="gradeX">
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $l['nama_lpj'] ?></td>
                    <td><?php echo $l['nama'] ?></td>
                    <td><a target="_blank" href="<?php echo base_url(); ?>assets/proposal/<?php echo $l['berkas'] ?>"><?php echo $l['berkas'] ?></a></td>
					<td><?php echo $l['tahun'] ?></td>
                </tr>
					<?php
				}
			?>
            </tbody>
	</table>
	<br />
	<br />
	<span>* Daftar Berkas Proposal Yang <b>Sudah</b> Di Verifikasi Akan Muncul Pada Tabel Di Atas</span><br />
	<span>* Pengajuan Proposal Yang Telah Di <b>Tolak</b> Tidak Akan Muncul Pada Tabel Di Atas</span><br />
<br /><br />