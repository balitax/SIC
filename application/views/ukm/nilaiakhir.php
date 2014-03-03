<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php echo $title; ?></title>
<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/back/images/uin.png" />
<style type="text/css">
html, body, div, span, object, iframe,
 h4, h5, h6, p, blockquote, pre,
abbr, address, cite, code,
del, dfn, em, img, ins, kbd, q, samp,
small, strong, sub, sup, var,
b, i,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td {
	margin:0;
	padding:0;
	border:0;
	outline:0;
	font-size:100%;
	vertical-align:baseline;
	background:transparent;
}
body {
	margin:0;
	padding:0;
	font:12px/15px "Helvetica Neue",Arial, Helvetica, sans-serif;
	color: #555;
	background:#f5f5f5;
}
a {color:#666;}
#content {width:65%; max-width:690px; margin:6% auto 0;}
/*
Pretty Table Styling
CSS Tricks also has a nice writeup: http://css-tricks.com/feature-table-design/
*/
table {
	overflow:hidden;
	border:1px solid #d3d3d3;
	background:#fefefe;
	width:90%;
	margin:2% auto 0;
	-moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
	-webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
}
th, td {padding:18px 28px 18px; text-align:center; }
th {padding-top:2px; text-shadow: 1px 1px 1px #fff; background:#e8eaeb;}
td {border-top:1px solid #e0e0e0; border-right:1px solid #e0e0e0;}
tr.odd-row td {background:#f6f6f6;}
td.first, th.first {text-align:left}
td.last {border-right:none;}
/*
Background gradients are completely unnecessary but a neat effect.
*/
td {
	background: -moz-linear-gradient(100% 25% 90deg, #fefefe, #f9f9f9);
	background: -webkit-gradient(linear, 0% 0%, 0% 25%, from(#f9f9f9), to(#fefefe));
}
tr.odd-row td {
	background: -moz-linear-gradient(100% 25% 90deg, #f6f6f6, #f1f1f1);
	background: -webkit-gradient(linear, 0% 0%, 0% 25%, from(#f1f1f1), to(#f6f6f6));
}
th {
	background: -moz-linear-gradient(100% 20% 90deg, #e8eaeb, #ededed);
	background: -webkit-gradient(linear, 0% 0%, 0% 20%, from(#ededed), to(#e8eaeb));
}
tr:first-child th.first {
	-moz-border-radius-topleft:5px;
	-webkit-border-top-left-radius:5px; /* Saf3-4 */
}
tr:first-child th.last {
	-moz-border-radius-topright:5px;
	-webkit-border-top-right-radius:5px; /* Saf3-4 */
}
tr:last-child td.first {
	-moz-border-radius-bottomleft:5px;
	-webkit-border-bottom-left-radius:5px; /* Saf3-4 */
}
tr:last-child td.last {
	-moz-border-radius-bottomright:5px;
	-webkit-border-bottom-right-radius:5px; /* Saf3-4 */
}
.maincontent{
	margin-bottom: 50px;
	margin-top: 20px;
}
</style>
</head>

<body bgcolor="#FFF">
<div class="maincontent">
	<div class="maincontentinner">
			<center>
			<img src="http://localhost/elektabilitas/assets/home/img/uin.png" />
			<br />
			<h3>LAPORAN ELEKTABILITAS UKM UIN MAULANA MALIK BRAHIM MALANG</h3>
			<h5>Jalan Gajayana No. 50 Malang Telp: +62 341 551354</h5>
			<h5>homepage : uin-malang.ac.id - email : info@uin-malang.ac.id</h5>
			
			</center>
			<br />
			<br />
			
			<center><h4>TABEL LAPORAN NILAI ELEKTABILITAS UKM PERIODE <?=date('Y') ?></h4></center>
	<table cellspacing="0">
    	<tr>
			<th>NO.</th>
			<th>NAMA UKM</th>
			<th>POINT ELEKTABILITAS</th>
		</tr>
		
		<?php
			$no = 1;
			foreach($elekta as $a){
				?>
			<tr>
				<td><?=$no++ ?></td>
				<td><?=$a['nama'] ?></td>
				<td><?=$a['point'] ?></td>
			</tr>
				<?php
			}
		?>
		
    </table>
	<br />
	<br />
	<br />
	<center>
	<h3>GRAFIK ELEKTABILITAS UKM PERIODE <?=date('Y') ?></h3>
	<br />
	
	<?=$graph; ?>
	
	</center>
	
	</div>
	<br />
	<br />
	<br />
	<center><b>&copy; UIN MALANG <?=date('Y') ?></b></center>
</div>
</body>
</html>
