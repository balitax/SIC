<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>kemahasiswaan/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
            <li><a href="<?php echo base_url(); ?>kemahasiswaan/verifikasi_proposal">Proposal</a></li>
        </ul>

<div class="maincontent">
    <div class="maincontentinner">
	<a href="<?php echo base_url(); ?>kemahasiswaan/print_proposal_lama" class="btn btn-primary btn-lg" target="_blank">
		PRINT TABEL
	</a>
	<br />
	<h4 class="widgettitle">Daftar Proposal UKM Lama / Telah Di Setujui</h4>
	<table id="dyntable" class="table table-bordered">
            <thead>
                <tr>
                    <th class="head1">No.</th>
                    <th class="head1">Judul Proposal</th>
                    <th class="head0">UKM</th>
                    <th class="head0">Berkas</th>
                    <th class="head0">Tahun</th>
                </tr>
            </thead>
            <tbody>
			<?php
			$no = 1;
				foreach($propol as $p){
					?>
					<tr class="gradeX">
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $p['judul'] ?></td>
                    <td><?php echo $p['nama'] ?></td>
                    <td><a target="_blank" href="<?php echo base_url(); ?>assets/proposal/<?php echo $p['berkas'] ?>"><?php echo $p['berkas'] ?></a></td>
					<td><?php echo $p['tahun'] ?></td>
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