<?php 
	header("content-type:text/html;charset=UTF8");

	$act=!empty($_GET['act'])?$_GET['act']:'';
	$table=!empty($_GET['table'])?$_GET['table']:'';
	$id=!empty($_GET['id'])?$_GET['id']:'';

	if($act == 'add'){
		addData($table);
	}else if($act == 'del'){
		deleteData($table,$id);
	}else if($act == 'update'){
		setUpdateData($table,$id);
	}

	function setUpdateData($table,$id){
		$link = connect();
		$imgUrl = setImg();
		$keys = array_keys($_POST);
		array_push($keys,'image');
		
		$values = array_values($_POST);
		array_push($values,"$imgUrl");
		$set = '';
		$len = count($keys,COUNT_RECURSIVE);
		for ($i=0; $i < $len ; $i++) { 
			$set .= "$keys[$i]='$values[$i]'".',';
		}
		$set = trim($set , ",");
		$sql = "UPDATE ".$table." SET ".$set. " WHERE id=".$id;
		$res = mysqli_query($link , $sql);
		if ($res) {
			echo "<script>
				alert('修改成功')
				location.href = './list.php'
			</script>";
		}else{
			echo "<script>
				alert('修改失败')
				location.href = './list.php'
			</script>";
		}
	}

	function getUpdateData($table,$id){
		$link = connect();
		$sql = "SELECT * from ".$table." where id=".$id;
		// 执行sql
		$res = mysqli_query($link,$sql);
		$array = mysqli_fetch_array($res);
		return $array;
	}

	// 删除
	function deleteData($table,$id){
		$link = connect();
		$sql = "DELETE FROM ".$table." WHERE id=".$id;
		$res = mysqli_query($link,$sql);
		if($res){
			echo "<script>
				alert('删除成功');
				location.href='./list.php';
			</script>";
			exit;
		}else {
			echo "<script>
				alert('删除失败');
				location.href='./list.php';
			</script>";
			exit;
		}
	}
	// 图片添加
	function setImg(){
		// 限制图片格式
		$allImgTtpe = ['png','jpg','gif','jpeg'];

		$imgType = ltrim(strstr($_FILES['image']['type'],'/'),'/');

		if(!in_array($imgType,$allImgTtpe)){
			echo "<script>
				alert('图片格式错误，请重新选择图片')
				location.href = './addition.php'
			</script>";
		}

		$filePath = 'upload/';

		$fileName = date('YmdHis').'.'.$imgType;
		if(is_uploaded_file($_FILES['image']['tmp_name'])){
			if(move_uploaded_file($_FILES['image']['tmp_name'],$filePath.$fileName)){
				$imgUrl = $filePath.$fileName;
				return $imgUrl;
			}else{
				echo "<script>
					alert('图片上传失败')
					location.href = 'addition.php';
				</script>";
				exit;
			}
		}else {
			echo "<script>
				alert('图片失败')
				location.href = './addition.php'
			</script>";
			exit;
		}
	}

	// 添加数据
	function addData($table){
		$link = connect();
		$imgUrl = setImg();

		$time = date("Y年m月d日 H时i分s秒");

		$keys = array_keys($_POST);
		$keys = implode(',',$keys);
		$keys .= ",time,image";

		$values = array_values($_POST);
		$values = "'".implode("','",$values)."'";
		$values .= ",'"."$time"."','"."$imgUrl"."'";

		$sql = "INSERT INTO ".$table."(".$keys.") values(".$values.")";
		echo "$sql";
		$res = mysqli_query($link,$sql);
		var_dump($res);
		if($res){
			echo "<script>
				alert('添加成功');
				location.href='./list.php';
			</script>";
			exit;
		}else {
			echo "<script>
				alert('添加失败');
				// location.href='./addition.php';
			</script>";
			exit;
		}

	}

	// 获取列表
	function getListData($table){
		$link = connect();

		$sql = "SELECT * FROM ".$table;

		$res = mysqli_query($link,$sql);

		while($row = mysqli_fetch_assoc($res)){
			$array[] = $row;
		}

		return $array;
	}

	// 数据库连接
	function connect(){
		$link = mysqli_connect('127.0.0.1','root','root');

		mysqli_select_db($link,'test');

		mysqli_set_charset($link,'UTF8');

		return $link;
	}
 ?>