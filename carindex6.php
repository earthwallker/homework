<?php
include("../lock.php");
include("../mysql/carsql.php");
$ischeck = !empty($_REQUEST['ischeck'])? intval($_REQUEST['ischeck']) : 0;
$priority = $_SESSION['priority'];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>车辆预定6</title>
	<link rel="stylesheet" href="../css/jquery.mobile-1.4.5.min.css">
	<link rel="shortcut icon" href="../favicon.ico">
	<script src="../js/jquery.js"></script>
	<script src="../js/jquery.mobile-1.4.5.min.js"></script>
	<style>
		.noshadow * {
			-webkit-box-shadow: none !important;
			-moz-box-shadow: none !important;
			box-shadow: none !important;
		}
		form.ui-mini .ui-field-contain fieldset.ui-controlgroup legend small {
			color: #666;
		}

		/* stack all grids below 40em (640px) */
		@media all and (max-width: 10em) {
			.my-breakpoint .ui-block-a,
			.my-breakpoint .ui-block-b,
			.my-breakpoint .ui-block-c,
			.my-breakpoint .ui-block-d,
			.my-breakpoint .ui-block-e {
				width: 100%;
				float: none;
			}
}

	</style>

	<style>
	/* Border styles */

		#table-4 {
		width: 100%;
	    } 

		#table-4 thead, #table-4 tr {
		border-top-width: 1px;
		border-top-style: solid;
		border-top-color: rgb(211, 202, 221);
		}
		#table-4 {
		border-bottom-width: 1px;
		border-bottom-style: solid;
		border-bottom-color: rgb(211, 202, 221);
		}

		/* Padding and font style */
		#table-4 td, #table-4 th {
		padding: 5px 10px;
		font-size: 16px;
		font-family: Verdana;
		color: rgb(95, 74, 121);
		}

		/* Alternating background colors */
		#table-4 tr:nth-child(even) {
		background: rgb(223, 216, 232)
		}
		#table-4 tr:nth-child(odd) {
		background: #FFF
		}

	/* Table Head */
	    #col1 {
	    	width: 30%;
	    }
	    #table-5 {
		width: 100%;
	    }

		#table-5 thead th {
		background-color: rgb(156, 186, 95);
		color: #fff;
		border-bottom-width: 0;
		}

		/* Column Style */
		#table-5 td {
		color: #000;
		}
		/* Heading and Column Style */
		#table-5 tr, #table-5 th {
		border-width: 1px;
		border-style: solid;
		border-color: rgb(156, 186, 95);
		}

		/* Padding and font style */
		#table-5 td, #table-5 th {
		padding: 5px 10px;
		font-size: 16px;
		font-family: Verdana;
		font-weight: bold;
		}

		/* Table Head */
		#table-7 thead th {
		background-color: rgb(81, 130, 187);
		color: #fff;
		border-bottom-width: 0;
		}

		/* Column Style */
		#table-7 td {
		color: #000;
		}
		/* Heading and Column Style */
		#table-7 tr, #table-7 th {
		border-width: 1px;
		border-style: solid;
		border-color: rgb(81, 130, 187);
		}

		/* Padding and font style */
		#table-7 td, #table-7 th {
		padding: 5px 10px;
		font-size: 16px;
		font-family: Verdana;
		font-weight: bold;
		}

	</style>

	<style type="text/css">
		.ui-grid-a .ui-block-a{
			width: 30%;
			
            text-align:center;
            

            display: table-cell;
            vertical-align:middle;
		}
		.ui-grid-a .ui-block-b{
			width: 70%;
		}
	</style>

</head>
<body>



<div data-role="page" id="testpage" data-theme="a">
	<!-- header begin-->
	<div data-role="header">
		<h1>车辆预定<?PHP echo $_SESSION['priority']?></h1>
		<a href="../main.php" class="ui-btn ui-corner-all ui-shadow ui-icon-back ui-btn-icon-left ui-btn-icon-notext">Back</a>
		

		<div data-role="navbar">
			<ul>
				<li><a href="../main.php" class="ui-btn ui-corner-all ui-shadow">返回首页</a></li>
				<li><a href="carindex6.php" class="ui-btn-active ui-state-persist">订单列表</a></li>
<!-- 				<li><a href="javascript:location.href='carsubmit.php'" data-transition="slideup" >车辆预定</a></li> -->
				<!-- <li><a href="carsubmit.php" >车辆预定</a></li> -->
			</ul>
		</div>

	</div>
	<!-- header end-->


	<div class="ui-content" role="main">
<?php
if($ischeck == 0)
{
    //查询待审批
    if($priority==TYPE_DPTLEADER)
    {
        $dptcheck=$_SESSION['name'];
        carSelectDptIsChecking($dptcheck);
	}
	
    if($priority==TYPE_COMLEADER)
    {
		//公司领导审批
		echo "公司领导查看待审批";
		$leadercheck=$_SESSION['name'];
        comSelectIsCheckingOrd($leadercheck);
	}

    if($priority==TYPE_FLEETCAR)
    {
		//车队领导审批
		echo "车队领导查看 待审批";
		$leadercheck=$_SESSION['name'];
        fleetSelectIsCheckingOrd();
    }
}

if($ischeck == 1)
{
	//查询已经审批的
	if($priority==TYPE_DPTLEADER)
    {
        $dptcheck=$_SESSION['name'];
        carSelectDptIsChecked($dptcheck);
	}

    if($priority==TYPE_COMLEADER)
    {
		//公司领导审批
		echo "公司领导查看已经审批";
		$leadercheck=$_SESSION['name'];
        carSelectComIsChecked($leadercheck);
	}
    
    if($priority==TYPE_FLEETCAR)
    {
		echo "车队领导查看已审批订单";
        fleetSelectIsCheckedOrd();
	}
	
}

if($ischeck == 2)
{
	//历史记录
	if($priority==TYPE_DPTLEADER)
    {
        $dptcheck=$_SESSION['name'];
        carSelectDptHistoryOrd($dptcheck);
	}
	
    if($priority==TYPE_COMLEADER)
    {
		//公司领导审批
		echo "公司领导查看历史订单";
		$leadercheck=$_SESSION['name'];
        carSelectComIsCheckedHis($leadercheck);
	}
    if($priority==TYPE_FLEETCAR)
    {
		echo "车队领导查看历史订单";
        fleetSelectHistoryOrd();
	}	
}
?>
	</div>

<!-- content end-->
	<div data-role="footer" data-position="fixed">
		<div data-role="navbar">
			<ul>
        
				<li><a href="carindex6.php?ischeck=1" data-icon="check" >已批准</a></li>
				<li><a href="carindex6.php?ischeck=0"  data-icon="comment" >待审核</a></li>
				<li><a href="carindex6.php?ischeck=2"  data-icon="check">历史订单</a></li>
			</ul>
		</div>
		<h4 style="display:none;">Footer</h4>
	</div>
<!-- footer end-->
</div><!-- /page end -->

<!---------------------------------------页面分割----------------------------------------------------->

</body>
</html>
