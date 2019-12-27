<?php 
	header("content-type:text/html;charset=UTF8");


	$link = mysqli_connect('127.0.0.1','root','root');

	mysqli_select_db($link,'myself');

	mysqli_set_charset($link,'UTF8');

	$UserName = !empty($_POST['UserName']) ? $_POST['UserName'] : '' ;
	$PassWord1 = !empty($_POST['PassWord1']) ? $_POST['PassWord1'] : '' ;
	$PassWord2 = !empty($_POST['PassWord2']) ? $_POST['PassWord2'] : '' ;
	$leng = strlen($PassWord1);

	if (!$UserName) {
		echo "<script>
			alert('用户名不可以为空')
			location.href = './index.html'
		</script>";
		exit;
	}
	if(!$PassWord1){
		echo "
			<script>
				alert('密码不可以为空');
				location.href = 'index.html';
			</script>
		";
		exit;
	}else if($leng >=6  && $leng <=16 ){
		if($PassWord1 === $PassWord2){
			$PassWord = md5($PassWord1);
		}else{
			echo "
			<script>
				alert('两次输入密码不一样');
				location.href = 'index.html';
			</script>
			";
			exit;
		}
	}else {
		echo "
			<script>
				alert('密码长度请控制在6到16位之间');
				location.href = 'index.html';
			</script>
		";
		exit;
	}
	// 从数据库中中查询用户输入的用户名
	$sql = "SELECT * from login WHERE UserName = '$UserName'";
	// 执行sql函数
	$result = mysqli_query($link,$sql);
	// 获取结果集
	$array = mysqli_fetch_array($result);
	// 判断结果集是否为空,查询不到则获取结果集为NULL
	if($array){
		// 结果集有内容则此步成立,则说明已经存在相同的用户名不可以注册,需要返回注册页重新注册;
		echo "
			<script>
				alert('该用户已注册,请重新考虑用户名');
				location.href = 'index.html';
			</script>
		";
		exit;
	}else{
		// 结果集为空则执行此步,说明数据库中没有相同的用户名,用户当前输入的用户名可以使用;
		// 获取当前注册时间戳;
		$showtime = date("Y-m-d H:i:s");
		// 在数据库中插入用户信息;
		$sql = "INSERT INTO login(id,UserName,PassWord,Time) VALUES(null,'$UserName','$PassWord','$showtime')";
		// 执行sql函数;
		$res = mysqli_query($link,$sql);
		// 判断是否注册成功,注册成功跳转到登录页;
		if($res){
			echo "注册成功,即将前往登录页";
			echo "
				<script>
					alert('注册成功');
					setTimeout(function(){
						location.href = 'index.html';
					},1000)
				</script>
			";
			exit;
		}else{
			echo "注册失败,即将返回注册页重新注册";
			echo "
				<script>
					alert('注册失败');
					setTimeout(function(){
						location.href = 'index.html';
					},1000)
				</script>
			";
			exit;
		}
	}
	mysqli_free_result($array);	// 释放结果集
	mysqli_close($link);		// 关闭数据库连接
 ?>