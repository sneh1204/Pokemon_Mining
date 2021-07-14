<?php if ( ! defined('BASE')) exit('No direct script access allowed');
//if(!isset($_SESSION['loggedin'])){   redirect(BASE . "?notloggedin=true"); }
include_once "../pokemon/simple_html_dom.php";
?>
<?php
    if(!isset($_GET["offset"])) $offset = 1;
    else    $offset = $_GET["offset"];
    $i = ($offset-1)*3;
    $pages = ceil($totcount / 10);
    $newpages = ($pages - ($offset*3));
?>
<html>
<?php include_once "head.php"; ?>
<body>
<section id="container">
<?php include_once "header.php"; ?>
<?php include_once "sidebar.php"; ?>
<section id="main-content">
	<section class="wrapper">
        <div class="col-md-12">
        <table width="100%" border="2px" style="position: relative;table-layout: fixed;">
        <tr>
        <th style="display:block;text-align:center;height:60px;padding-top:15px;"><h3>Pokemon Search</h3></th>
        </tr>
        </table>
        </div>
        <div class="clearfix"> </div>
        <br>
        <div class="col-md-12">
            <div class="notifications">
                <header class="panel-heading">
					Search Results for: '<b><?=$searchid?></b>'
                </header>
                <div class="notify-w3ls">
                    <table style="width:100%">
                    <?php
                    if($newpages > -3){
                        if(!empty($values)){
                            echo "- Showing <b>" . $totcount . "</b> results for '<b>$searchid</b>':";
                            foreach($values as $id => $data){
                                $search_keyword = str_replace(' ', '+', $data['Name']);
                                $newhtml = file_get_html("https://www.google.com/search?q=" . $search_keyword . "&tbm=isch");
                                $result_image_source = $newhtml->find('img', 1)->src;
                                echo '<tr data-href="' . BASE . 'pokemon/pokemon.php?pid=' . str_replace(' ', '_', $data['Name']) . '" class="clickable-row" id="search_row" style="width:100%; height:110px;"><td style="width:100px;"><a href="' . BASE . 'pokemon/pokemon.php?pid=' . str_replace(' ', '_', $data['Name']) . '"><img style="padding-left: 10px; height: 90px; width: 90px;" src="' . $result_image_source . '"/></a></td><td style="padding-top:7px;vertical-align:top;"><a id="search_link" style="display: flex;" href="' . BASE . 'pokemon/pokemon.php?pid=' . str_replace(' ', '_', $data['Name']) . '"><h4>' . $data['Name'] . '</h4></a>' . PHP_EOL . '<p style="font-size: 13px;">Total: <strong>' . $data['Total'] . '</strong></p>' . PHP_EOL . '<p style="font-size: 13px;">Type: <strong>' . $data['Type 1'] . '</strong></p>' . PHP_EOL . '<p style="font-size: 13px;">Generation: <strong>' . $data['Generation'] . '</strong></p>' . PHP_EOL . '<p style="font-size: 13px;">Legendary: <strong>' . $data['Legendary'] . '</strong></td></tr>';
                            }
                        }else{
                            echo "Your search showed up no results.";
                        }
                    }else{
                        echo "Wrong link.";
                    }
                    ?>
                    </table>
                    <ul class="pagination pagination-lg">
                        <?php if($offset != 1){ ?><li><a href="<?=CTRL?>Ctrl_search.php/?p_search=<?=$searchid?>&pageid=<?=$i-2?>&offset=<?=$offset-1?>"><i class="fa fa-angle-left">«</i></a></li><?php } ?>
                        <?php if($newpages > -3){ ?><li <?php if($pageid == ++$i) echo 'class="active"'?>><a href="<?=CTRL?>Ctrl_search.php/?p_search=<?=$searchid?>&pageid=<?=$i?>&offset=<?=$offset?>"><?=$i?></a></li><?php } ?>
                        <?php if($newpages > -2){ ?><li <?php if($pageid == ++$i) echo 'class="active"'?>><a href="<?=CTRL?>Ctrl_search.php/?p_search=<?=$searchid?>&pageid=<?=$i?>&offset=<?=$offset?>"><?=$i?></a></li><?php } ?>
                        <?php if($newpages > -1){ ?><li <?php if($pageid == ++$i) echo 'class="active"'?>><a href="<?=CTRL?>Ctrl_search.php/?p_search=<?=$searchid?>&pageid=<?=$i?>&offset=<?=$offset?>"><?=$i?></a></li><?php } ?>
                        <?php if($newpages > 0){ ?><li><a href="<?=CTRL?>Ctrl_search.php/?p_search=<?=$searchid?>&pageid=<?=$i+1?>&offset=<?=$offset+1?>"><i class="fa fa-angle-right">»</i></a></li><?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</section>
</section>
<?php include_once "scripts.php"; ?>
<script>
$("#pagetitle").html("Pokemon | Search");
$(".nav-collapse li a").removeClass("active");
$(".nav-collapse li a").eq(0).addClass("active");
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
</script>
<?php include_once "footer.php"; ?>
</body>
</html>