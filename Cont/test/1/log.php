<?php 
	header("content-type:text/html;charset=UTF8");
	// 数据库连接
	$link = mysqli_connect("127.0.0.1","root","root");
	// 选择数据库
	mysqli_select_db($link,"myself");
	// 获取从前端页面返回来的数据,并判断是否为空
	$UserName = !empty( $_POST['UserName'] )? $_POST['UserName'] : '';
	$PassWord = !empty( $_POST['PassWord'] ) ? md5( $_POST['PassWord'] ) : '';
	// 判断数据是否为空,为空弹出提示信息,并且返回登录页面
	if(!$UserName){
		echo "
			<script>
				alert('用户名不可以为空');
				location.href = 'index.html';
			</script>
		";
		exit;
	}
	if(!$PassWord){
		echo "
			<script>
				alert('密码不可以为空');
				location.href = 'index.html';
			</script>
		";
		exit;
	}
	// 在数据库中查询是否已经存在用户输入的相同的用户名
	$sql = "SELECT * from login WHERE UserName = '$UserName'";
	// 执行查询
	$result = mysqli_query($link,$sql);
	// 获取结果集,就是获取查询到的数据(即数据库中否有与用户输入的相同的用户名),没有则返回空
	$arr = mysqli_fetch_assoc($result);
	// 判断获取的结果集是否为空
	if($arr){
		// 成立则执行这一步,进入这一步证明用户名存在,判断用户输入的用户名是否和数据库中的数据相等
		if(($arr['UserName'] == "$UserName") && ($arr['PassWord'] == "$PassWord")){
			// 用户输入的数据和数据库中的数据相等则提示登录成功,跳转到相应的用户页面
			echo "登录成功,即将前往页面";
			echo "
				<script>
						location.href = './list.php';
				</script>
			";
			exit;
		}else{
			// 不成立执行这一步,这一步可以证明用户名正确,密码错误,弹出提示,返回登录页
			echo "密码错误,请重新登录,即将返回登录页";
			echo "
				<script>
					alert('密码错误,请重新登录');
					setTimeout(function(){
						location.href = 'index.html';
					},1000)
				</script>
			";
			exit;
		}
	}else{
		// 结果集为空执行这一步,数据库里没有对应的用户,需要返回注册页开始注册
		echo "用户不存在,请前往注册页注册账户";
		echo "
			<script>
				alert('密码错误,请重新登录,即将前往注册页注册账户');
				setTimeout(function(){
					location.href = 'index.html';
				},1000)
			</script>
		";
		exit;
	}
	mysqli_free_result($arr);	// 释放结果集
	mysqli_close($link);		// 关闭数据库连接
 ?>