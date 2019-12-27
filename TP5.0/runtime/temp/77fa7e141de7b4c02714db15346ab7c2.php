<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"C:\phpstudy_pro\WWW\TP5.0\public/../application/admin\view\goods\goods_edit.html";i:1572486860;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<title></title>.
		<base href="http://www.tp5.com/static/" />
		<link href="styles/general.css" rel="stylesheet" type="text/css" />
		<link href="styles/main.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/utils.js"></script>
		<script type="text/javascript" src="js/selectzone.js"></script>
		<script type="text/javascript" src="js/colorselector.js"></script>
		<script type="text/javascript" src="js/calendar.php?lang="></script>
		<script src="js/jQuery-3.4.0.js"></script>
	</head>
	<body>
		<h1>
			<span class="action-span"><a href="goods.php?act=list">商品列表</a></span>
			<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心 </a> </span><span id="search_id" class="action-span1">
				- 编辑商品信息 </span>
			<div style="clear:both"></div>
		</h1>

		<div class="tab-div">
			<!-- tab bar -->
			<div id="tabbar-div">
				<p>
					<span class="tab-front" id="general-tab">通用信息</span>
					<span class="tab-back" id="detail-tab">详细描述</span>
					<span class="tab-back" id="mix-tab">其他信息</span>
					<span class="tab-back" id="properties-tab">商品属性</span>
					<span class="tab-back" id="gallery-tab">商品相册</span>
				</p>
			</div>

			<!-- tab body -->
			<div id="tabbody-div">
				<form enctype="multipart/form-data" action="/admin/Goods/goods_upd?ip=<?php echo $data['id']; ?>" method="post" name="theForm">
					<!-- 通用信息 -->
					<table width="90%" id="general-table" align="center" style="display: table;">
						<tbody>
							<tr>
								<td class="label">商品名称：</td>
								<td><input type="text" name="goods_name" value="<?php echo $data['goods_name']; ?>" size="30"><span class="require-field">*</span></td>
							</tr>
							<tr>
								<td class="label">商品货号： </td>
								<td><input type="text" name="goods_sn" value="<?php echo $data['goods_sn']; ?>" size="20" onblur="checkGoodsSn(this.value,'32')"><span
									 id="goods_sn_notice"></span><br>
									<span class="notice-span" style="display:block" id="noticeGoodsSN">如果您不输入商品货号，系统将自动生成一个唯一的货号。</span></td>
							</tr>

							<tr>
								<td class="label">商品分类：</td>
								<td>
									<select name="cat_id">
										<option value="0">请选择...</option>
										<?php foreach($cat_list as $v): if($v['id']==$data['cat_id']): ?>  <!-- 如果条件成立就加一个选中的option 标签  默认选中 -->
											<option value="<?php echo $v['id']; ?>" selected><?php echo $v['cat_name']; ?></option>
											<?php else: ?>                                <!-- 如果不else 就不会出来所有分类 -->
											<option value="<?php echo $v['id']; ?>"><?php echo $v['cat_name']; ?></option> <!-- 不成立就加一个不选中的option的标签 所有分类都会出来 -->
											<?php endif; endforeach; ?>
									</select>
								</td>
							</tr>
							<tr>
								<td class="label">本店售价：</td>
								<td><input type="text" name="shop_price" value="<?php echo $data['shop_price']; ?>" size="20" onblur="priceSetted()">
									<!-- <input type="button" value="按市场价计算" onclick="marketPriceSetted()"> -->
									<span class="require-field">*</span></td>
							</tr>
							<tr>
								<td class="label"><a href="javascript:showNotice('noticeStorage');" title="点击此处查看提示信息"><img src="images/notice.gif"
										 width="16" height="16" border="0" alt="点击此处查看提示信息"></a> 商品库存数量：</td>
								<!--            <td><input type="text" name="goods_number" value="4" size="20" readonly="readonly" /><br />-->
								<td><input type="text" name="stock" value="<?php echo $data['stock']; ?>" size="20"><br>
									<span class="notice-span" style="display:block" id="noticeStorage">库存在商品为虚货或商品存在货品时为不可编辑状态，库存数值取决于其虚货数量或货品数量</span></td>
							</tr>
							<tr>
								<td class="label">上传商品图片：</td>
								<td>
									<input type="file" name="goods_img" size="35">
								</td>
							</tr>
						</tbody>
					</table>

					
					<div class="button-div">
						<input type="submit" class="updBtn"  ip="<?php echo $data['id']; ?>" value=" 确定 " class="button" onclick="validate('32')">
					</div>
				</form>
			</div>
		</div>


		<div id="footer">版权所有</div>
		<script type="text/javascript" src="js/tab.js"></script>
		<script type="text/javascript">
			function addImg(obj) {
				var src = obj.parentNode.parentNode;
				var idx = rowindex(src);
				var tbl = document.getElementById('gallery-table');
				var row = tbl.insertRow(idx + 1);
				var cell = row.insertCell(-1);
				cell.innerHTML = src.cells[0].innerHTML.replace(/(.*)(addImg)(.*)(\[)(\+)/i, "$1removeImg$3$4-");
			}

			function removeImg(obj) {
				var row = rowindex(obj.parentNode.parentNode);
				var tbl = document.getElementById('gallery-table');
				tbl.deleteRow(row);
			}

			function dropImg(imgId) {
				Ajax.call('goods.php?is_ajax=1&act=drop_image', "img_id=" + imgId, dropImgResponse, "GET", "JSON");
			}

			function dropImgResponse(result) {
				if (result.error == 0) {
					document.getElementById('gallery_' + result.content).style.display = 'none';
				}
			}
		</script>
		<script>
			$('select option[value="<?php echo $data['cat_id']; ?>"]').attr("selected","true")

			$('.updBtn').click(function(){

			})
		</script>
	</body>
</html>
