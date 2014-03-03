
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <title>Sistem Informasi Elektabilitas UKM Universitas Islam Negeri Malang</title>
<link href="<?php echo base_url(); ?>assets/home/css/style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/home/img/uin.png" />

  </head>
  <body>
  <div class="wrapper">
  <div class="google-header-bar">
  <div class="header content clearfix">
      <img class="logo" src="<?php echo base_url(); ?>assets/home/img/uin.png" alt="UIN"><br/><br/>
      <h1 style="font-size: 15px;margin-top: -15px;margin-left: 109px;">Universitas Islam Negeri (UIN) </h1>
	  <h1 style="font-size: 15px;margin-top: -10px;margin-left: 109px;">Maulana Malik Ibrahim Malang</h1>
	  <h1 style="font-size: 15px;margin-top: -10px;margin-left: 109px;">Jalan Gajayana No. 50 Malang</h1>
	  <h1 style="font-size: 15px;margin-top: -10px;margin-left: 109px;">Telp: +62 341 551354</h1>
  </div>
  </div>
  <div class="main content clearfix">
  <div class="sign-in">


<form class="box login" action="<?php echo base_url(); ?>login/auth" method="post">
    <fieldset class="boxBody">
		<label>Username</label>
		<input type="text" name="username" tabindex="1" placeholder="Username" required="required"/>
		<label>Password</label>
		<input type="password" tabindex="2" name="password" placeholder="Password" required="required"/>
		<label>Level</label>
		<select name="level" tabindex="3">
			<option>-- Silahkan Pilih Level--</option>
			<option value="ukm">UKM</option>
			<option value="kemahasiswaan">Kemahasiswaan</option>
			<option value="admin">Administrator</option>
		</select>
    </fieldset>
    <footer>
      <input type="submit" class="btnLogin" value="Masuk" tabindex="4"/>
    </footer>
</form>


  </div>

  <div class="product-info ">
<div class="product-headers">
  <h1 class="redtext">Sistem Informasi Elektabilitas UKM</h1>
  <br />
  <br />
</div>
      <p></p>

<ul class="features clearfix">
  <li>
      <img src="<?php echo base_url(); ?>assets/home/img/act.png" width="48px" height="48px" alt="">
  <p class="title">Data Kegiatan UKM</p>
  <p>Informasi kegiatan seluruh ukm di UIN Maliki Malang.</p>
  </li>
  <li>
  <img src="<?php echo base_url(); ?>assets/home/img/pres.png"  width="48px" height="48px" alt="">
  <p class="title">Prestasi UKM</p>
  <p>Informasi prestasi UKM dalam lingkup antar kampus, daerah, nasional dan internasional.</p>
  </li>
  <li>
  <img src="<?php echo base_url(); ?>assets/home/img/elekta.png" width="48px" height="48px" alt="">
  <p class="title">Nilai Elektabilitas UKM</p>
  <p>Informasi Elektabilitas UKM tiap periode dan grafik peningkatan point elektabilitas.</p>
  </li>
</ul>

  <br/>
<p>
    
</p>
  </div>
  <div id="cc_iframe_parent">

      
  </div>
  </div>

  <center>
    <div class="google-footer-bar">
    <div class="footer content clearfix">
    <ul>
        <li>© 2013 Universitas Islam Negeri Maulana Malik Ibrahim Malang</li> | &nbsp;&nbsp;&nbsp;
        <li><a href="http://siakad.uin-malang.ac.id" target="_blank">Siakad UIN Malang</a></li> | &nbsp;&nbsp;&nbsp;
        <li><a href="http://informatika.uin-malang.ac.id/" target="_blank">Informatika UIN</a></li> | &nbsp;&nbsp;&nbsp;
        <li><a href="http://kemahasiswaan.uin-malang.ac.id/" target="_blank">Kemahasiswaan UIN</a></li> | &nbsp;&nbsp;&nbsp;
        <li><a href="https://www.facebook.com/infoUINmaliki" target="_blank">UIN On Facebook</a></li> | &nbsp;&nbsp;&nbsp;
        <li><a href="https://twitter.com/UINMaliki" target="_blank">UIN On Twitter</a></li> | &nbsp;&nbsp;&nbsp;
        <li><a href="http://www.uin-malang.ac.id/" target="_blank">Portal UIN</a></li>
    </ul>
    </div>
    </div>
    </center>

  </div>
  </body>
</html>
