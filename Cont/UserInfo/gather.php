<?php 
	header("content-type:text/html;charset=UTF8");

	$act = !empty($_GET['act']) ? $_GET['act'] : '' ;
	$table = !empty($_GET['table']) ? $_GET['table'] : '' ;
	$id = !empty($_GET['id']) ? $_GET['id'] : '' ;
	if ($act == 'add') {
		insertData($table);
	}else if ($act == 'update') {
		setUpdateData($table,$id);
	}else if($act == 'del') {
		deleteData($table,$id);
	}
	
	// 删除
	function deleteData($table,$id){
		$link = connect();

		$sql = "DELETE FROM ".$table." WHERE id=".$id;

		$res = mysqli_query($link,$sql);
		
		if ($res) {
			echo "<script>
				alert('删除成功')；
				location.href = './InfoList.php'
			</script>";
			exit;
		}else{
			echo "<script>
				alert('删除失败')
				location.href = './InfoList.php'
			</script>";
			exit;
		}
	}
	// 详情
	function detailsData($table,$id){
		$link = connect();

		$sql = "SELECT * FROM ".$table." WHERE id=".$id;
		
		$res = mysqli_query($link,$sql);

		$array = mysqli_fetch_array($res);

		mysqli_free_result($res);
		return $array;
	}

	// 修改信息
	function setUpdateData($table,$id){
		$link = connect();
		$showtime = date("Y-m-d H:i:s");

		$keys = array_keys($_POST);
		array_push($keys, 'UpdateTime');

		$values = array_values($_POST);
		$values[3] = implode(',',$values[3]);
		array_push($values, "$showtime");

		$set = '';

		$len = count($keys,COUNT_RECURSIVE);
		for ($i=0; $i < $len; $i++) { 
			$set .= "$keys[$i] = '$values[$i]'".',';
		}
		$set = trim($set,',');
		$sql = "UPDATE ".$table." SET ".$set." WHERE id=".$id;
		$res = mysqli_query($link,$sql);

		if ($res) {
			echo "<script>
				alert('修改成功')
				location.href = './InfoList.php';
			</script>";
			exit;
		}else{
			echo "<script>
				alert('修改失败')
				location.href = './update.php?table=userinfo&id=6';
			</script>";
			exit;
		}
	}


	// 获取要修改的信息
	// 
	function getUpdateData($table,$id){
		$link = connect();

		$sql = "SELECT * FROM ".$table." WHERE id=".$id;

		$res = mysqli_query($link,$sql);

		$array = mysqli_fetch_array($res);

		mysqli_free_result($res);
		return $array;
	}

	// 添加
	function insertData($table){
		$link = connect();
		$showtime = date("Y-m-d H:i:s");

		$keys = array_keys($_POST);
		$keys = implode(',', $keys);
		$keys .= ",Time,UpdateTime";

		$values = array_values($_POST);
		$values[3] = implode(',', $values[3]);
		$values = "'".implode("','", $values)."'";
		$values .= ",'$showtime','$showtime'";

		var_dump($keys);
		var_dump($values);

		$sql = "INSERT INTO ".$table."(".$keys.") values(".$values.")";
		echo $sql;
		$res = mysqli_query($link,$sql);
		var_dump($res);
		if ($res) {
			echo "<script>
				alert('添加成功')
				location.href = './InfoList.php';
			</script>";
		}else{
			echo "<script>
				alert('添加失败')
				location.href = './addition.html';
			</script>";
		}
	}

	// 获取列表信息
	function getList($table){
		$link = connect();
		if ($table) {

			$sql = "SELECT * FROM ".$table;
			$res = mysqli_query($link,$sql);
			while ($row = mysqli_fetch_assoc($res)) {
				$array[] = $row;			
			}
			return $array;
		}else{
			echo "<script>
				alert('查无此表')；
			</script>";
		}
	}

	// 数据库连接
	function connect(){
		$link = mysqli_connect('127.0.0.1','root','root');
		// 选择数据库
		mysqli_select_db($link,'myself');
		// 设置字符集格式
		mysqli_set_charset($link,'UTF8');

		return $link;
	}
 ?>