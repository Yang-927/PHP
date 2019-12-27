<?php 
	header("content-type:text/html;charset=UTF8");
	// 数据库连接
	$link = mysqli_connect('127.0.0.1','root','root');
	// 选择数据库
	mysqli_select_db($link,'myself');
	// 设置字符集
	mysqli_set_charset($link,'UTF8');

	$id = $_POST['id'];

	$Title = $_POST['Title'];
	$Author = $_POST['Author'];
	$Cont = $_POST['Cont'];

	$showtime = date("Y-m-d H:i:s");
	
	$sql = "UPDATE books set Title = '$Title',Author = '$Author',Cont = '$Cont',UpdateTime = '$showtime' WHERE id = $id";

	$res = mysqli_query($link,$sql);
	if($res){
		echo "<script>
			alert('修改成功')
			location.href='BooksList.php'
		</script>";
	}else{
		echo "<script>
			alert('修改失败')
			location.href='To_update.php?id=$id'
		</script>";
	}
	mysqli_close($link);
 ?>