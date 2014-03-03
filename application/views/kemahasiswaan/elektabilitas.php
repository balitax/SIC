<div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo base_url(); ?>kemahasiswaan/dashboard"><i class="iconfa-home"></i></a>
			<span class="separator"></span></li>
            <li><a href="<?php echo base_url(); ?>kemahasiswaan/elektabilitas">elektabilitas</a></li>
        </ul>
        
<div class="maincontent">
    <div class="maincontentinner">
	<h4 class="widgettitle">Tabel Elektabilitas UKM </h4>
	<table id="dyntable" class="table table-bordered">
            <thead>
                <tr>
                    <th class="head1">No.</th>
                    <th class="head1">Nama UKM</th>
                    <th class="head1">Points Elektabilitas</th>
                    <th class="head1">Tahun</th>
                </tr>
            </thead>
            <tbody>
			<?php
			$no = 1;
				foreach($hasil as $r){
					?>
					<tr class="gradeX">
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $r['nama']; ?></td>
                    <td><?php echo $r['point']; ?></td>
					<td><?php echo $r['tahun']; ?></td>
                </tr>
					<?php
				}
			?>
            </tbody>
	</table>
<!--	<?php  
		foreach($tabil as $t){ ?>
		<p><b>UKM = <?php echo $t['nama'] ?></b></p>
		<p>Nilai Total LPJ = <?php echo $t['total_lpj'] ?></p>
		<p>Telat 				 = <?php echo $t['telat'] ?> hari </p>	</br>
		 if(<?php echo $t['telat'] ?> <= <?php echo $t['p_hari'] ?>){</br>
			  $nilai<?php  $persen ?> = <?php echo $t['p_points'] ?>;</br>
			 $hasil<?php $hasil ?>  	   = <?php echo $t['total_lpj'];  ?> -  (<?php echo $t['total_lpj'] ?>*<?php echo $t['p_points']?>% );</br>
			} 
			else  if(<?php echo $t['telat'] ?> <= <?php echo $t['k_hari'] ?>){</br>
				 $nilai<?php  $persen ?> = <?php echo $t['k_points'] ?>;</br>
				$hasil<?php $hasil ?>  	   = <?php echo $t['total_lpj'];  ?> -  (<?php echo $t['total_lpj'] ?>*<?php echo $t['k_points']?>% );</br>
			}
			else  if(<?php echo $t['telat'] ?> > <?php echo $t['ke_hari'] ?>){</br>
				 $nilai<?php  $persen ?> = <?php echo $t['ke_points'] ?>;</br>
				$hasil<?php $hasil ?>  	   = <?php echo $t['total_lpj'];  ?> -  (<?php echo $t['total_lpj'] ?>*<?php echo $t['ke_points']?>% );</br>
			}</br></br>
			HASIL    =<?php echo $t['jumlah'] ?></br></br>
			
	<?php } ?>
		<b>UKM KOMMUST</b></br>
		Hitung Nilai LPJ = Jumlah Points / jumlah lpj + (10% * jumlah lpj * jumlah Points) - 10 </br>
		Hitung Nilai LPJ =<?php echo $rata ?> / <?php echo $jumlah ?> + (10% x <?php echo $jumlah ?> x <?php echo $rata ?> ) - 10 <br />
		<?php $lpj_k = $rata/$jumlah + (10/100 * $jumlah*($rata/$jumlah))-10 ?>
		Hitung Nilai LPJ = <?php echo $lpj_k ?></br>
		Total Point Prestasi = <?php echo $prestasi ?>
		</br>
		<b>RUMUS PERHITUNGAN POINT</b>
		<br />
		<pre>
			$pointkamp  	= $this->db->query("select count(tingkat) as kampus from
			 prestasi where tingkat = 'kampus' 
			and id_ukm =2")->result_array();
			$pointdaerah  	= $this->db->query("select count(tingkat) as daerah  from
			 prestasi where tingkat = 'daerah'
			and id_ukm =2")->result_array();
			$pointnasio  	= $this->db->query("select count(tingkat) as nasional from
			 prestasi where tingkat = 'nasional'
			and id_ukm =2")->result_array();
			
			$pointkampus 	= $pointkamp[0]['kampus'];
			$pointdaerah 	= $pointdaerah[0]['daerah'];
			$pointnasional 	= $pointnasio[0]['nasional'];
			
			if($pointkampus == 1){
				$kampus = 1;
			}
			else if($pointkampus == 2){
				$kampus = 2;
			}
			else if($pointkampus == 3){
				$kampus = 3;
			}
			else if($pointkampus == 4){
				$kampus = 4;
			}
			else if($pointkampus == 5){
				$kampus = 5;
			}
			else if($pointkampus > 5){
				$kampus = 5;
			}
			else {
				$kampus = 0;
			}
			
			
			if($pointdaerah == 1){
				$daerah = 5;
			}
			else if($pointdaerah == 2){
				$daerah = 10;
			}
			else if($pointdaerah > 2){
				$daerah = 10;
			}
			else {
				$daerah = 0;
			}
			
			if($pointnasional == 1){
				$nasional = 10;
			}
			else if($pointnasional == 2){
				$nasional = 20;
			}
			else if($pointnasional > 2){
				$nasional = 20;
			}
			else {
				$nasional= 0;
			}
			
			$total1 = $kampus + $daerah + $nasional;
		</pre>
		</br></br>
		<hr />
		<hr />
		<b>UKM MAPALA</b></br>
		Hitung Nilai LPJ = Jumlah Points / jumlah lpj + (10% * jumlah lpj * jumlah Points) - 10 </br>
		Hitung Nilai LPJ =<?php echo $rata2 ?> / <?php echo $jumlah2 ?> + (10% x <?php echo $jumlah2 ?> x <?php echo $rata2 ?> ) - 10 </br>
		<?php $lpj_m = $rata2/$jumlah2 + (10/100 * $jumlah2*($rata2/$jumlah2))-10 ?>
		Hitung Nilai LPJ = <?php echo $lpj_m ?></br>
		Total Point Prestasi = <?php echo $prestasi2 ?>
		<br />
		<b>RUMUS PERHITUNGAN POINT</b>
		<br />
		<pre>
			$pointkamp2  	= $this->db->query("select count(tingkat) as kampus from 
			prestasi where tingkat = 'kampus' 
			and id_ukm =3")->result_array();
			$pointdaerah2  	= $this->db->query("select count(tingkat) as daerah  from 
			prestasi where tingkat = 'daerah'
			and id_ukm =3")->result_array();
			$pointnasio2  	= $this->db->query("select count(tingkat) as nasional from
			 prestasi where tingkat = 'nasional'
			and id_ukm =3")->result_array();
			
			$pointkampus2 	= $pointkamp2[0]['kampus'];
			$pointdaerah2 	= $pointdaerah2[0]['daerah'];
			$pointnasional2 = $pointnasio2[0]['nasional'];
			
			if($pointkampus2 == 1){
				$kampus2 = 1;
			}
			else if($pointkampus2 == 2){
				$kampus2 = 2;
			}
			else if($pointkampus2 == 3){
				$kampus2 = 3;
			}
			else if($pointkampus2 == 4){
				$kampus2 = 4;
			}
			else if($pointkampus2 == 5){
				$kampus2 = 5;
			}
			else if($pointkampus2 > 5){
				$kampus2 = 5;
			}
			else {
				$kampus2 = 0;
			}
			
			
			if($pointdaerah2 == 1){
				$daerah2 = 5;
			}
			else if($pointdaerah2 == 2){
				$daerah2 = 10;
			}
			else if($pointdaerah2 > 2){
				$daerah2 = 10;
			}
			else {
				$daerah2 = 0;
			}
			
			if($pointnasional2 == 1){
				$nasional2 = 10;
			}
			else if($pointnasional2 == 2){
				$nasional2 = 20;
			}
			else if($pointnasional2 > 2){
				$nasional2 = 20;
			}
			else {
				$nasional2 = 0;
			}
			
			$total2 = $kampus2 + $daerah2 + $nasional2;
		</pre>
		<?php $hasilfix =  $rata2 / $jumlah2 + (10/100 * $jumlah2 * $rata2) - 10; ?>
		Hitung Nilai LPJ  = <?php echo $hasilfix ?>
		</br></br>
		<b>PERHITUNGAN ANGGOTA</b></br>
		Jumlah Anggota UKM KOMMUST = <?php echo $anggota ?> Orang</br>
		if (<?php echo $anggota ?> >= 30) {</br>
				Nilai = <?php echo $bobot ?>; </br>
			} else if (<?php echo $anggota ?> > 15) {</br>
				Nilai  = 50% x <?php echo $bobot ?>; </br>
			} else if (<?php echo $anggota ?> <= 15) {</br>
				Nilai = 1</br>
			}else if (<?php echo $anggota ?> <= 5) {</br>
				Nilai = 0</br>
			}
			<?php if ($anggota >= 30) {
				$na = $bobot;
			} else if ($anggota >15) {
				$na = 50/100 * $bobot;
			} else if ($anggota <= 15){
				$na = 1;
			}else if ($anggota <= 5){
				$na = 0;
			} ?> </br>
		NILAI ANGGOTA UKM KOMMUST = <?php echo$na ?> </br> </br>
		
		<b>PERHITUNGAN ANGGOTA</b></br>
		Jumlah Anggota UKM MAPALA = <?php echo $anggota2 ?> Orang</br>
		if (<?php echo $anggota2 ?> >= 30) {</br>
				Nilai = <?php echo $bobot ?>; </br>
			} else if (<?php echo $anggota2 ?> > 15) {</br>
				Nilai  = 50% x <?php echo $bobot ?>; </br>
			} else if (<?php echo $anggota2 ?> <= 15) {</br>
				Nilai = 1</br>
			}else if (<?php echo $anggota2 ?> <= 5) {</br>
				Nilai = 0</br>
			}
			<?php if ($anggota2 >= 30) {
				$na2 = $bobot;
			} else if ($anggota2 >15) {
				$na2 = 50/100 * $bobot;
			} else if ($anggota2 <= 15){
				$na2 = 1;
			}else if ($anggota2 <= 5){
				$na2 = 0;
			} ?> </br>
		NILAI ANGGOTA UKM MAPALA = <?php echo$na2 ?> </br></br>
		
		<b>NILAI ELEKTABILITAS UKM KOMMUST </b></br>
			ELEKTABILITAS = NILAI LPJ + NILAI PRESTASI + NILAI ANGGOTA</br>
			<?php $elektabilitas = $lpj_k + $na +  $prestasi ?>
			ELEKTABILITAS = <?php echo $lpj_k ?> + <?php echo $na ?> + <?php echo $prestasi ?>	</br>
			ELEKTABILITAS = <?php echo $elektabilitas ?> </br>
			
		<b>NILAI ELEKTABILITAS UKM MAPALA </b></br>
			ELEKTABILITAS = NILAI LPJ + NILAI PRESTASI + NILAI ANGGOTA</br>
			<?php $elektabilitasb = $lpj_m  + $na2 +  $prestasi2 ?>
			ELEKTABILITAS = <?php echo $lpj_m  ?> + <?php echo $na2 ?> + <?php echo $prestasi2 ?> </br>
			ELEKTABILITAS = <?php echo $elektabilitasb ?> </br>
	-->
	<br/>
	<br/>
<br /><br />