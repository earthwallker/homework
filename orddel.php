<?php

include("../lock.php");
/* MessageBox */
include("../mysql/carsql.php");
$id = !empty($_REQUEST['id'])? intval($_REQUEST['id']) : 0;
$state = !empty($_REQUEST['state'])? intval($_REQUEST['state']) : 0;
$ischecked = !empty($_REQUEST['ischecked '])? intval($_REQUEST['ischecked ']) : 0;

if($ischecked==1)
{
	//已审核列表点击调用
	$btime=carOrdSelect($id,"btime");
	$now=date('Y-m-d', time());
	$date1 = date_create($btime); 
	$date2 = date_create($now); 
	$interval = date_diff($date1, $date2); 
	$dfday=$interval->format('%r%a');
	if($dfday >= 0)
	{
		$msg="出发日期提前一天才能取消订单。";
	}
	else
	{
		if(carOrderDel($id) == -1)
		{
			$msg="订单取消失败，请联系管理员。";
		}
		else
		{
			$msg="订单取消成功。";
		}
	}
}
else
{
	//待审核列表点击调用?ischecked=0
	$openid = $_SESSION['openid'];
	if(carOrderDel($id,$openid) == -1)
	{
		$msg="订单取消失败，请联系管理员。";
	}
	else
	{
		$msg="订单取消成功。";
	}
}

//exit;

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Del</title>
	<link rel="stylesheet" href="../css/jquery.mobile-1.4.5.min.css">
	<link rel="shortcut icon" href="../favicon.ico">
	<script src="../js/jquery.js"></script>
	<script src="../js/jquery.mobile-1.4.5.min.js"></script>

</head>
<body>

<div data-role="page" id="testpage" data-theme="a" data-dialog="true">

	<div data-role="header">
		<h1>订单操作</h1>
		<a href="carindex.php" class="ui-btn ui-corner-all ui-shadow ui-icon-back ui-btn-icon-left ui-btn-icon-notext">Back</a>
	</div>
	<!-- -->

	<div class="ui-content" data-role="main">
	    <h2><?php echo $msg ?></h2>
        <p>操作日期：<?php echo  date('Y-m-d H:i:s', time()); ?></p>
	</div><!-- main end -->

	<div data-role="footer" data-position="fixed">
		<div data-role="navbar">
			<ul>
				<li><a href="carindex.php"  data-icon="comment" class="ui-btn-active ui-state-persist">确定</a></li>
			</ul>
		</div>
		<h4 style="display:none;">Footer</h4>
	</div>
</div><!-- /page end -->
</body>
</html>