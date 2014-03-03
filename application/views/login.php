<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php echo $title; ?></title>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/back/css/style.default.css" type="text/css" />

<script type="text/javascript" src="<?php echo base_url(); ?>assets/back/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/back/js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/back/js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/back/js/modernizr.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/back/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/back/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/back/js/custom.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#login').submit(function(){
            var u = jQuery('#username').val();
            var p = jQuery('#password').val();
            if(u == '' && p == '') {
                jQuery('.login-alert').fadeIn();
                return false;
            }
        });
    });
</script>
<style>
	select {
		width: 270px;
		height: 40px;
	}
</style>
</head>

<body class="loginpage">

<div class="loginpanel">
    <div class="loginpanelinner">
        <div class="logo animate0 bounceIn"><h2 style="color:#fff;">SI ELEKTABILITAS</h2></div>
        <form id="login" action="<?php echo base_url(); ?>login/auth" method="post">
            <div class="inputwrapper login-alert">
                <div class="alert alert-error">Username / Password Salah</div>
            </div>
            <div class="inputwrapper animate1 bounceIn">
                <input type="text" name="username" id="username" placeholder="Enter any username" />
            </div>
            <div class="inputwrapper animate2 bounceIn">
                <input type="password" name="password" id="password" placeholder="Enter any password" />
            </div>
			
			<div class="inputwrapper animate2 bounceIn">
                <select name="level">
					<option value="0">-- Silahkan Pilih Level --</option>
					<option value="admin">Administor</option>
					<option value="kemahasiswaan">Kemahasiswaan</option>
					<option value="ukm">UKM</option>
				</select>
            </div>
            <div class="inputwrapper animate3 bounceIn">
                <button name="submit">Sign In</button>
            </div>
        </form>
    </div><!--loginpanelinner-->
</div><!--loginpanel-->

<div class="loginfooter">
    <p>&copy; 2013. Hak cipta dilindungi undang-undang.</p>
</div>

</body>
</html>
