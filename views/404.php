<?php if ( ! defined('BASE')) exit('No direct script access allowed'); ?>
<html>
<!DOCTYPE html>
<head>
<title>404 | Error</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?=DIST?>css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="<?=DIST?>css/style.css" rel='stylesheet' type='text/css' />
<link href="<?=DIST?>css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="<?=DIST?>css/font.css" type="text/css"/>
<link href="<?=DIST?>css/font-awesome.css" rel="stylesheet"> 
<script src="<?=PLUG?>jQuery/jQuery-2.1.4.min.js"></script>
</head>
<body>
<!--main content start-->
<div class="eror-w3">
	<div class="agile-info">
		<h3>Error!</h3>
		<h2>404</h2>
		<p><?php if(isset($_SESSION['error'])){	echo $_SESSION['error']; unset($_SESSION['error']); } else { echo "Internal Error";	}?></p>
		<a href="<?=BASE?>">Go Home</a>
	</div>
</div>
<script src="<?=DIST?>js/bootstrap.js"></script>
<script src="<?=DIST?>js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?=DIST?>js/scripts.js"></script>
<script src="<?=DIST?>js/jquery.slimscroll.js"></script>
<script src="<?=DIST?>js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="<?=DIST?>js/jquery.scrollTo.js"></script>
<script>
$(".nav-collapse li a").removeClass("active");
</script>
<?php include_once "footer.php"; ?>
</body>
</html>