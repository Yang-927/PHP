<?php 
	header("content-type:text/html;charset=UTF8");
	require './curd.php';
	$getSort = getSortData();

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link href="img/favicon32.ico" rel="shortcut icon" type="image/x-icon">
	<script src="js/jQuery-3.4.0.js"></script>
	<script src="js/bootstrap.js"></script>
	<style>
		body{
			background:url('img/bg.jpg');
		}
		a{
			color:#333;
			font-size:12px;
		}
		th,td{
			text-align: center;
		}
		th{
			font-size:18px;
		}
		.navbar-default{
			border-radius:0;
			border-color:#000;
			border:none;
			border-bottom:5px double #000;
		}
		.inputBox{
			width:250px;
			height:30px;
			margin:0 auto;
			border:1px solid #333;
			border-radius:5px;
			overflow:hidden;
		}
		.inputText{
			width:250px;
			height:100px;
			padding:3px;
			margin:0 auto;
			border:1px solid #333;
			border-radius:5px;
			overflow:hidden;
		}
		textarea{
			width:100%;
			height:100%;
			border:0;
			padding:0;
			resize:none;
			background:rgba(0,0,0,0);
			font-size:16px;
		}
		.imgBox{
			width:250px;
			height:30px;
			margin:0 auto;
			overflow:hidden;
		}
		.inputBox input{
			width:248px;
			height:28px;
			font-size:16px;
			padding:0;
			margin:0;
			padding-left:10px;
			outline:none;
			border:none;
			background:rgba(0,0,0,0);
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
			width:250px;
			height:28px;
			border:1px solid #333;
			outline:none;
			background:rgba(0,0,0,0);
		}
		.box select option{
			width:250px;
			height:28px;
			border:1px solid #333;
			outline:none;
			background:rgba(0,0,0,0);
		}
		.cont input[type="submit"]{
			width:60px;
			height:30px;
			background:#000;
			border:none;
			color:#fff;
		}
		.cont form{
			padding:30px;
			border:2px solid #333;
		}
		.cont form input[type="file"]{
			background:rgba(0,0,0,0);
			outline:none;
		}
		.footerBox{
			padding:0;
		}
		.footer{
			height:200px;
			margin-top:50px;
			padding:50px;
			background: #333;
			position:relative;
		}
		.footer:after {
			content: "";
			display: block;
			position: absolute;
			top: 0;
			right: 0;
			bottom: 0;
			left: 0;
			background: url("img/bs-docs-masthead-pattern.png") repeat 50%;
			opacity: .4;
		}
		.footer .container h1{
			color:#fff;
			text-align:center;
		}
		.head{
			padding:0;
			height:50px;
			padding:9px 20px;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
					 aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand head" href="#">
						<img alt="YANG" src="img/favicon32.ico">
					</a>
					<a class="navbar-brand" href="#">我的论坛</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<form class="navbar-form navbar-right">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="搜索">
						</div>
						<button type="submit" class="btn btn-default">提交</button>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li class="active"><a href="./list.php">首页 <span class="sr-only">(current)</span></a></li>
						<li><a href="#">奇闻轶事</a></li>
						<li class="dropdown navbar-right">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">更多操作
								<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="./addition.php">修改</a></li>
								<li><a href="./manageList.php">管理</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container">
			<div>
				<h1 class="title">文章添加页</h1>
				<hr>
			</div>
			<div class="cont">
				<form action="./curd.php?act=add&table=essay" method="post" enctype="multipart/form-data">
					<table align="center" height="400" width="400" border="0" cellspacing="0" cellpadding="10">
						<thead>
							<th colspan="2">文章添加</th>
						</thead>
						<tr>
							<td>标题:</td>
							<td>
								<div class="inputBox">
									<input type="text" name="Title">
								</div>
							</td>
						</tr>
						<tr>
							<td>配图:</td>
							<td>
								<div class="imgBox">
									<input type="file" name="Img">
								</div>
							</td>
						</tr>
						<tr>
							<td>作者:</td>
							<td>
								<div class="inputBox">
									<input type="text" name="Author">
								</div>
							</td>
						</tr>
						<tr>
							<td>内容:</td>
							<td>
								<div class="inputText">
									<textarea name="Cont" cols="30" rows="10"></textarea>
								</div>
							</td>
						</tr>
						<tr>
							<td>类别:</td>
							<td>
								<div class="box">
									<select name="Sort" id="">
										<?php foreach ($getSort as $key => $value) { ?>
											<option value="<?php echo $value['id']; ?>"><?php echo $value['Sort']; ?></option>
										<?php } ?>
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
								<a href="list.php">跳转到文章列表</a>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		<div class="container-fluid footerBox">
			<footer class="footer">
				<div class="container">
					<h1>“革命尚未成功，同志仍须努力”。</h1>
				</div>
			</footer>
		</div>
</body>
</html>