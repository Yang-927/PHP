<?php 
	header("content-type:text/html;charset=UTF8");

	require './gather.php';
	$table = 'userinfo';
	$array = getList($table);
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>信息</title>
	<style>
		table{
			background:url('./image/11.jpg') no-repeat;
			background-size:100%;
			color:#ccc;
		}
		.operation a{
			display:inline-block;
			background: #333;
			font-size:14px;
			text-decoration:none;
			width:40px;
			height:20px;
			color:#fff;
		}
		th,td{
			text-align:center;
		}
		td p {
			width:200px;
			height:40px;
			line-height:40px;
			text-align:left;
			font-size:14px;
			margin:0 auto;
			overflow:hidden;
			text-overflow:ellipsis;
			display:-webkit-box;
			-webkit-box-orient:vertical;
			-webkit-line-clamp:1;
		}
		.Title{
			width:200px;
			height:40px;
			line-height:40px;
			text-align:center;
			font-size:16px;
			margin:0 auto;
			overflow:hidden;
			text-overflow:ellipsis;
			display:-webkit-box;
			-webkit-box-orient:vertical;
			-webkit-line-clamp:1;
		}
		.addBtn{
			display: block;
			width:60px;
			height:30px;
			background: #333;
			color:#fff;
			line-height:30px;
			margin:0 auto;
		}
	</style>
</head>
<body>
	<table width="1050" align="center" border="1" cellspacing="0" cellpadding="5">
 		<thead>
 			<th colspan="8" style="font-size:22px;">用户信息</th>
 		</thead>
 		<tr>
 			<th>序列号</th>
 			<th>姓名</th>
 			<th>性别</th>
 			<th>电话/手机号</th>
 			<th>爱好</th>
 			<th>地区</th>
 			<th>添加时间</th>
 			<th>操作</th>
 		</tr>
 		<?php foreach ($array as $key => $value) { ?>
 				<tr>
		 			<td><?php echo $value['id']; ?></td>
		 			<td><?php echo $value['UserName']; ?></td>
		 			<td><?php 
		 					if ($value['UserSex'] == "1") {
		 						echo "男";
		 					}else{
		 						echo "女";
		 					}
		 				 ?></td>
		 			<td><?php echo $value['UserTel']; ?></td>
		 			<td><?php 
		 				$arr = explode(',',$value['UserHobby']);
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
		 			<td><?php 
		 					if ($value['UserRegion'] == "1") {
		 						echo "北京";
		 					}else if ($value['UserRegion'] == "2") {
		 						echo "河南";
		 					}else if ($value['UserRegion'] == "3") {
		 						echo "河北";
		 					}else if ($value['UserRegion'] == "4") {
		 						echo "山西";
		 					}else if ($value['UserRegion'] == "5") {
		 						echo "山东";
		 					}else if ($value['UserRegion'] == "6") {
		 						echo "上海";
		 					}else if ($value['UserRegion'] == "7") {
		 						echo "广东";
		 					}
		 			 ?></td>
		 			<td><?php echo $value['Time']; ?></td>
		 			<td class="operation">
		 				<a href="./details.php?table=userinfo&id=<?php echo $value['id'];?>">详情</a>
		 				<a href="./update.php?table=userinfo&id=<?php echo $value['id'];?>">修改</a>
		 				<a href="./gather.php?act=del&table=userinfo&id=<?php echo $value['id'];?>">删除</a>
		 			</td>
		 		</tr>
 		<?php } ?>
 		<tr>
 			<td colspan="8">
 				<a class="addBtn" href="./addition.html">添加</a>
 			</td>
 		</tr>
 	</table>
</body>
</html>