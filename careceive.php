<?php

/**
 * NCPG 处理汽车订单提交的页面
 * ============================================================================
 * * 版权所有 1992-2016 北京华电宇科技有限责任公司，并保留所有权利。
 * 网站地址: http://www.hwattnet.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: liubo $
 * $Id: careceive.php 17217 2015-01-19 06:29:08Z liubo $
 */
include("../mysql/carsql.php");


/* 取得参数 */
//echo var_dump($_REQUEST);
// 'fullname' => string '杨昌明' (length=9)
// 'dpt' => string 'bgs' (length=3)
// 'tel' => string '15910618266' (length=11)
// 'person' => string '3' (length=1)
// 'bdate' => string '2019-01-01' (length=10)
// 'btime' => string '01:00' (length=5)
// 'rtntime' => string '2019-07-17' (length=10)
// 'stposition' => string '48号院' (length=8)
// 'edposition' => string '3号航站楼' (length=13)
// 'incity' => string 'incity' (length=6)
// 'lngdistance' => string '' (length=0)
// 'taskname' => string '去战斗' (length=9)
// 'dptcheck' => string 'wm' (length=2)
// 'ldcheck' => string 'ywg' (length=3)
 $fullname = !empty($_REQUEST['fullname']) ? $_REQUEST['fullname'] : 0;  // 申请人姓名
 $dpt = !empty($_REQUEST['dpt']) ? ($_REQUEST['dpt']) : 0;  // 申请人部门
 $tel = !empty($_REQUEST['tel']) ? ($_REQUEST['tel']) : 0;  // 申请人电话
 $persons = !empty($_REQUEST['person']) ? ($_REQUEST['person']) : 0;  // 用车人数
 $bdate = !empty($_REQUEST['bdate']) ? ($_REQUEST['bdate']) : 0;  // 出发日期
 $btime = !empty($_REQUEST['btime']) ? ($_REQUEST['btime']) : 0;  // 出发时间
 $rtntime = !empty($_REQUEST['rtntime']) ? ($_REQUEST['rtntime']) : 0;  // 回来日期
 $stposition = !empty($_REQUEST['stposition']) ? ($_REQUEST['stposition']) : 0;  // 出发地点
 $edposition = !empty($_REQUEST['edposition']) ? ($_REQUEST['edposition']) : 0;  // 目的地址

 $tasktype = $_REQUEST['incity']=='incity' ? 1 : 0;  // 用车类型 市内？长途

 $lngdistance = !empty($_REQUEST['lngdistance']) ? ($_REQUEST['lngdistance']) : 0;  // 长途
 $taskname = !empty($_REQUEST['taskname']) ? ($_REQUEST['taskname']) : 0;  // 任务内容
 $dptcheck = !empty($_REQUEST['dptcheck']) ? ($_REQUEST['dptcheck']) : 0;  // 部门领导审批
 $ldcheck = !empty($_REQUEST['ldcheck']) ? ($_REQUEST['ldcheck']) : "";  // 主管领导审批
 $openid = !empty($_REQUEST['openid']) ? ($_REQUEST['openid']) : 0;  // 主管领导审批
$btime=$bdate ." ".$btime;

carAddOrder($_SESSION['openid'],"",$btime,$rtntime,$stposition,$edposition,$fullname,
$tel,$dpt,$persons,$taskname,$tasktype,$dptcheck,$ldcheck,1);

?>