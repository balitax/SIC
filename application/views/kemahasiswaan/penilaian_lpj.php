<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>kemahasiswaan/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
            <li><a href="<?php echo base_url(); ?>kemahasiswaan/penilaian_lpj">Penilaian LPJ</a></li>
        </ul>
           
<div class="maincontent">
    <div class="maincontentinner">
		<div class="widget">
            <h4 class="widgettitle">Penilaian LPJ</h4>
            <div class="widgetcontent">
                <form class="stdform stdform2" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>kemahasiswaan/v_lpj/nilai">
                    	<input type="hidden" value="<?php echo $kode; ?>" name="kode" />
						<input type="hidden" value="<?php echo $id_ukm; ?>" name="id_ukm" />
						
						<label><b>LPJ Keuangan</b></label><br/>
							<p style="padding-left:100px;">
								<label style="padding-top: 4px;"><b>Nilai Administrasi</b></label>
								<span class="formwrapper">
									<input type="radio" name="administrasi" value=<?php echo $administrasi ?> />Baik &nbsp; &nbsp;
									<input type="radio" name="administrasi" value=<?php echo 50/100 * $administrasi  ?>/>Sedang &nbsp; &nbsp;
									<input type="radio" name="administrasi" value=<?php echo 10/100 * $administrasi  ?> />Kurang
								</span>
							</p>
							<p style="padding-left:100px;">
								<label style="padding-top: 4px;"><b>Nilai Keuangan</b></label>
								<span class="formwrapper">
									<input type="radio" name="keuangan" value=<?php echo $keuangan ?> />Baik &nbsp; &nbsp;
									<input type="radio" name="keuangan" value=<?php echo 50/100 * $keuangan ?>/>Sedang &nbsp; &nbsp;
									<input type="radio" name="keuangan" value=<?php echo 10/100 * $keuangan ?> />Kurang
								</span>
							</p><br/>
							
							<label><b>LPJ Kegiatan</b></label><br/>
							<p style="padding-left:100px;">
								<label style="padding-top: 4px;"><b>Pendahuluan</b></label>
								<span class="formwrapper">
									<input type="radio" name="pendahuluan" value=<?php echo $pendahuluan ?>  />Baik &nbsp; &nbsp;
									<input type="radio" name="pendahuluan" value=<?php echo 50/100 * $pendahuluan ?>/>Sedang &nbsp; &nbsp;
									<input type="radio" name="pendahuluan" value=<?php echo 10/100 * $pendahuluan ?>/>Kurang
								</span>
							</p>
							<p style="padding-left:100px;">
								<label style="padding-top: 4px;"><b>Nilai Lembar Pengesahan</b></label>
								<span class="formwrapper">
									<input type="radio" name="pengesahan" value=<?php echo $pengesahan ?>  />Baik &nbsp; &nbsp;
									<input type="radio" name="pengesahan" value=<?php echo 50/100 * $pengesahan ?> />Sedang &nbsp; &nbsp;
									<input type="radio" name="pengesahan" value=<?php echo 10/100 * $pengesahan ?> />Kurang
								</span>
							</p>
							<p style="padding-left:100px;">
								<label style="padding-top: 4px;"><b>Struktur Kepanitiaan</b></label>
								<span class="formwrapper">
									<input type="radio" name="struktur" value=<?php echo $kepanitiaan ?>/>Baik &nbsp; &nbsp;
									<input type="radio" name="struktur" value=<?php echo 50/100 * $kepanitiaan ?> />Sedang &nbsp; &nbsp;
									<input type="radio" name="struktur" value=<?php echo 10/100 * $kepanitiaan ?> />Kurang
								</span>
							</p>
							<p style="padding-left:100px;">
								<label style="padding-top: 4px;"><b>Job Diskripsi</b></label>
								<span style="padding-right:50px" class="formwrapper">
									<input type="radio" name="job" value=<?php echo $job ?> />Baik &nbsp; &nbsp;
									<input type="radio" name="job" value=<?php echo 50/100 * $job ?> />Sedang &nbsp; &nbsp;
									<input type="radio" name="job" value=<?php echo 10/100 * $job ?> />Kurang
								</span>
							</p>
							<p style="padding-left:100px;">
								<label style="padding-top: 4px;"><b>Hasil Pelaksanaan</b></label>
								<span class="formwrapper">
									<input type="radio" name="pelaksanaan" value=<?php echo $pelaksanaan ?> />Baik &nbsp; &nbsp;
									<input type="radio" name="pelaksanaan" value=<?php echo 50/100 * $pelaksanaan ?> />Sedang &nbsp; &nbsp;
									<input type="radio" name="pelaksanaan" value=<?php echo 10/100 * $pelaksanaan ?> />Kurang
								</span>
							</p>
							<p style="padding-left:100px;">
								<label style="padding-top: 4px;"><b>Penutup</b></label>
								<span class="formwrapper">
									<input type="radio" name="penutup" value=<?php echo $penutup ?> />Baik &nbsp; &nbsp;
									<input type="radio" name="penutup" value=<?php echo 50/100 * $penutup ?> />Sedang &nbsp; &nbsp;
									<input type="radio" name="penutup" value=<?php echo 10/100 * $penutup ?> />Kurang
								</span>
							</p>
							<p style="padding-left:100px;">
								<label style="padding-top: 4px;"><b>Lampiran</b></label>
								<span style="padding-right:50px" class="formwrapper">
									<input type="radio" name="lampiran" value=<?php echo $lampiran ?> />Baik &nbsp; &nbsp;
									<input type="radio" name="lampiran" value=<?php echo 50/100 * $lampiran ?> />Sedang &nbsp; &nbsp;
									<input type="radio" name="lampiran" value=<?php echo 10/100 * $lampiran ?> />Kurang
								</span>
							</p><br/><br/>

						
						<p class="stdformbutton">
							<button class="btn btn-primary">Simpan</button>&nbsp;&nbsp;
							<a class="btn btn-primary" href="<?php echo base_url(); ?>kemahasiswaan/tabel_lpj">Batal</a>
						</p>
                </form>
            </div><!--widgetcontent-->
            </div><!--widget-->   
			