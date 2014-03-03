<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
            <li><a href="<?php echo base_url(); ?>admin/points">Manajemen Points</a></li>
        </ul>
        
<div class="maincontent">
    <div class="maincontentinner">
		<div class="tabbable tabs-below">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#A">LPJ</a></li>
				<li><a data-toggle="tab" href="#B">Prestasi</a></li>
				<li><a data-toggle="tab" href="#C">Kegiatan Rutin</a></li>
				<li><a data-toggle="tab" href="#D">Anggota</a></li>
			</ul>
			<div class="tab-content">
				<div id="A" class="tab-pane active">
					<div class="tabs-left">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#lA">LPJ Keuangan</a></li>
                                <li><a data-toggle="tab" href="#lB">LPJ Kegiatan</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="lA" class="tab-pane active">
                                    <div class="widget">
										<h4 class="widgettitle">Form LPJ</h4>
										<div class="widgetcontent">
											<form class="stdform" method="post" action="<?php echo base_url(); ?>admin/points/tambah_p1"> 
													<p>
														<label>Point Administrasi</label>
														<span class="field"><input type="text" name="administrasi" class="input-medium" <?php if(!empty($lpj_ad)) { ?> value="<?php echo $lpj_ad; ?>" <?php } else { ?> placeholder="point administrasi" <?php } ?> /></span>
													</p>
													<p>
														<label>Point Keuangan</label>
														<span class="field"><input type="text" name="keuangan" class="input-medium" <?php if(!empty($lpj_ku)) { ?> value="<?php echo $lpj_ku; ?>" <?php } else { ?> placeholder="point keuangan" <?php } ?> /></span>
													</p>
													<p class="stdformbutton">
														<button class="btn btn-primary">Simpan</button>
														<button type="reset" class="btn">Reset</button>
													</p>
											</form>
										</div>
									</div>
								</div>
								<div id="lB" class="tab-pane">
										<div class="widget">
										<h4 class="widgettitle">Form LPJ</h4>
										<div class="widgetcontent">
											<form class="stdform" method="post" action="<?php echo base_url(); ?>admin/points/tambah_p2">
													<p>
														<label>Point Lembar Pengesahan</label>
														<span class="field"><input type="text" name="pengesahan" class="input-medium" <?php if(!empty($lpj_pe)) { ?> value="<?php echo $lpj_pe; ?>" <?php } else { ?> placeholder="point lembar pengesahan" <?php } ?> /></span>
													</p>
													<p>
														<label>Point Pendahuluan</label>
														<span class="field"><input type="text" name="pendahuluan" class="input-medium" <?php if(!empty($lpj_pen)) { ?> value="<?php echo $lpj_pen; ?>" <?php } else { ?> placeholder="point pendahuluan" <?php } ?>/></span>
													</p>
													<p>
														<label>Point Struktur Kepanitiaan</label>
														<span class="field"><input type="text" name="struktur" class="input-medium" <?php if(!empty($lpj_str)) { ?> value="<?php echo $lpj_str; ?>" <?php } else { ?>placeholder="point lembar struktur kepanitiaan" <?php } ?>/></span>
													</p>
													<p>
														<label>Point Job Diskripsi</label>
														<span class="field"><input type="text" name="job" class="input-medium" <?php if(!empty($lpj_job)) { ?> value="<?php echo $lpj_job; ?>" <?php } else { ?>placeholder="point job diskripsi" <?php } ?> /></span>
													</p>
													<p>
														<label>Point Hasil Pelaksanaan</label>
														<span class="field"><input type="text" name="hasil" class="input-medium" <?php if(!empty($lpj_hsl)) { ?> value="<?php echo $lpj_hsl; ?>" <?php } else { ?> placeholder="point hasil pelaksanaan"<?php } ?> /></span>
													</p>
													<p>
														<label>Point Penutup</label>
														<span class="field"><input type="text" name="penutup" class="input-medium" <?php if(!empty($lpj_pnp)) { ?> value="<?php echo $lpj_pnp; ?>" <?php } else { ?> placeholder="point penutup" <?php } ?> /></span>
													</p>
													<p>
														<label>Point Lampiran</label>
														<span class="field"><input type="text" name="lampiran" class="input-medium" <?php if(!empty($lpj_lmp)) { ?> value="<?php echo $lpj_lmp; ?>" <?php } else { ?> placeholder="point lampiran" <?php } ?>/></span>
													</p>
													<p class="stdformbutton">
														<button class="btn btn-primary">Simpan</button>
														<button type="reset" class="btn">Reset</button>
													</p>
											</form>
										</div>
										</div>
									</div>
                            </div><!--tab-content-->
                        </div><!--tabs-left-->
				</div>
				<div id="B" class="tab-pane">
					<div class="widget">
						<h4 class="widgettitle">Form Prestasi</h4>
						<div class="widgetcontent">
							<form class="stdform" method="post" action="<?php echo base_url(); ?>admin/points/tambah_p3">
									<p>
										<label>Point Prestasi Antar Kampus</label>
										<span class="field"><input type="text" name="antar_kampus" class="input-medium" <?php if(!empty($pres_kmp)) { ?> value="<?php echo $pres_kmp; ?>" <?php } else { ?> placeholder="point antar kampus" <?php } ?>/></span>
									</p>
									<p>
										<label>Point Prestasi Tingkat Provinsi</label>
										<span class="field"><input type="text" name="provinsi" class="input-medium" <?php if(!empty($pres_pvs)) { ?> value="<?php echo $pres_pvs; ?>" <?php } else { ?> placeholder="point antar kampus" <?php } ?>/></span>
									</p>
									<p>
										<label>Point Prestasi Tingkat Nasional</label>
										<span class="field"><input type="text" name="nasional" class="input-medium" <?php if(!empty($pres_nsl)) { ?> value="<?php echo $pres_nsl; ?>" <?php } else { ?>placeholder="point tingkat nasional" <?php } ?>/></span>
									</p>
									<p class="stdformbutton">
										<button class="btn btn-primary">Simpan</button>
										<button type="reset" class="btn">Reset</button>
									</p>
							</form>
						</div>
					</div>
				</div>
				<div id="C" class="tab-pane">
					<div class="widget">
						<h4 class="widgettitle">Form Kegiatan Rutin</h4>
						<div class="widgetcontent">
							<form class="stdform" method="post" action="<?php echo base_url(); ?>admin/points/tambah_p4">
									<p>
										<label>Point Kegiatan Rutin </label>
										<span class="field"><input type="text" name="rutin" class="input-medium" <?php if(!empty($rutin)) { ?> value="<?php echo $rutin; ?>" <?php } else { ?> placeholder="point kegiatan rutin"<?php } ?> /></span>
									</p>
									<p class="stdformbutton">
										<button class="btn btn-primary">Simpan</button>
										<button type="reset" class="btn">Reset</button>
									</p>
							</form>
						</div>
					</div>
				</div>
				<div id="D" class="tab-pane">
					<div class="widget">
						<h4 class="widgettitle">Form Anggota</h4>
						<div class="widgetcontent">
							<form class="stdform" method="post" action="<?php echo base_url(); ?>admin/points/tambah_p5">
									<p>
										<label>Point Anggota</label>
										<span class="field"><input type="text" name="anggota" class="input-medium" <?php if(!empty($anggota)) { ?> value="<?php echo $anggota; ?>" <?php } else { ?> placeholder="point anggota" <?php } ?>/></span>
									</p>
									<p class="stdformbutton">
										<button class="btn btn-primary">Simpan</button>
										<button type="reset" class="btn">Reset</button>
									</p>
							</form>
						</div>
					</div>
				</div>
			</div>
        </div>