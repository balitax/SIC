<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>kemahasiswaan/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
            <li><a href="<?php echo base_url(); ?>kemahasiswaan/verifikasi_proposal">Proposal</a></li>
        </ul>
        
<div class="maincontent">
    <div class="maincontentinner">
	<h4 class="widgettitle">Hal Verifikasi Berkas Proposal UKM</h4>
	<table id="dyntable" class="table table-bordered">
            <thead>
                <tr>
					<th class="head1">No.</th>
                    <th class="head1">Judul Proposal</th>
                    <th class="head0">UKM</th>
                    <th class="head0">Berkas</th>
                    <th class="head0">Aksi</th>
                </tr>
            </thead>
            <tbody>
			<?php
			$no = 1;
				foreach($propo as $p){
					?>
					<tr class="gradeX">
					<td><?php echo $no++ ?></td>
                    <td><?php echo $p['judul'] ?></td>
                    <td><?php echo $p['nama'] ?></td>
                    <td><a target="_blank" href="<?php echo base_url(); ?>assets/proposal/<?php echo $p['berkas'] ?>"><?php echo $p['berkas'] ?></a></td>
                     <td>
						<a title="Edit Data" href="<?php echo base_url() ?>kemahasiswaan/v_proposal/edit/<?php echo $p['id_proposal']  ?>" class="iconsweets-create"></a>
					</td>
                </tr>
					<?php
				}
			?>
            </tbody>
	</table>
	<br />
	<br />
	<span>* Daftar Berkas Proposal Yang Belum Di Verifikasi Akan Muncul Pada Tabel Di Atas</span><br />
	<span>* Pengajuan Proposal Yang Telah <b>Di Terima</b> atau <b>Di Tolak</b> Tidak Akan Muncul Pada Tabel Di Atas</span><br />
	<span>* <b>Klik Aksi Edit Untuk Memverifikasi Pengajuan Proposal</b></span><br />
<br /><br />