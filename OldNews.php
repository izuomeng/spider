<script type="text/javascript">
    function IsPC() {
        var userAgentInfo = navigator.userAgent;
        var Agents = ["Android", "iPhone",
            "SymbianOS", "Windows Phone",
            "iPad", "iPod"];
        for (var v = 0; v < Agents.length; v++) {
            if (userAgentInfo.indexOf(Agents[v]) > 0) {
                <!--添加跳转页面window.location.href=;-->
                window.location.href = "OldNews-mobile.php";
                break;
            }
        }
    }
    IsPC();
    var do_sth = 'done';
</script>
<?php
    for($i=1;$i<=10;$i++)
    {
?>
        <div style="width:100%; margin-bottom: 20px;">
 	<form id="_form<?php echo $i?>"action="ShowOldNews.php" method="post">
        <div style="background-color: orange; height:40px; padding-top:15px; width:50%; text-align:center;  padding:auto; margin-bottom:20px; margin:auto; font-size: 20px; line-height: 20px;"
onclick="document.getElementById('_form<?php echo $i?>').submit();">
           
            <input type="hidden" name="day" id="d<?php echo $i?>">
            <input type="hidden" name="month" id="m<?php echo $i?>">
            <input type="hidden" name="year" id="y<?php echo $i?>">
            <a id="Date<?php echo $i?>" onclick="document.getElementById('_form<?php echo $i?>').submit();" ></a>
            
        </div>
	</form>
        </div>
<?php
    }
?>
<script type="text/javascript">
    var myDate = new Date();
    myDate.toLocaleDateString();
    myDate=new Date(myDate-24*60*60*1000);
    for(var i=1;i<=10;i++)
    {
        document.getElementById("Date"+i).innerHTML =""+myDate.getFullYear()+"年"+(myDate.getMonth()+1)+"月"+myDate.getDate()+"日";
        document.getElementById("d"+i).value=myDate.getDate();
        document.getElementById("m"+i).value=myDate.getMonth()+1;
        document.getElementById("y"+i).value=myDate.getFullYear();
        myDate=new Date(myDate-24*60*60*1000);
    }

</script>
add new feature named A