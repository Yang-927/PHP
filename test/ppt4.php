<?php 
	// 声明变量 使用$符号
	/*
		变量:
			1.变量名含义准确
			2.变量遵循驼峰命名或者下划线
			3.变量区分大小写$a和$A是两个变量
			4.变量名重复后者会覆盖前者
			5.PHP是弱类型语言可以不声明直接使用
	 */
	
	$username = '杨彬然';
	$userName = '杨彬然';
	$UserName = '杨彬然';
	$user_name = '杨彬然';
	echo $username.'<br>'.$userName.'<br>'.$UserName.'<br>'.$user_name;

	// 可变变量 等量代换
	$i = 'j';
	$j = 'k';
	$k = 'Hello World';
	echo "<br>";
	echo $$$i;
	echo "<br>";

	// 预定义变量
	// $GLOBALS-----------超全局变量,包含所有预定义变量
	// $_SERVERS----------服务器和执行环境信息变量
	// $_ENV--------------环境变量
	// $_COOKIE-----------HTTP Cookies
	// $_SESSION----------HTTP Session变量
	// $_FILES------------文件上传信息变量
	/*
		$_GET:
			1.HTTP GET变量
			2.主要以接收?形式传递的数据,像表单以get形式发送数据,包括像超链接典型的?形式传送参数
			3.使用方法:$_GET['名称']
	 */
	/*
		$_POST:
			1.HTTP POST变量
			2.主要接收表单以post形式传递的数据
			3.使用方法:$_POST['名称']
	 */
	// $_REQUEST----------$_GET + $_POST + $_COOKIE
	
	// 常量
	
	// 什么是常量:常量是一个简单值得标识符,常量一经定义在脚本执行期间是不可以改变的
	
	/*
		声明常量:
			define('名称','值','true:不区分大小写')
	 */
	define('PI',3.14,true);
	define('pi',1,true);
	echo PI;
	echo pi;

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
 ?>