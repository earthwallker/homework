<?php
include("../lock.php");
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
	<script src="../js/mytools.js"></script> 

	<!--jquery script begin -->
	<script>
	var $fullname="";	
	var $dpt="";
	var $tel = 0;
	var $persons = 0;
	var $bdate="";
	var $btime = 0;
	var $rtntime="";
	var $stposition="";
	var $edposition="";
	var $incity = 0;
	var $lngdistance="";
	var $taskname="";
	var dptcheck="";
	var ldcheck="";
    var $msg="";
	$(document).ready(function(){
		var time = new Date();
        var day = ("0" + time.getDate()).slice(-2);
        var month = ("0" + (time.getMonth() + 1)).slice(-2);
        var today = time.getFullYear() + "-" + (month) + "-" + (day);

        var m = ("0" + time.getMinutes()).slice(-2);
        var h= ("0" + time.getHours()).slice(-2);
        var s = time.getSeconds();
        var t = h + ":" + m;
        $('#bdate').val(today);
		$('#rtntime').val(today);
		$('#btime').val(t);
        
		$("#leadercheck").hide();

        $("#incity").click(function(){
			$("#leadercheck").hide();
		})

        $("#outcity").click(function(){
			$("#leadercheck").show();
		})

		$("#btnsubmit").click(function(){
                $.post("careceive.php",
            	{
					fullname:$fullname,	
					dpt:$dpt,
					tel:$tel,
					person:$persons,
					bdate:$bdate,
					btime:$btime,
					rtntime:$rtntime,
					stposition:$stposition,
					edposition:$edposition,
					incity:$incity,
					lngdistance:$lngdistance,
					taskname:$taskname,
					dptcheck:$dptcheck,
					ldcheck:$ldcheck
            	},
				function(data,status){
					console.log("call back");
					$msg=data;
					$("#pgsbt").hide();
					$("#apgmsg").click();
					$("#pmsg").html($msg);
				}
            );
		});

	});
	
/**
 * page before hide
*/ 
	$(document).on("pagebeforehide","#editpage",function(){ 
	
		
		$fullname = $("#fullname").val();
		$("#fullname2").text($fullname);

		$tel = $("#tel").val();
		$("#tel2").text($tel);

		$persons = $("#persons").val();
		$("#persons2").text($persons+"人");

		$dpt = $("#dpt").val();
		$dpt=htdpt.get($dpt);
		$("#dpt2").text($dpt);

        $incity=$(":radio:checked").val();

		if($incity=="incity")
		{
			$("#tasktype2").text("市内：");
			$ldcheck="";
		
		}
		if($incity=="outcity")
		{
			$("#tasktype2").text("长途：");

			$ldcheck = $("#ldcheck").val();
			$ldcheck = htldchk.get($ldcheck);
			$("#ldcheck2").text($ldcheck);
		}

		$taskname = $("#taskname").val();
		$("#taskname2").text($taskname);
		

		$bdate = $("#bdate").val();
		$("#bdate2").text($bdate);

		$btime = $("#btime").val();
		$("#btime2").text($btime);

		$rtntime = $("#rtntime").val();
		$("#rtntime2").text($rtntime);


		$stposition = $("#stposition").val();
		$("#stposition2").text($stposition);

		$edposition = $("#edposition").val();
		$("#edposition2").text($edposition);

		$dptcheck = $("#dptcheck").val();
		$dptcheck = htdptchk.get($dptcheck);
		$("#dptcheck2").text($dptcheck);

		// $ldcheck = $("#ldcheck").val();
		// $ldcheck = htldchk.get($ldcheck);
		// $("#ldcheck2").text($ldcheck);

		$("#curTime").text(new Date().toLocaleString());

		htdpt.clear();
		htdptchk.clear();
		htldchk.clear();

	});

 

</script>
	<!--jquery script end2-->


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


	/* Table Head */

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
			padding: 2px 2px;
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

	</style>

	<style type="text/css">
		.ui-grid-a .ui-block-a{
			width: 40%;
			
            text-align:center;
            

            display: table-cell;
            vertical-align:middle;
		}
		.ui-grid-a .ui-block-b{
			width: 60%;
		}
	</style>

</head>
<body>


<!--下单输入页面 ----------------------------------------开始------------------------------------------->
<div data-role="page" id="editpage">

<div data-role="header">
		<h1>车辆预定</h1>
		<a href="carindex.php" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left ui-btn-icon-notext">Back</a>
</div>
<div data-role="main" class="ui-content">
	
		<p >申请用车规定：......</p>
	<form method="POST" action="careceive.php" id="form" name="form">
		<table id="table-5" >
		<thead>
		</thead>
		<tbody>
		<tr>
		<td style="width: 35%">用车部门：</td>
		<td style="width: 65%"><fieldset data-role="fieldcontain">
			<select name="dpt" id="dpt">
			 <option value="bgs">办公室</option>
			 <option value="hqzx">后勤中心</option>
			 <option value="ddzx">调度中心</option>
			 <option value="aqzljdc">安全质量监督处</option>
			 <option value="cwc">财务处</option>
			 <option value="ghtjc">规划统计处</option>
			 <option value="sxzzgzc">思想政治工作处</option>
			 <option value="ltxgzc">离退休工作处</option>
			 <option value="sjzx">审计中心</option>
			</select>
		  </fieldset></td>
		</tr>
		<tr>
		<td>联系电话：</td>
		<td><input type="number" name="tel" id="tel" value="<?php echo $_SESSION['tel']?>" onkeyup="value=value.replace(/[^\d]/g,'')" placeholder="只能输入数字"></td>
		</tr>
		<tr>
		<td>用车时间：</td>
		<td><input type="date" name="bdate" id="bdate"><input type="time" name="btime" id="btime"></td>
		</tr>
		<tr>
		<tr>
		<td>返回时间：</td>
		<td><input type="date" name="rtntime" id="rtntime"></td>
		</tr>
		<tr>
		<tr>
		<td>用车人数：</td>
		<td><input type="number" name="persons" id="persons" value="3" onkeyup="value=value.replace(/[^\d]/g,'')" placeholder="只能输入数字"></td>
		</tr>
		<tr>
		<td>用车人：</td>
		<td><input type="text" name="fullname" id="fullname" value="<?php echo $_SESSION['name']?>"></td>
		</tr>
		
		<tr >
		<td>出车地点：</td>
		<td><input type="text" name="stposition" id="stposition" value="48号院"></td>
		</tr>

		<tr >
		<td>到达地点：</td>
		<td><input type="text" name="edposition" id="edposition" value="3号航站楼"></td>
		</tr>
		<tr><td>用车类别：</td>

		<td>   <fieldset id="tasktype" data-role="controlgroup" data-type="horizontal">
				<legend></legend>
				  <label for="incity">市内</label>
				  <input type="radio" name="car" id="incity" value="incity" checked>
				  <label for="outcity">长途</label>
				  <input type="radio" name="car" id="outcity" value="outcity">
				  </fieldset>
			</td></tr>
		<tr >
		<td>任务名称：</td>
		<td><input type="text" name="taskname" id="taskname" value="出差..."></td>
		</tr>
		<tr id="bmsp">
		<td>部门审批：</td>
		<td><fieldset data-role="fieldcontain">
			<select name="dptcheck" id="dptcheck">
			 <option value="wm">王 满</option>
			 <option value="dyj">董跃军</option>
			 <option value="wbt">王炳通</option>

			</select>
		  </fieldset></td>
		</tr>
		<tr id="leadercheck">
		<td>分管领导审批：</td>
		<td><fieldset data-role="fieldcontain">
			<select name="ldcheck" id="ldcheck">
			 <option value="ywg">余卫国</option>
			 <option value="kjl">康建瓴</option>
			 <option value="zyz">赵玉柱</option>
			 <option value="cfc">曹福成</option>
			 <option value="xqt">徐钦田</option>
			 <option value="wlq">王利群</option>
			 <option value="ld">李 丹</option>
			</select>
		  </fieldset></td>
		</tr>
		</tbody>
		</table>
	</form>
	<a href="#pgmsg" id="apgmsg" class="ui-btn-active ui-state-persist" data-icon="action"></a>
    <div data-role="popup" id="popConfirm">
      <div data-role="header">
        <h1></h1>
      </div>
      <div data-role="main" class="ui-content">
        <h2>订单提交？</h2>
        <p>如有疑问请电联8266</p>
        <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b ui-icon-back ui-btn-icon-left" data-rel="back">取消</a>
        <button id="btnSubmit" >提交</button>
      </div>

      <div data-role="footer">
        <h1></h1>
      </div>
    </div>

    <div data-role="popup" id="popSubmit">
      <div data-role="header">
        <h1></h1>
      </div>
      <div data-role="main" class="ui-content">
        <h2>下单成功</h2>
        <p>如有疑问请电联8266</p>
        <a href="#" class="ui-btn ui-corner-all ui-shadow" data-rel="back">确定</a>
      </div>

      <div data-role="footer">
        <h1></h1>
      </div>
    </div>

</div><!--data-role="content" end-->

<div data-role="footer" data-position="fixed">
	<div data-role="navbar">
		<ul>
		  <li><a href="" data-rel="back" data-icon="back" >返回首页</a></li>
		  <li> <a href="#pgsbt" class="ui-btn-active ui-state-persist" data-icon="action">提交订单</a></li>
		
		</ul>
	  </div>
</div>

</div>
<!--下单页面 结束-->
<!------------------------------------------------------------------------------------------------------------------>
<!--返回页面 开始-->

<div data-role="page" id="pgsbt" data-dialog="true">

      <div data-role="header">
        <h1></h1>
      </div>
      <div data-role="main" class="ui-content">
        <h2>订单提交？</h2>
        <p>如有疑问请电联8266</p>
		<div class="ui-grid-a">
			<div class="ui-block-a">
			<a href="#" class="ui-btn ui-corner-all ui-shadow ui-icon-back ui-btn-icon-left" data-rel="back">取消</a>
			</div>
			<div class="ui-block-b">
			<button id="btnsubmit"  data-icon="action" class="ui-btn-active ui-state-persist">提交</button>
			</div>
		</div>
      </div>
</div>

<!------------------------------------------------------------------------------------------------------------------>
<!--返回页面 开始-->

<div data-role="page" id="pgmsg" data-dialog="true">
	  <div data-role="header">
        	<h1></h1>
      </div>
      <div data-role="main" class="ui-content">
        <h2>提交成功</h2>
        <p id="pmsg"></p>
		<a href="carindex.php" class="ui-btn ui-corner-all ui-shadow ui-icon-back ui-btn-icon-left ui-btn-active ui-state-persist">确定</a>
      </div>
</div>
</body>

</html>
