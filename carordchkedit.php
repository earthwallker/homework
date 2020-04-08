<?php

/*  */
include("../mysql/carsql.php");
$id = !empty($_REQUEST['id'])? intval($_REQUEST['id']) : 0;
echo $id;
$fullname = !empty($_REQUEST['fullname'])? $_REQUEST['fullname'] : "";
$ordertime = !empty($_REQUEST['ordertime'])? $_REQUEST['ordertime'] : "";
$taskname = !empty($_REQUEST['taskname'])? $_REQUEST['taskname'] : "";
$orderstate = !empty($_REQUEST['orderstate'])? $_REQUEST['orderstate'] : "";
echo $orderstate;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Demo</title>
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
		<h1>订单审核</h1>
		<a href="" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-icon-back ui-btn-icon-left ui-btn-icon-notext">Back</a>
	</div>
	<!-- /************************************************header -->

	<div class="ui-content" role="main">
	<h3>申请人：<?php echo $fullname?></h3>
      <p>申请日期：<?php echo $ordertime?></p>
      <p>任务名称：<?php echo $taskname?></p>
	  <p>提示：<?php echo  $orderstate==6?"订单删除后，将无法恢复。":"订单取消后，可以重新下单。" ?></p>
	</div>

<!-- /****************************************************content -->
	<div data-role="footer" data-position="fixed">
		<div data-role="navbar">
			<ul>
                <li><a data-ajax="false" href="carorderset.php?id=<?php echo $id ?>&value=3"  data-icon="comment">不批准</a></li>
				<li><a data-ajax="false" href="carorderset.php?id=<?php echo $id ?>&value=2" data-icon="check"  class="ui-btn-active ui-state-persist">批准</a></li>
			</ul>
		</div>
		<h4 style="display:none;">Footer</h4>
	</div>
</div><!-- /page end -->
</body>
</html>