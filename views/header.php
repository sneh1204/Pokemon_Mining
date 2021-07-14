<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="<?=BASE?>" class="logo">
        POKEMON
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <strong style="position: relative; top: 5px;">Search Pokemon:</strong> 
        </li>
        <li>
            <div id="search_div">
                <form action="<?=CTRL?>Ctrl_search.php" method="get">
                    <input id="p_search" name="p_search" type="text" autocomplete="off" class="form-control" placeholder="Search" size="35" aria-label="Search"/>
                    <table style="background-color: #F1F2F7;border-radius: 8px;position: absolute; width: 190px;table-layout: fixed;" id="searchdrop"></table>
                </form>
            </div>
        </li>
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<script>
    $("#p_search").keyup(function() {
        var searchid = $(this).val();
        if(searchid != ''){
            $.ajax({
                type: "POST",
                url: "<?=HELP?>Functions.php",
                data: {
                    search: searchid
                },
                cache: false,
                success: function (result) {
                    if (result != 0) {
                        var output = $.parseJSON(result); // output[0].Name
                        var html = "";
                        for (var index = 0; index < output.length; index++) {
                            var tmp = output[index].Name;
                            html = html + "<tr><td id='search_td' style='height: 45px;text-decoration:none;display:block;width: 190px; padding-top: 10px; padding-left: 8px;'><a href='<?=BASE?>pokemon/pokemon.php?pid=" + tmp.replace(new RegExp(' ', 'g'), '_') + "' id='searchme' style='display: flex;text-decoration: none;'>" + searchid + "<b>" + output[index].Name.substr(searchid.length) + "</b></a></td></tr>";
                        }
                        $("#searchdrop").html(html);
                    }
                }
            });
        }
    });
    $(document).mouseup(function (e) {
        var container = $("#search_div");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            $("#searchdrop").html("");
        }
    });
</script>
<!--header end-->