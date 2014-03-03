<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php echo $title; ?></title>
<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/back/images//uin.png" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/back/css/style.default.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/back/css/responsive-tables.css">

<script type="text/javascript" src="<?php echo base_url(); ?>assets/back/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/back/js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/back/js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/back/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/back/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/back/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/back/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/back/js/modernizr.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/back/js/responsive-tables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/back/js/custom.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        // dynamic table
        jQuery('#dyntable').dataTable({
            "sPaginationType": "full_numbers",
            "aaSortingFixed": [[0,'asc']],
            "fnDrawCallback": function(oSettings) {
                jQuery.uniform.update();
            }
        });
        
        jQuery('#dyntable2').dataTable( {
            "bScrollInfinite": true,
            "bScrollCollapse": true,
            "sScrollY": "300px"
        });
        
    });
</script>

</head>
<body>
<div class="mainwrapper">
    <div class="header">
        <div class="logo">
			<img src="<?php echo base_url(); ?>assets/back/images/logos.png" />
        </div>
        <div class="headerinner">
            <ul class="headmenu">
                <li class="right">
                    <div class="userloggedinfo">
					<a href="<?php echo base_url(); ?>admin/setting">
						<img src="<?php echo base_url(); ?>assets/foto_user/<?php echo $foto; ?>"
						title="Setting Profil" />
					</a>
                        <div class="userinfo">
                            <h4>Hy !  <b><?php echo $nama; ?></b></h4>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="leftpanel">
        <div class="leftmenu">        
            <ul class="nav nav-tabs nav-stacked">
            	<li class="nav-header">Menu Navigation</li>
                <li class="active"><a href="<?php echo base_url(); ?>admin/dashboard">
				<span class="iconfa-laptop"></span> Dashboard</a></li>
                <li><a href="<?php echo base_url(); ?>admin/users"><span class="iconfa-user"></span>Managemen User</a></li>
                <li><a href="<?php echo base_url(); ?>admin/points"><span class="iconfa-star"></span>Managemen Point</a></li>
				<li><a href="<?php echo base_url(); ?>admin/bobot"><span class="iconfa-star"></span>Bobot </a></li>
                <li><a href="<?php echo base_url(); ?>admin/setting"><span class="iconfa-wrench"></span>Profil</a></li>
                <li><a href="<?php echo base_url(); ?>admin/periode"><span class="iconfa-wrench"></span>Setting Periode</a></li>
                <li><a href="<?php echo base_url(); ?>admin/logout"><span class="iconfa-off"></span>Logout</a></li>
            </ul>
        </div>
    </div>