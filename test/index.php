<?php
	header('content-type:text/html;charset=UTF8');

	// 数据库连接
	$link = mysqli_connect('127.0.0.1','root','root');
	// 选择数据库
	mysqli_select_db($link,'myself');
	// 设置字符集
	mysqli_set_charset($link,'utf8');
	// 加密
	$password = md5('927000');
	// 插入
	/*$sql = "insert into users(id,user_name,password) values(null,'Curry','$password')";
	$res = mysqli_query($link,$sql);
	var_dump($res);*/


	// 修改
	/*$sql = "UPDATE users SET user_name='Yang',password='927000' Where id=10 and id=8";
	$res = mysqli_query($link,$sql);*/

	// 删除
	// delete from 表名 where 条件表达式
	// $sql = "DELETE from users WHERE id=4";
	
	// 查询
	// select 字段名,字段名 from 表名 where 条件
	// 模糊查询 LIKE关键词
	// 通配符
	// % 任意多个字符
	// _ 任意一个字符
	$sql = "SELECT  * from users Where user_name LIKE '%y%'";
	$res = mysqli_query($link,$sql);
	// // 获取结果集
	while($row = mysqli_fetch_assoc($res)){
		$rows[] = $row;
	}
	foreach ($rows as $k=>$v) {
		echo "<br>";
		echo 'id : '.$v['id'].'----user_name : '.$v['user_name'].'----password : '.$v['password'];
	}
	mysqli_free_result($res);	// 释放结果集
	mysqli_close($link);		// 关闭数据库连接
	// $rows[] = mysqli_fetch_assoc($res);
	// var_dump($rows);

	die;
	echo PHP_VERSION;	// PHP的版本号
	echo "<br>";
	echo PHP_OS;		// 当前运行系统
	echo "<br>";
	echo PHP_INT_MAX;	// 整型最大值
	die;


	define('CURRY','Hello you !');

	echo constant('CURRY');
	die;

	// constant() 根据常量名来获取常量的值


	$array = array(
		'user_name' => 'yang',
		'age' => '18'
	);
	var_dump($array);
	echo "<br>";

	define('BR',[1,5,5,1,8,8,6,7,3,4,2]);
	var_dump(BR);
	echo '<br>';

	define('ARR',[1,2,3]);
	var_dump(
		get_defined_constants() // 获取所有的系统常量
	);

	// defined()检测一个变量是否存在
	echo '<br>';
	var_dump(ARR);
	die;
	// phpinfo();
	
	/*echo "Hello World";
	$x = 4;
	$y = 5;
	$z = $x + $y;
	echo $z;*/


	/*$text1 = "杨";
	$text2 = "彬";
	$arr = array("杨","彬","然");

	echo "$text1 <br>";
	echo "$text2 <br>";
	echo "杨 彬 {$arr[2]}";*/


	/*$x = 6546;
	var_dump($x);
	$x = 0x8c;
	var_dump($x);
	$x = 047;
	var_dump($x);*/

	/*// 字符串
	
	// 单引号声明
	$x = '杨彬然';

	// 双引号声明
	$y = "Curry";

	// 字界符 <<<ABC ABC;
	$z = <<<ABC		
		如果
		非要在这个滚犊子前面
		<br />
		加上一段<i>距离的话</i>我想说：<h1>思想有多远，你就跟我滚多远</h1>
	ABC;

	echo "$z";*/


	/*// 浮点(小数)
	$x = 65.2365487;
	echo $x;
	$x = 7.654899;
	var_dump($x)*/

	/*// 布尔值(bool)
	$x = true;
	$y = false;
	var_dump($x,$y);*/

	/*// 数组(Array)
	
	$arr = array("Stephen Curry","Kevin Durant","Draymond Green","Klay Thompson");
	echo $arr[2];
	echo "<br>";
	var_dump($arr);*/

	/*// 对象
	class Car
	{
		var $color;
		function Car($color = "green"){
			$this->color = $color;
		}
		function whar_color(){
			return $this->color;
		}
	};*/

	
	/*// 空值(null)
	$x = null;
	var_dump($x)*/

	/*// empty() 括号里传值为false或者为null时返回true;
	$x = null;
	if(empty($x)){
		echo '真';
	}else{
		echo "假";
	}*/

	$user_name = $_POST['user_name'];
	$password = $_POST['password'];

	print_r($user_name);
	echo "<br>";
	var_dump($user_name);
	echo "<br>";
	var_dump($password);


	echo "<br>";


	// define('PI' , 3.14);
	// echo PI;die;


	// echo "<br>";


	// define('PI',3.14,true);
	// define('pi',3.15,true);
	// echo PI;
	// echo "<br>";
	// echo pi;die;
?>