<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo  $title ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="refresh" content="5;<?php  echo $url ?>">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/back/css/style.default.css" type="text/css" />
</head>
<body>
<div class="mainwrapper">
        <div class="maincontent">
            <div class="maincontentinner">
                    <div class="span8" style="padding-left: 165px;padding-top: 180px;">
                        <div class="widgetbox">
                            <h4 class="widgettitle"><?php echo $judul ?><a class="close">&times;</a> <a class="minimize">&#8211;</a></h4>
                            <div class="widgetcontent">
                               <center> <?php echo $isi; ?></center>
                            </div>
                        </div>
                    </div><!--span6-->      
            </div><!--maincontentinner-->
        </div><!--maincontent-->
</div><!--mainwrapper-->
</body>
</html>
