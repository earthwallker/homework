<?php

/* 已经审核的订单，点击调用
   返回首页/放入历史菜单/取消菜单{删除菜单发微信通知；}
*/
include("../mysql/carsql.php");
$id = !empty($_REQUEST['id'])? $_REQUEST['id'] : "";
$fullname = !empty($_REQUEST['fullname'])? $_REQUEST['fullname'] : "";
$ordertime = !empty($_REQUEST['ordertime'])? $_REQUEST['ordertime'] : "";
$taskname = !empty($_REQUEST['taskname'])? $_REQUEST['taskname'] : "";
$orderstate = !empty($_REQUEST['orderstate'])? $_REQUEST['orderstate'] : "";
$isChecked = !empty($_REQUEST['ischecked'])? intval($_REQUEST['ischecked']) : "0";
$btime= !empty($_REQUEST['btime'])?$_REQUEST['btime'] : "";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>msforchecked</title>
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

<div data-role="page" id="testpage" data-theme="a" data-dialog="true">

	<div data-role="header">
		<h1>订单操作</h1>
		<a href="" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-icon-back ui-btn-icon-left ui-btn-icon-notext">Back</a>
	</div>
	<!-- /************************************************header -->

	<div class="ui-content" role="main">
	<h2>申请人：<?php echo $fullname?></h2>
	  <p>下单日期：<?php echo $ordertime?></p>
	  <p>出发日期：<?php echo $btime?></p>
      <p>任务名称：<?php echo $taskname?></p>
	  <p>提示：出发当天不能取消订单，如要取消请电话联系车队，电话：88888。</p>
	</div>

<!-- /****************************************************content -->
	<div data-role="footer" data-position="fixed">
		<div data-role="navbar">
			<ul>
				<li><a href="" data-rel="back" data-icon="check">返回首页</a></li>
				<li><a data-ajax="false"  data-icon="check" href="ordstateset.php?msg=history&type=user&id=<?php echo $id?>">放入历史订单</a></li>
				<li><a data-ajax="false"  data-icon="check" href="orddel.php?ischecked=1&id=<?php echo $id?>">取消订单</a></li>				
			</ul>
		</div>
		<h4 style="display:none;">Footer</h4>
	</div>
</div><!-- /page end -->
</body>
</html>
