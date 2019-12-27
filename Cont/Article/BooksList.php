<?php
//引入文件  百度include和require的区别
require './curd.php';
$link = connect();
$table = 'article';//数据库表的名字
$array = getArticleList($link,$table);
// $getSort = getSort($table);
// var_dump($getSort)
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>文章列表</title>
	<style>
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
	<table width="1150" align="center" border="1" cellspacing="0" cellpadding="5">
 		<thead>
 			<th colspan="8" style="font-size:22px;">文章信息列表</th>
 		</thead>
 		<tr>
 			<th>序列号</th>
 			<th>标题</th>
 			<th>作者</th>
 			<th>内容</th>
 			<th>分类</th>
 			<th>首次添加时间</th>
 			<th>最后修改时间</th>
 			<th>操作</th>
 		</tr>
 		<?php 
 			foreach ($array as $key => $value) { ?>
 				<tr>
		 			<td><?php echo $value['id']; ?></td>
		 			<td><p class="Title"><?php echo $value['Title']; ?></p></td>
		 			<td><?php echo $value['Author']; ?></td>
		 			<td><p><?php echo $value['Cont']; ?></p></td>
		 			<td><?php 
		 					if ($value['Sort'] == "1") {
		 						echo "言情";
		 					}else if ($value['Sort'] == "2") {
		 						echo "惊悚";
		 					}else if ($value['Sort'] == "3") {
		 						echo "技术";
		 					}else if ($value['Sort'] == "4") {
		 						echo "爱情";
		 					}else if ($value['Sort'] == "5") {
		 						echo "武侠";
		 					}else if ($value['Sort'] == "6") {
		 						echo "都市";
		 					}else if ($value['Sort'] == "7") {
		 						echo "传记";
		 					}
		 			 ?></td>
		 			<td><?php echo $value['Time']; ?></td>
		 			<td><?php echo $value['UpdateTime']; ?></td>
		 			<td class="operation">
		 				<a href="./details.php?act=details&table=article&id=<?php echo $value['id'];?>">详情</a>
		 				<a href="./update.php?table=article&id=<?php echo $value['id'];?>">修改</a>
		 				<a href="./curd.php?act=del&table=article&id=<?php echo $value['id'];?>">删除</a>
		 			</td>
		 		</tr>
 		<?php } ?>
 		<tr>
 			<td colspan="8">
 				<a class="addBtn" href="./addition.php">添加</a>
 			</td>
 		</tr>
 	</table>
</body>
</html>