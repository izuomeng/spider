<div style="width: 100%; text-align: center; height: 50px; font-size: 40px; line-height: 50px; font-weight: 400; margin:40px 0px;">
    历史新闻
</div>
<?php
for($i=1;$i<=10;$i++)
{
    ?>
        <form id="_form<?php echo $i?>"action="mobileShowOldnews.php" method="post">
            <div style="background-color: orange; height:60px; padding-top:15px; width:100%; text-align:center;  padding:auto; margin-bottom:20px; font-size:40px; line-height:40px;"
                 onclick="document.getElementById('_form<?php echo $i?>').submit();">
                <input type="hidden" name="day" id="d<?php echo $i?>">
                <input type="hidden" name="month" id="m<?php echo $i?>">
                <input type="hidden" name="year" id="y<?php echo $i?>">
                <a id="Date<?php echo $i?>" onclick="document.getElementById('_form<?php echo $i?>').submit();" ></a>

            </div>
        </form>
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