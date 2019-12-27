<?php 
	header("content-type:text/html;charset=UTF8");

	require "./curd.php";
	$table = 'essay';
	$array = getList($table);
	$getSort = getSortData();
 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>我的论坛</title>
		<link rel="stylesheet" href="css/bootstrap.css">
		<link href="img/favicon32.ico" rel="shortcut icon" type="image/x-icon">
		<script src="js/jQuery-3.4.0.js"></script>
		<script src="js/bootstrap.js"></script>
		<style>
			p{padding:0;margin:0;}
			body{margin:0;}
			ul,li{
				padding:0;
				margin:0;
				list-style:none;
			}
			.navbar-default{
				border-radius:0;
				border-color:#000;
				border:none;
				border-bottom:5px double #000;
			}
			.container .title{
				background: url('img/bg.jpg');
				color:#fff;
				padding:10px;
			}
			.ImgBox{
				width:200px;
				height:220px;
			}
			.ImgBox>a>img{
				width:100%;
				height:100%;
				display:block;
			}
			.TextBox{
				height:220px;
			}
			.TextBox .addTime{
				padding:10px;
			}
			.TextBox>.TextCont{
				height:220px;
				padding:15px;
				text-indent:2em;
				overflow:hidden;
				text-overflow:ellipsis;
				display:-webkit-box;
				-webkit-box-orient:vertical;
				-webkit-line-clamp:7;
			}
			.topBox{
				height:56px;
			}
			.essayTitle{
				float:left;
			}
			.topBox .addBox{
				height:24px;
				margin-right:30px;
				padding-top:32px;
				float:right;
				line-height:24px;
			}
			.addTime{
				color:#ccc;
				margin-right:10px;
			}
			.sort{
				color:#007fff;
			}
			.operate{
				height:40px;
				line-height:40px;
				font-size:15px;
			}
			.updateTime{
				float:left;
			}
			.details{
				float:right;
				margin-right:30px;
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
								<li><a href="./addition.php">添加</a></li>
								<li><a href="./manageList.php">管理</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container">
			<div>
				<h1 class="title">首页</h1>
				<hr>
			</div>
			<div>
				<ul>
					<?php foreach ($array as $key => $value) { ?>
						<li>
							<div class="topBox clearfix">
								<h3 class="essayTitle"><?php echo $value['Title']; ?></h3>
								<div class="addBox"><span class="addTime"><?php echo $value['Time']; ?> </span><span class="sort"> <?php 
									$sort = $value['Sort']-1;
									echo $getSort["$sort"]['Sort'];
								 ?></span></div>
							</div>
							<div class="essayCont clearfix">
								<div class="ImgBox pull-left">
									<a href="./details.php?table=essay&id=<?php echo $value['id']; ?>"><img src="<?php echo $value['Img']; ?>" alt=""></a>
								</div>
								<div class="TextBox">
									<p class="TextCont lead"><?php echo $value['Cont']; ?></p>
								</div>
							</div>
							<div class="operate">
								<div class="updateTime">
									<span class="addTime">最后修改时间：<?php echo $value['UpdateTime']; ?> </span>
								</div>
								<div class="details">
									<a href="./details.php?table=essay&id=<?php echo $value['id']; ?>">详情页>>></a>
								</div>
							</div>
							<hr>
						</li>
					<?php } ?>
				</ul>
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
	<script>
		
	</script>
</html>
