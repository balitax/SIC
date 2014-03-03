<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>kemahasiswaan/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
            <li><a href="<?php echo base_url(); ?>kemahasiswaan/verifikasi_lpj">LPJ</a></li>
        </ul>
        
<div class="maincontent">
    <div class="maincontentinner">
	<h4 class="widgettitle">Hal Hasil Verifikasi Berkas LPJ UKM</h4>
	<table id="dyntable" class="table table-bordered">
            <thead>
                <tr>
					<th class="head1">No.</th>
                    <th class="head1">Judul LPJ</th>
                    <th class="head0">UKM</th>
                    <th class="head0">Berkas</th>
                    <th class="head0">Aksi</th>
                </tr>
            </thead>
            <tbody>
			<?php
			$no = 1;
				foreach($lpj as $r){
					?>
					<tr class="gradeX">
					<td><?php echo $no++ ?></td>
                    <td><?php echo $r['nama_lpj'] ?></td>
                    <td><?php echo $r['nama'] ?></td>
                    <td><a target="_blank" href="<?php echo base_url(); ?>assets/lpj/<?php echo $r['berkas'] ?>"><?php echo $r['berkas'] ?></a></td>
                     <td>
						<a title="Penilaian LPJ" href="<?php echo base_url() ?>kemahasiswaan/penilaian_lpj/<?php echo $r['id_lpj']  ?>" class="iconsweets-create"></a>
					</td>
                </tr>
					<?php
				}
			?>
            </tbody>
	</table>
	<br />
	<br />
	<span>* Daftar Berkas LPJ Yang Belum Di Verifikasi Akan Muncul Pada Tabel Di Atas</span><br />
	<span>* Pengajuan LPJ Yang Telah <b>Di Terima</b> atau <b>Di Tolak</b> Tidak Akan Muncul Pada Tabel Di Atas</span><br />
	<span>* <b>Klik Aksi Edit Untuk Memverifikasi Pengajuan LPJ</b></span><br />
<br /><br />