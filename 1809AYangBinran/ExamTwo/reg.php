<?php 
	header("content-type:text/html;charset=UTF8");

	// 数据库操作
	$link = mysqli_connect('127.0.0.1','root','root');

	mysqli_select_db($link,'test');

	mysqli_set_charset($link,'UTF8');

	// 获取数据
	$user_name = !empty($_POST['user_name']) ? $_POST['user_name'] : '' ;
	$password1 = !empty($_POST['password1']) ? $_POST['password1'] : '' ;
	$password2 = !empty($_POST['password2']) ? $_POST['password2'] : '' ;

	var_dump($user_name);
	// 判断用户名或者密码是否输入为空
	if(!$user_name || !$password1 || !$password2){
		echo "<script>
			alert('用户名或密码或确认密码不可为空，请注意输入')
			location.href = './reg.html'
		</script>";
	}else if($password1 === $password2){
		$password = md5($password1);
	}else{
		echo "<script>
			alert('两次输入密码不一样');
			location.href = './reg.html';
		</script>
		";
		exit;
	}

	// 判断是否已经存在相同用户名
	$sql = "SELECT * FROM users WHERE user_name='".$user_name."'";
	$res = mysqli_query($link,$sql);
	$array = mysqli_fetch_assoc($res);
	if($array){
		echo "<script>
			alert('该用户名已经使用注册过，请您重新考虑新的用户名')
			location.href = './reg.html';
		</script>";
		mysqli_free_result($array);	// 释放结果集
		mysqli_close($link);		// 关闭数据库连接
		exit;
	}else{
		$sql = "INSERT INTO users(user_name,password) VALUES('$user_name','$password')";
		$res = mysqli_query($link,$sql);
		if ($res) {
			echo "<script>
				alert('注册成功')
				location.href = './login.html'
			</script>";
			exit;
		}else{
			echo "<script>
				alert('注册失败，返回注册页')
				location.href = './reg.html'
			</script>";
			exit;
		}
	}
 ?>