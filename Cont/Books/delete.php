<?php 
	header("content-type:text/html;charset=UTF8");
	$id = $_GET['id'];
	// 数据库连接
	$link = mysqli_connect('127.0.0.1','root','root');
	// 选择数据库
	mysqli_select_db($link,'myself');
	// 设置字符集
	mysqli_set_charset($link,'UTF8');
	// 查询
	$sql = "DELETE FROM books WHERE id=".$id;
	// 执行sql
	$res = mysqli_query($link,$sql);

	if($res){
		echo "<script>
			alert('删除成功')
			location.href='BooksList.php'
		</script>";
		exit;
	}else{
		echo "<script>
			alert('删除失败')
			location.href='BooksList.php'
		</script>";
		exit;
	}
 ?>