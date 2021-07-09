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
		<!-- //market-->
		<div class="market-updates">
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-2">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-eye"> </i>
					</div>
					 <div class="col-md-8 market-update-left">
					 <h4>Pokemons</h4>
					<h3 id="p_count">0</h3>
					<p>Total count</p>
				  </div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-users" ></i>
					</div>
					<div class="col-md-8 market-update-left">
					<h4>Highest HP</h4>
					<h3 id="h_hp">0</h3>
					<p id="p_h_hp"></p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-usd"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Highest Attack</h4>
						<h3 id="h_attack">0</h3>
						<p id="p_h_attack"></p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-4">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Highest Defense</h4>
						<h3 id="h_defense">0</h3>
						<p id="p_h_defense"></p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div>	
		<!-- //market-->
		<div class="row">
			<div class="panel-body">
				<div class="col-md-12 w3ls-graph">
					<!--agileinfo-grap-->
						<div class="agileinfo-grap">
							<div class="agileits-box">
								<header class="agileits-box-header clearfix">
									<h3>Pokemon Statistics</h3>
										<div class="toolbar">
											
											
										</div>
								</header>
								<div class="agileits-box-body clearfix">
									<div id="hero-area"></div>
								</div>
							</div>
						</div>
	<!--//agileinfo-grap-->

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
<script type="text/javascript">
	$("#pagetitle").html("Pokemon | Dashboard");
	$(".nav-collapse li a").removeClass("active");
	$(".nav-collapse li a").eq(0).addClass("active");
    $(document).ready(function(){
        $.ajax({
          url:"<?=HELP . "Functions.php";?>",
          type:"POST",
          data:{
              getPokemonCount: true
          },
          success:function(result){
			 		 if(result != 0){
							$("#p_count").html("<b>"+result+"</b>");
						}
          }
        });
				$.ajax({
          url:"<?=HELP . "Functions.php";?>",
          type:"POST",
          data:{
              getHighestHP: true
          },
          success:function(result){
			 		 if(result != 0){
							var output = $.parseJSON(result);
							$("#h_hp").html("<b>"+output['HP']+"</b>");
							$("#p_h_hp").html("<b>"+output['Name']+"</b>");
						}
          }
        });
				$.ajax({
          url:"<?=HELP . "Functions.php";?>",
          type:"POST",
          data:{
              getHighestAttack: true
          },
          success:function(result){
			 		 if(result != 0){
							var output = $.parseJSON(result);
							$("#h_attack").html("<b>"+output['Attack']+"</b>");
							$("#p_h_attack").html("<b>"+output['Name']+"</b>");
						}
          }
        });
				$.ajax({
          url:"<?=HELP . "Functions.php";?>",
          type:"POST",
          data:{
              getHighestDefense: true
          },
          success:function(result){
			 		 if(result != 0){
							var output = $.parseJSON(result);
							$("#h_defense").html("<b>"+output['Defense']+"</b>");
							$("#p_h_defense").html("<b>"+output['Name']+"</b>");
						}
          }
        });
    });
  </script>
  <?php include_once "footer.php"; ?>	
</body>
</html>