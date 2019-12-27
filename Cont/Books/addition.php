<?php 
	header("content-type:text/html;charset=UTF8");
	// 连接数据库
	$link = mysqli_connect('127.0.0.1','root','root');
	// 选择数据库
	mysqli_select_db($link,"myself");
	// 设置字符集
	mysqli_set_charset($link,"UTF8");
	// 获取前端页面信息
	$Title = !empty( $_POST['Title'] ) ? $_POST['Title'] : '';
	$Author = !empty( $_POST['Author'] ) ? $_POST['Author'] : '';
	$Cont = !empty( $_POST['Cont'] ) ? $_POST['Cont'] : '';

	$showtime = date("Y-m-d H:i:s");
	var_dump($_FILES); // 获取图片信息
	$file_name = $_FILES['Img']['name'];
	echo "$file_name";
	$maxsize = 2000000;
	if($_FILES['Img']['size'] > $maxsize){
		echo "<script>
			alert('上传文件不可以超过2M')
			location.href = './addition.html'
		</script>";
	}
	$allowtype = ['png','jpg','gif','jpeg'];
	$img_type = ltrim(strstr($_FILES['Img']['type'],'/'),'/');
	echo $img_type;
	if (!in_array($img_type,$allowtype)) {
		echo "<script>
			alert('不可识别文件类型')
			location.href = 'addition.html';
		</script>";
		exit;
	}
	// 将临时文件传入到指定目录
	$filepath = 'uploade/';
	$re_filename = date('YmdHis').".".$img_type;
	if (is_uploaded_file($_FILES['Img']['tmp_name'])) {
		if(move_uploaded_file($_FILES['Img']['tmp_name'], $filepath.$re_filename)){
			$imgUrl = $filepath.$re_filename;
			$sql = "INSERT INTO books(id,Title,Img,Author,Cont,Time,UpdateTime) values(null,'$Title','$imgUrl','$Author','$Cont','$showtime','$showtime')";
			$res = mysqli_query($link,$sql);


			if($res){
				echo "<script>
					alert('添加成功')
					location.href='BooksList.php'
				</script>";
				exit;
			}else{
				echo "<script>
					alert('添加失败')
					location.href='addition.html'
				</script>";
			}

			mysqli_close($link);
			exit;
		}else{
			echo "<script>
				alert('上传失败')
				location.href = 'addition.html';
			</script>";
			exit;
		}
	}else{
		echo "<script>
			alert('不是同一个上传文件')
			location.href = 'addition.html';
		</script>";
		exit;
	}
// 连接数据库
$link = mysqli_connect('127.0.0.1','数据库用户名','数据库密码');
// 选择数据库
mysqli_select_db($link,'myself')
 ?>