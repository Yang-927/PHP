<?php 
	header("content-type:text/html;charset=UTF8");
	
	$Img = $_FILES['Img'];
	// $Img = implode(',<br>', $Img);
	print_r($Img);

	// 限制图片大小！
	$maxSize = 3000000;

	if ($_FILES['Img']['size'] > $maxSize) {
		echo "<script>
			alert('图片大小超过3MB，请重新选择图片')
			location.href = './file.html';
		</script>";
	}

	// 限制文件格式
	$allImgType = ['png','jpg','gif','jpeg'];
	$imgType = ltrim(strstr($_FILES['Img']['type'],'/'),'/');
	if(!in_array($imgType, $allImgType)){
		echo "<script>
			alert('请上传正确的图片格式')
			location.href = './file.html';
		</script>";
	}

	// 将临时文件存入指定文件夹
	$filePath = 'upload/';
	$fileName = date('YmdHis').'.'.$imgType;
	if(is_uploaded_file($_FILES['Img']['tmp_name'])){
		if(move_uploaded_file($_FILES['Img']['tmp_name'],$filePath.$fileName)){
			$imgUrl = $filePath.$fileName;
			echo $imgUrl;
		}else{
			echo "<script>
				alert('上传失败')
				location.href = 'file.html';
			</script>";
			exit;
		}
	}else {
		echo "<script>
			alert('上传失败')
			location.href = './file.html'
		</script>";
		exit;
	}
 ?>