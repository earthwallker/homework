<?php
include("../lock.php");
include("./config.php");
include("../mysql/carsql.php");

$ischecked = !empty($_REQUEST['ischecked'])? intval($_REQUEST['ischecked']) : 0;
$_SESSION['actor']=1;
$_SESSION['openid']="";

// if(isset($_SESSION['actor']))
// {
// 		echo "数据错误，请联系管理员解决。";
// 	exit; 
// }

function switch_index()
{
	if($_SESSION['actor']==constant("LEADERDPT")||$_SESSION['actor']==constant("LEADERCOM"))
	{
		echo "<script>location='./carindex2.php'</script>";
		exit; 
	}

	if($_SESSION['actor']==constant("LEADERTEAM"))
	{
		echo "<script>location='./carindex4.php'</script>";
		exit; 
	}

	if($_SESSION['priority']==constant("DRIVER"))
	{
		echo "<script>location='./carindex6.php'</script>";
		exit; 
	}
}

switch_index();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>车辆预定</title>
	<link rel="stylesheet" href="../css/jquery.mobile-1.4.5.min.css">
	<link rel="shortcut icon" href="../favicon.ico">
	<script src="../js/jquery.js"></script>
	<script src="../js/jquery.mobile-1.4.5.min.js"></script>
	
	<script>
		$( document ).on( "pagecreate", function() {


		});
	</script>
</head>
<body>



<div data-role="page" id="testpage" data-theme="a">
	<!-- header begin-->
	<div data-role="header">
		<h1>
			<?php


			function print_title($chk)
			{
				if($chk == 0)
				{
					echo "正在审核中的订单";

				}
				if($chk == 1)
				{
					echo "审核通过的订单";

				}
				if($chk == -1)
				{
					echo "历史订单";

				}
			}

			print_title($ischecked);
		?>
		</h1>
		<a href="../main.php" class="ui-btn ui-corner-all ui-shadow ui-icon-back ui-btn-icon-left ui-btn-icon-notext">Back</a>
		<div data-role="navbar">
			<ul>
				<li><a href="../main.php" class="ui-btn ui-corner-all ui-shadow">返回首页</a></li>
				<li><a href="carindex.php" class="ui-btn-active ui-state-persist">订单列表</a></li>
				<li><a href="javascript:location.href='carsubmit.php'" data-transition="slideup" >车辆预定</a></li>
            <?php
            	function print_toolbar()
            	{

            	}
            ?>
			</ul>
		</div>

	</div>
	<!-- header end-->


	<div class="ui-content" data-role="main">
	<?php

		if($_SESSION['actor']==constant("USER"))
		{
			if($ischecked == 0)
			{
				echo "待处理的订单：";
				$openid=$_SESSION['openid'];
				carUserIsChecking($openid);
			}
			if($ischecked == 1)
			{
				echo "正在处理的订单：";
				$openid=$_SESSION['openid'];	
				carUserIsChecked($openid);
			}
			if($ischecked == -1)
			{
				echo "历史订单：";
				$openid=$_SESSION['openid'];	
				carUserOrdHistory($openid);
			}
		}

		
	?>
	</div>

<!-- content end-->

	<div data-role="footer" data-position="fixed">
		<div data-role="navbar">
			<ul>
				<?php
				if($_SESSION['actor']==constant("USER"))
				{
					echo "<li><a data-ajax='false' data-transition='slide' href='carindex.php?ischecked=1' data-icon='check'>审核通过</a></li>";
					echo "<li><a data-ajax='false' data-transition='slide' href='carindex.php?ischecked=0'  data-icon='comment'>审核中...</a></li>";
					echo "<li><a data-ajax='false' data-transition='slide' href='carindex.php?ischecked=-1' data-icon='search'>历史订单</a></li>";
				}
				?>				
			</ul>
		</div>
		<h4 style="display:none;">Footer</h4>
	</div>
<!-- footer end-->
</div><!-- /page end -->

<!---------------------------------------页面分割----------------------------------------------------->

</body>
</html>
