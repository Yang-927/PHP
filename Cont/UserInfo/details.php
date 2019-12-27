<?php 
	header("content-type:text/html;charset=UTF8");

	require './gather.php';

	$table = !empty($_GET['table']) ? $_GET['table'] : '' ;
	$id = !empty($_GET['id']) ? $_GET['id'] : '' ;

	$array = detailsData($table,$id);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户详情页</title>
	<style>
		th,td{
			text-align: center;
		}
		td p {
			width:200px;
			height:60px;
			text-align:left;
			font-size:14px;
			margin:0 auto;
			overflow:hidden;
			text-overflow:ellipsis;
			display:-webkit-box;
			-webkit-box-orient:vertical;
			-webkit-line-clamp:3;
		}
		a{
			color:#333;
			font-size:12px;
		}
	</style>
</head>
<body>
	<table align="center" width="400" border="1" cellpadding="10" cellspacing="0">
		<thead>
			<th colspan="2">详情页</th>
		</thead>
		<tr>
			<td>姓名:</td>
			<td><?php echo $array['UserName'] ?></td>
		</tr>
		<tr>
			<td>性别:</td>
			<td><?php 
				if ($array['UserSex'] == "1") {
		 			echo "男";
		 		}else{
		 			echo "女";
		 		}
		 	 ?></td>
		</tr>
		<tr>
			<td>电话/手机号:</td>
			<td><?php echo $array['UserTel'] ?></td>
		</tr>
		<tr>
			<td>爱好:</td>
			<td><?php 
		 		$arr = explode(',',$array['UserHobby']);
		 		$str = '';
		 		for ($i=0; $i < count($arr); $i++) { 
		 			if ($arr[$i] == 1) {
		 				$str .=" 游戏 ";
		 			}else if($arr[$i] == 2){
		 				$str .=" 跑步 ";
		 			}else if($arr[$i] == 3){
		 				$str .=" 篮球 ";
		 			}
		 		}
		 		echo $str;
		 	 ?></td>
		</tr>
		<tr>
			<td>地区:</td>
			<td><?php 
		 		if ($array['UserRegion'] == "1") {
		 			echo "北京";
		 		}else if ($array['UserRegion'] == "2") {
		 			echo "河南";
		 		}else if ($array['UserRegion'] == "3") {
		 			echo "河北";
		 		}else if ($array['UserRegion'] == "4") {
		 			echo "山西";
		 		}else if ($array['UserRegion'] == "5") {
		 			echo "山东";
		 		}else if ($array['UserRegion'] == "6") {
		 			echo "上海";
		 		}else if ($array['UserRegion'] == "7") {
		 			echo "广东";
		 		}
		 	 ?></td>
		</tr>
		<tr>
			<td style="text-align:right;" colspan="2"><a href="InfoList.php">点击跳转到列表页</a></td>
		</tr>
	</table>
</body>
</html>