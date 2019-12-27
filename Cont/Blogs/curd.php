<?php
header("content-type:text/html;charset=utf8");



$act=!empty($_GET['act'])?$_GET['act']:'';
$table=!empty($_GET['table'])?$_GET['table']:'';
$id=!empty($_GET['id'])?$_GET['id']:'';

if($act == 'add'){
	insertData($table);
}else if($act == 'del'){
	deleteData($table,$id);
}else if($act == 'update'){
	setUpdateData($table,$id);
}



// 获取分类
function getSort($table){
	// 获取分类
	$link = connect();
	// $sql = "SELECT a.Title,a.Author,a.Cont,c.Sort FROM article as a INNER JOIN sort as c ON a.Sort = c.id WHERE a.id = $id";
	$sql = "SELECT c.Sort FROM ".$table." as a INNER JOIN sort as c ON a.Sort = C.id";
	$res = mysqli_query($link,$sql);
	while ($row = mysqli_fetch_assoc($res)) {
		$array[] = $row;
	}
	return $array;
}

// 类别
function getSortData(){
	// 获取分类
	$link = connect();

	$sql = "SELECT * FROM sort";
	$res = mysqli_query($link,$sql);
	while ($row = mysqli_fetch_assoc($res)) {
		$array[] = $row;
	}
	return $array;
}

// 信息修改
function setUpdateData($table,$id){
	$link = connect();
	$Img = setImg();
	$showtime = date("Y-m-d H:i:s");
	$keys = array_keys($_POST);
	array_push($keys,'UpdateTime');
	array_push($keys,'Img');
	
	$values = array_values($_POST);
	array_push($values,"$showtime");
	array_push($values,"$Img");
	$set = '';
	$len = count($keys,COUNT_RECURSIVE);
	for ($i=0; $i < $len ; $i++) { 
		$set .= "$keys[$i]='$values[$i]'".',';
	}
	$set = trim($set , ",");
	$sql = "UPDATE ".$table." SET ".$set. " WHERE id=".$id;
	echo "$sql";
	$res = mysqli_query($link , $sql);
	if ($res) {
		echo "<script>
			alert('修改成功')
			location.href = './details.php?table=essay&id=$id'
		</script>";
	}else{
		echo "<script>
			alert('修改失败')
			location.href = './details.php?table=essay&id=$id'
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

// function detailsData($table,$id){
// 	$link = connect();
// 	$sql = "SELECT * from ".$table." where id=".$id;
// 	// 执行sql
// 	$res = mysqli_query($link,$sql);
// 	$array = mysqli_fetch_array($res);

// 	return $array;
// }

function getDetails($table,$id){
	$link = connect();

	$sql = "SELECT a.id,a.Title,a.Img,a.Author,a.Cont,a.Time,a.UpdateTime,c.Sort FROM ".$table." as a INNER JOIN sort as c ON a.Sort = c.id WHERE a.id = $id";
	$res = mysqli_query($link,$sql);
	$array = mysqli_fetch_assoc($res);
	return $array;
}

function deleteData($table,$id){
	$link = connect();
	$sql = "DELETE FROM ".$table." WHERE id=".$id;
	$res = mysqli_query($link,$sql);
	if($res){
		echo "<script>
			alert('删除成功');
			location.href='./BooksList.php';
		</script>";
		exit;
	}else {
		echo "<script>
			alert('删除失败');
			location.href='./BooksList.php';
		</script>";
		exit;
	}
}
function setImg(){
	$maxSize = 30000000;

	if ($_FILES['Img']['size'] > $maxSize) {
		echo "<script>
			alert('图片大小超过30MB，请重新选择图片')
			location.href = './addition.php';
		</script>";
		exit;
	}
	// 限制文件格式
	$allImgType = ['png','jpg','gif','jpeg'];
	$imgType = ltrim(strstr($_FILES['Img']['type'],'/'),'/');
	if(!in_array($imgType, $allImgType)){
		echo "<script>
			alert('请上传正确的图片格式')
			location.href = './addition.php';
		</script>";
		exit;
	}

	// 将临时文件存入指定文件夹
	$filePath = 'upload/';
	$fileName = date('YmdHis').'.'.$imgType;
	if(is_uploaded_file($_FILES['Img']['tmp_name'])){
		if(move_uploaded_file($_FILES['Img']['tmp_name'],$filePath.$fileName)){
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
function insertData($table){
	$link = connect();
	$Img = setImg();
	$showtime = date("Y-m-d H:i:s");
	$keys = array_keys($_POST);
	$keys = implode(',', $keys);
	$keys .=",Img,Time,UpdateTime";
	
	$values = array_values($_POST);
	$values = "'".implode("','", $values)."'";
	$values .= ",'"."$Img"."','"."$showtime"."','"."$showtime"."'";
	
	$sql = "INSERT into ".$table."(".$keys.") values(".$values.")";
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

function connect(){
	//数据库连接
	$link = mysqli_connect('127.0.0.1','root','root');
	//选择数据库
	mysqli_select_db($link,'myself');
	//设置字符集
	mysqli_set_charset($link,'utf8');
	return $link;
}
//获取文章列表
function getList($table){
	$link = connect();
	if($table){
		//写sql
		$sql = "SELECT * FROM ".$table;
		//执行查询Sql
		$res = mysqli_query($link,$sql);
		//获取结果集
		while ($row = mysqli_fetch_assoc($res)) {
			$array[] = $row;
		}
		$array = array_reverse($array);
		return $array;
	}else{
		echo "无此表！";
	}
}