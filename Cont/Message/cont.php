<?php 
	header("content-type:text/html;charset=UTF8");

	$act = !empty($_GET['act']) ? $_GET['act'] : '';
	$table = !empty($_GET['table']) ? $_GET['table'] : '';
	$id = !empty($_GET['id']) ? $_GET['id'] : '';
	if ($act == 'add') {
		insertData($table);
	}else if($act == 'update'){
		setUpdateData($table,$id);
	}else if($act == 'del'){
		deleteData($table,$id);
	}
	// 删除
	function deleteData($table,$id){
		$link = connect();
		$sql = "DELETE FROM ".$table." WHERE id=".$id;
		$res = mysqli_query($link,$sql);
		if($res){
			echo "<script>
				alert('删除成功');
				location.href='./MessList.php';
			</script>";
			exit;
		}else {
			echo "<script>
				alert('删除失败');
				location.href='./MessList.php';
			</script>";
			exit;
		}
	}
	// 修改
	function setUpdateData($table,$id){
		$link = connect();
		$keys = array_keys($_POST);
		
		$values = array_values($_POST);
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
				location.href = './MessList.php'
			</script>";
		}else{
			echo "<script>
				alert('修改失败')
				location.href = './MessList.php'
			</script>";
		}
	}
	// 获取要修改的内容
	function getUpdateData($table,$id){
		$link = connect();
		$sql = "SELECT * FROM ".$table." WHERE id=".$id;
		$res = mysqli_query($link,$sql);
		// 获取结果集
		$array = mysqli_fetch_array($res);

		return $array;
	}
	
	// 详情
	function detailsData($table,$id){
		$link = connect();

		$sql = "SELECT * FROM ".$table." WHERE id=".$id;
		$res = mysqli_query($link,$sql);
		// 获取结果集
		$array = mysqli_fetch_array($res);

		return $array;
	}
	// 添加
	function insertData($table){
		$link = connect();

		$showtime = date("Y-m-d H:i:s");

		$keys = array_keys($_POST);
		$keys = implode(',',$keys);
		$keys .= ",Time";

		$values = array_values($_POST);
		$values = "'".implode("','",$values)."'";
		$values .= ",'$showtime'";

		$sql = "INSERT into ".$table."(".$keys.") values(".$values.")";
		$res = mysqli_query($link,$sql);
		if($res){
			echo "<script>
				alert('添加成功')
				location.href='./MessList.php'
			</script>";
			exit;
		}else{
			echo "<script>
				alert('添加失败')
				location.href='./addition.php'
			</script>";
			exit;
		}
	}

	// 连接数据库
	function connect(){
		$link = mysqli_connect('127.0.0.1','root','root');
		mysqli_select_db($link,'myself');
		// 设置字符集
		mysqli_set_charset($link,"UTF8");

		return $link;
	}

	// 获取列表
	function getList($link,$table){
		if($table){
			$sql = "SELECT * FROM ".$table;

			$res = mysqli_query($link,$sql);

			while ($row = mysqli_fetch_assoc($res)) {
				$array[] = $row;
			}
			return $array;
		}else{
			echo "查无此表";
		}

	}
 ?>