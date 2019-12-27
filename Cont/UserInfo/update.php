<?php 
	header("content-type:text/html;charset=UTF8");
	require './gather.php';

	$table=!empty($_GET['table'])?$_GET['table']:'';
	$id=!empty($_GET['id'])?$_GET['id']:'';
	$array = getUpdateData($table,$id);
	// in_array('1',$array) 判断数组中是否存在一个值，存在则返回true，不存在则返回false;
	// strpos($array,'1') 判断字符串中是否存在一个字符串，存在则返回它在字符串中的下标，不存在则返回false
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>修改</title>
	<style>
		a{
			color:#333;
			font-size:12px;
		}
		th,td{
			text-align: center;
		}
		.inputBox{
			width:250px;
			height:30px;
			margin:0 auto;
			border:1px solid #333;
			border-radius:5px;
			overflow:hidden;
		}
		.inputBox input{
			width:240px;
			height:30px;
			font-size:16px;
			padding:0;
			margin:0;
			padding-left:10px;
			outline:none;
			border:none;
			background:rgba(0,0,0,0.3);
		}
		.box{
			text-align:left;
			width:250px;
			height:30px;
			margin:0 auto;
			line-height:30px;
			overflow:hidden;
		}
		.box select{
			width:240px;
			height:28px;
			border:1px solid #333;
			outline:none;
		}
		input[type="submit"]{
			width:60px;
			height:30px;
		}
	</style>
</head>
<body>
	<form action="./gather.php?act=update&table=userinfo&id=<?php echo $array['id'] ?>" method="post">
		<table align="center" width="400" border="0" cellspacing="0" cellpadding="10">
			<thead>
				<th colspan="2">修改</th>
			</thead>
			<tr>
				<td>姓名:</td>
				<td>
					<div class="inputBox">
						<input type="text" name="UserName" value="<?php echo $array['UserName'] ?>">
					</div>
				</td>
			</tr>
			<tr>
				<td>性别:</td>
				<td>
					<div class="box">
						<input type="radio" name="UserSex" checked="checked" value="1">男
						<input type="radio" name="UserSex" value="2">女
					</div>
				</td>
			</tr>
			<tr>
				<td>电话:</td>
				<td>
					<div class="inputBox">
						<input type="text" name="UserTel" value="<?php echo $array['UserTel'] ?>">
					</div>
				</td>
			</tr>
			<tr>
				<td>爱好:</td>
				<td>
					<div class="box">
						<input type="checkbox" name="UserHobby[]" value="1" <?php if(strpos($array['UserHobby'],'1') !== false){echo "checked";} ?>>游泳
						<input type="checkbox" name="UserHobby[]" value="2" <?php if(strpos($array['UserHobby'],'2') !== false){echo "checked";} ?>>跑步
						<input type="checkbox" name="UserHobby[]" value="3" <?php if(strpos($array['UserHobby'],'3') !== false){echo "checked";} ?>>篮球

					</div>
				</td>
			</tr>
			<tr>
				<td>地区:</td>
				<td>
					<div class="box">
						<select name="UserRegion" id="">
							<option value="1" <?php if($array['UserRegion'] == '1'){echo "selected";} ?>>北京</option>
							<option value="2" <?php if($array['UserRegion'] == '2'){echo "selected";} ?>>河南</option>
							<option value="3" <?php if($array['UserRegion'] == '3'){echo "selected";} ?>>河北</option>
							<option value="4" <?php if($array['UserRegion'] == '4'){echo "selected";} ?>>山西</option>
							<option value="5" <?php if($array['UserRegion'] == '5'){echo "selected";} ?>>山东</option>
							<option value="6" <?php if($array['UserRegion'] == '6'){echo "selected";} ?>>上海</option>
							<option value="7" <?php if($array['UserRegion'] == '7'){echo "selected";} ?>>广东</option>
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit">
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:right;">
					<a href="InfoList.php">跳转到用户信息列表</a>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>