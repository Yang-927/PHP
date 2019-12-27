<?php 
	header("content-type:text/html;charset=UTF8");
	require './curd.php';
	$table=!empty($_GET['table'])?$_GET['table']:'';
	$id=!empty($_GET['id'])?$_GET['id']:'';
	// $array = detailsData($table,$id);
	$array = getDetails($table,$id);
	$text = $array['Cont'];
	$str = "</p><p class='lead'>";
	$newText = $array['Cont'];
	$newText = preg_replace("/([a-z])\s+([a-z])/i", "$1$2", $newText);
	$newText = preg_replace('/[\s]/',$str , $newText);
 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title><?php echo $array['Title'] ?></title>
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
			.navbar{
				position:relative;
				z-index:210;
			}
			.Cont{
				background:url("<?php echo $array['Img'] ?>") no-repeat 100%;
				background-position:center;
				position: relative;
			}
			.Cont:after{
				content:'';
				display:block;
				position:absolute;
				left:0;
				top:0;
			}
			.container .title{
				background: url('img/bg.jpg');
				color:#fff;
				padding:10px;
			}
			.info{
				height:50px;
				padding:0 20px;
				line-height:50px;
				font-size:16px;
			}
			.info .addTime{
				float:right;
				margin-right:10px;
				color:#ccc;
			}
			.info .sort{
				float:right;
				color:#007fff;
			}
			.imgBox{
				float:left;
				padding:20px;
				padding-bottom:0;
				position:relative;
				z-index:200;
			}
			.imgBox img {
				width:100%;
			}
			.Cont:after{
				content: "";
				width:100%;
				height:100%;
				position: absolute;
				left:0;
				top:0;
				background: inherit;
				filter: blur(4px);
				z-index:20;
			}
			.titleBox,.cont{
				position:relative;
				z-index:200;
			}
			.lead{
				color:#333;
				text-indent:2em;
			}
			.back {
				height:30px;
				position:absolute;
				left:0;
				bottom:-10px;
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
			.textCont{
				background:rgba(255,255,255,0.5);
				padding:20px;
				border-left:2px dotted #000;
				border-right:2px dashed #000;
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
								<li><a href="update.php?table=essay&id=<?php echo $array['id'] ?>">修改</a></li>
								<li><a href="./manageList.php">管理</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container Cont">
			<div class="titleBox">
				<h1 class="title">详情页</h1>
				<p class="back"><a href="./list.php">返回首页……</a></p>
				<hr>
			</div>
			<div class="cont">
				<h2 class="text-center"><?php echo $array['Title']; ?></h2>
				<div class="info">
					<span class="sort"><?php echo $array['Sort'] ?></span>
					<span class="addTime"><?php echo $array['Time']; ?></span>
				</div>
				<div class="contBox row">
					<div class="imgBox col-lg-5 col-md-4 col-sm-12 col-xs-12">
						<img src="<?php echo $array['Img']; ?>" alt="">
					</div>
					<div class="textCont">
						<p class="lead"><?php echo $newText ?></p>
					</div>
				</div>
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
