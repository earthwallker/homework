<?php

/*  set ord state */
include("../mysql/carsql.php");
include_once("../../funs.php");


$id = !empty($_REQUEST['id'])? intval($_REQUEST['id']) : 0;
$type = !empty($_REQUEST['type'])? $_REQUEST['type'] : 0;
$msg= !empty($_REQUEST['msg'])?$_REQUEST['msg'] : "";

//file_put_contents("debug1.txt", "$msg $type",FILE_APPEND);

//放入历史菜单
if(strcmp($msg,"history")==0 AND strcmp($type,"user")==0)
{
	$title="订单操作";
	$url="carindex.php?ischecked=-1";
    $openid=$_SESSION['openid'];
	if(carUserSetOrdHistory($id,$openid))
	{
		$content="订单已设置为历史订单。";
		$url="carindex.php?ischecked=-1";
	}
	else
	{
		
		$content="设置为历史订单失败。";
		$url="carindex.php?ischecked=1";
	}
	file_put_contents("debug.txt", ":".time()."user history",FILE_APPEND);
}

//取消订单
if(strcmp($msg,"cancel")==0 AND strcmp($type,"user")==0)
{
	$title="订单操作";
	$url="carindex.php?ischecked=-1";

	if(carUserSetOrdHistory($id))
	{
		$content="订单已设置为历史订单。";
		$url="carindex.php?ischecked=-1";
	}
	else
	{
		
		$content="设置为历史订单失败。";
		$url="carindex.php?ischecked=1";
	}

}

//-----------------------department-------------------------

if(strcmp($msg,"nopass")==0 AND strcmp($type,"dpt")==0)
{
	$title="订单操作";
	$url="";
    $dptcheck=$_SESSION['name'];
	if(carSetOrdState($id,3,$dptcheck))
	{
		$content="订单修改成功。";
		$url="carindex2.php?ischecked=-1";
	}
	else
	{
		
		$content="订单修改失败。";
		$url="carindex2.php?ischecked=1";
	}
	// file_put_contents("debug.txt", ":".time()."dpt nopass",FILE_APPEND);
}

if(strcmp($msg,"pass")==0 AND strcmp($type,"dpt")==0)
{
	
	$url="carindex2.php?ischecked=-1";
	$dptcheck=$_SESSION['name'];
	if(carSetOrdState($id,2,$dptcheck))
	{
		$title="部门审批通过";
		$content="订单已批准。";
		$url="carindex2.php?ischecked=-1";
	}
	else
	{
		$title="部门审批不通过";
		$content="订单批准失败，请联系管理员。";
		$url="carindex2.php?ischecked=1";
	}
	// file_put_contents("debug2.txt", ":".time()."dpt pass",FILE_APPEND);
}

if(strcmp($msg,"history")==0 AND strcmp($type,"dpt")==0)
{
	$title="订单操作";
	$url="ordcheck.php?ischecked=-1";
    $dptcheck=$_SESSION['name'];
	if(carDptSetOrdStateHistory($id,$dptcheck))
	{
		$content="订单设置成功。";
		$url="carindex2.php?ischecked=-1";
	}
	else
	{
		
		$content="订单设置失败，请联系管理员。";
		$url="carindex2.php?ischecked=1";
	}
	// file_put_contents("debug.txt", ":".time()."dpt history",FILE_APPEND);
}

//-----------------------------------------
if(strcmp($msg,"history")==0 AND strcmp($type,"com")==0)
{
	$title="订单操作";
	$url="carindex4.php?ischecked=-1";
    $leadercheck=$_SESSION['name'];
	if(comAddCarOrdToHistory($id,$leadercheck))
	{
		$content="订单设置成功。";
		$url="carindex4.php?ischecked=-1";
	}
	else
	{
		
		$content="订单设置失败，请联系管理员。";
		$url="carindex4.php?ischecked=1";
	}
	// file_put_contents("debug.txt", ":".time()."com history",FILE_APPEND);
}

if(strcmp($msg,"pass")==0 AND strcmp($type,"com")==0)
{
	$title="订单操作";
	$url="carindex4.php?ischecked=-1";
	$leadercheck=$_SESSION['name'];
	if(comSetCarOrdState($id,4,$leadercheck))
	{
		$content="订单已批准。";
		$url="carindex4.php?ischecked=-1";
	}
	else
	{
		$content="订单批准失败，请联系管理员。";
		$url="carindex4.php?ischecked=1";
	}
	// file_put_contents("debug.txt", ":".time()."com pass");
}

if(strcmp($msg,"nopass")==0 AND strcmp($type,"com")==0)
{
	$title="订单操作";
	$url="carindex4.php?ischecked=-1";
	$leadercheck=$_SESSION['name'];
	if(comSetCarOrdState($id,5,$leadercheck))
	{
		$content="订单已批准。";
		$url="carindex4.php?ischecked=-1";
	}
	else
	{
		$content="订单批准失败，请联系管理员。";
		$url="carindex4.php?ischecked=1";
	}
	// file_put_contents("debug.txt", ":".time()."com nopass");
}
//---------------------车队领导批准 发送微信通知---------------------------


if(strcmp($msg,"pass")==0 AND strcmp($type,"fleet")==0)
{
	$title="订单操作";
	$url="carindex6.php?ischecked=-1";
	$leadercheck=$_SESSION['name'];
	if(fleetSetCarOrdPass($id))
	{
		$ret=carSelect($id);
		sdMsgFtPassOrd($ret);
		$content="订单已批准。";
		$url="carindex6.php?ischecked=-1";
	}
	else
	{
		$content="订单批准失败，请联系管理员。";
		$url="carindex6.php?ischecked=1";
	}
	// file_put_contents("debug.txt", ":".time()."fleet pass");
}

if(strcmp($msg,"history")==0 AND strcmp($type,"fleet")==0)
{
	$title="订单操作";
	$url="carindex6.php?ischecked=-1";
    $leadercheck=$_SESSION['name'];
	if(fleetAddCarOrdToHistory($id))
	{
		$content="订单设置成功。";
		$url="carindex6.php?ischecked=-1";
	}
	else
	{
		
		$content="订单设置失败，请联系管理员。";
		$url="carindex6.php?ischecked=1";
	}
	// file_put_contents("debug.txt", ":".time()."fleet history");
}

// if(carOrderDptSet($id,$value) == true)
// {
//     //die
// }
// else
// {
    
// }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="../css/jquery.mobile-1.4.5.min.css">
	<link rel="shortcut icon" href="../favicon.ico">
	<script src="../js/jquery.js"></script>
	<script src="../js/jquery.mobile-1.4.5.min.js"></script>

</head>
<body>

<div data-role="page" id="testpage" data-theme="a" data-dialog="true">

	<div data-role="header">
		<h1><?php echo $title?></h1>
		<a href="" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-icon-back ui-btn-icon-left ui-btn-icon-notext">Back</a>
	</div>
	<!-- -->

	<div class="ui-content" data-role="main">
	    <h3><?php echo $content?></h3>
        <p>操作日期：<?php echo  date('Y-m-d H:i:s', time()); ?></p>
	</div><!-- main end -->

	<div data-role="footer" data-position="fixed">
		<div data-role="navbar">
			<ul>
				<li><a href="<?php echo $url?>"  data-icon="comment" class="ui-btn-active ui-state-persist">确定</a></li>
			</ul>
		</div>
		<h4 style="display:none;">Footer</h4>
	</div>
</div><!-- /page end -->
</body>
</html>