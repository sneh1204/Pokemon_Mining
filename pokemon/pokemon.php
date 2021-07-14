<?php
include_once '../config/constants.php';
include_once '../config/defaults.php';
//if(!isset($_SESSION['loggedin'])){   redirect(BASE . "?notloggedin=true"); }
include_once "../database/Mysql.php";
$db = new Mysql();
if(!$db->isAPokemon($_GET['pid'])){
    $_SESSION['error'] = "That pokemon doesn't exist";
    redirect(CTRL . "Ctrl_error.php");
}else{
    $stats = $db->getPokemonInfo($_GET['pid']);
    $per = $db->getPokemonInfoInPercentage($_GET['pid']);

}   
include_once "simple_html_dom.php";
?>
<html>
<?php include_once "../views/head.php"; ?>
<body>
<section id="container">
<?php include_once "../views/header.php"; ?>
<?php include_once "../views/sidebar.php"; ?>
<section id="main-content">
	<section class="wrapper">
<?php
$search_keyword=str_replace(' ','+',$_GET['pid']);
$newhtml = file_get_html("https://www.google.com/search?q=" . $search_keyword . "&tbm=isch");
$result_image_source = $newhtml->find('img', 1)->src;
?>
<div class="col-md-12">
        <div class="notifications">
                <header class="panel-heading">
					<?=$stats['Name']?> 
                </header>
                <br>
            <!--notification start-->
            <div class="notify-w3ls">
                <table width="100%">
                    <tr>
                        <td rowspan="5">
                            <img style="width: 150px; height: 150px;" src="<?=$result_image_source?>"/>
                        </td>
                        <td style="text-align: right;">
                            <?php echo "Name: </td><td style='text-align: right;'><b>" . $stats["Name"] . "</b>"; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">
                            <?php echo "Type 1: </td><td style='text-align: right;'><b>" . $stats["Type 1"] . "</b>"; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">
                            <?php if($stats['Type 2'] == "") $stats['Type 2'] = "-";  echo "Type 2: </td><td style='text-align: right;'><b>" . $stats["Type 2"] . "</b>"; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">
                            <?php echo "Generation: </td><td style='text-align: right;'><b>" . $stats["Generation"] . "</b>"; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">
                            <?php echo "Legendary: </td><td style='text-align: right;'><b>" . $stats["Legendary"] . "</b>"; ?>
                        </td>
                    </tr>
                </table>
            </div>
				<!--notification end-->
		</div>
</div>
<div class="clearfix"> </div>
<br>
<div class="col-md-12 stats-info widget">
    <div class="stats-info-agileits">
        <div class="stats-title">
            <h4 class="title">Pokemon Stats</h4>
        </div>
        <div class="stats-body">
            <ul class="list-unstyled">
                <li>Total: <span class="pull-right"><?=$per[0]?>%</span>  
                    <div class="progress progress-striped active progress-right">
                        <div class="bar green" style="width:<?=$per[0]?>%;"></div> 
                    </div>
                </li>
                <li>HP: <span class="pull-right"><?=$per[1]?>%</span>  
                    <div class="progress progress-striped active progress-right">
                        <div class="bar yellow" style="width:<?=$per[1]?>%;"></div>
                    </div>
                </li>
                <li>Attack: <span class="pull-right"><?=$per[2]?>%</span>  
                    <div class="progress progress-striped active progress-right">
                        <div class="bar red" style="width:<?=$per[2]?>%;"></div>
                    </div>
                </li>
                <li>Defense: <span class="pull-right"><?=$per[3]?>%</span>  
                    <div class="progress progress-striped active progress-right">
                        <div class="bar blue" style="width:<?=$per[3]?>%;"></div>
                    </div>
                </li>
                <li>Sp. Attack: <span class="pull-right"><?=$per[4]?>%</span>  
                    <div class="progress progress-striped active progress-right">
                        <div class="bar light-blue" style="width:<?=$per[4]?>%;"></div>
                    </div>
                </li>
                <li>Sp. Defense: <span class="pull-right"><?=$per[5]?>%</span>  
                    <div class="progress progress-striped active progress-right">
                        <div class="bar light-blue" style="width:<?=$per[5]?>%;"></div>
                    </div>
                </li>
                <li class="last">Speed: <span class="pull-right"><?=$per[6]?>%</span>  
                    <div class="progress progress-striped active progress-right">
                        <div class="bar orange" style="width:<?=$per[6]?>%;"></div>
                    </div>
                </li> 
            </ul>
        </div>
    </div>
</div>
</section>
</section>
</section>

<?php include_once "../views/scripts.php"; ?>
<script>
$("#pagetitle").html("Pokemon | Details");
$(".nav-collapse li a").removeClass("active");
$(".nav-collapse li a").eq(0).addClass("active");
</script>
<?php include_once "../views/footer.php"; ?>
</body>
</html>