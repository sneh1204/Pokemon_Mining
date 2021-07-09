<?php if ( ! defined('BASE')) exit('No direct script access allowed');
//if(!isset($_SESSION['loggedin'])){   redirect(BASE . "?notloggedin=true"); }
?>
<html>

<?php include_once "head.php"; ?>

<body>

<section id="container">

<?php include_once "header.php"; ?>
<?php include_once "sidebar.php"; ?>

<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="panel-body">
				<div class="col-md-12 w3ls-graph">
					<!--agileinfo-grap-->
						<div class="agileinfo-grap">
							<div class="agileits-box">
								<header class="agileits-box-header clearfix">
									<h3>Pokebot Reverse Image Search</h3>
								</header>
							</div>
						</div>
					
				</div>
			</div>
		</div>
		<div class="row">
			<div class="panel-body">
				<div class="col-md-12 w3ls-graph">
					<form action="<?=CTRL?>Pokebot.php" method="post" class="form-inline">
					<label for"pokebot"/>Enter URL of the image here:</label>
					<input class="form-control" id="pokebot" name="pokeboturl" type="text" autocomplete="off" placeholder="Enter/Paste Image URL" size="35"/>
					<input class="form-control" type="submit" value="Search"/>
					</form>
					<?php
						if(isset($_POST['output'])){
							if(strtolower($_POST['output']) == 'error')	echo "URL not found";
							elseif(strtolower($_POST['output']) == 'pokemon not found')	echo "Pokemon wasn't found, please contact @Infernus#9511 on Discord";
							else{
								$_SESSION['last'] = $_POST['output'];
								echo '<h4><u>Result:</u></h4><br><b>Pokemon Name:</b> ' . $_POST['output'] . '<br><b>Total searches till now:</b> '.$_POST['visits'];
								echo '<br><br><img style="width:150px; height:150px;" src="'.$_POST['pokeboturl'].'"/>';
							}
						}
					?>
				</div>
			</div>
		</div>
		<div class="clearfix"> </div>
</section>

</section>
<!--main content end-->
</section>
<?php include_once "scripts.php"; ?>
<!-- morris JavaScript -->	
<script>
$("#pagetitle").html("Pokebot | Reverse Image");
$(".nav-collapse li a").removeClass("active");
$(".nav-collapse li a").eq(1).addClass("active");
</script>
<?php include_once "footer.php"; ?>	
</body>
</html>