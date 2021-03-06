<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"C:\phpstudy_pro\WWW\TP5.0\public/../application/admin\view\goods\goods_list.html";i:1573560023;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title></title>
	<base href="http://www.tp5.com/static/" />
	<link href="styles/general.css" rel="stylesheet" type="text/css" />
	<link href="styles/main.css" rel="stylesheet" type="text/css" />
	<script src="js/jQuery-3.4.0.js"></script>
</head>
<body>
<h1>
	<span class="action-span"><a href="/admin/Goods/goods_add">添加新商品</a></span>
	<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品列表 </span>
	<div style="clear:both"></div>
</h1>

<div class="form-div">
  <form action="/admin/Goods/search" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH">
	<!-- 关键字 -->
		关键字 <input type="text" name="keyword" size="15">
		<input type="submit" value=" 搜索 " class="button">
  </form>
</div>

<form method="post" action="" name="listForm" onsubmit="return confirmSubmit(this)">
  <div class="list-div" id="listDiv">
		<table cellpadding="3" cellspacing="1">
			<tbody>
				<tr>
					<th><input type="checkbox" class="allSelect">编号</th>
					<th>商品名称</th>
					<th>货号</th>
					<th>价格</th>
					<th>商品图片</th>
					<th>上架</th>
					<th>库存</th>
					<!-- <th>精品</th>
					<th>热销</th> -->
					<th>操作</th>
				</tr>
				<tr></tr>

				<?php foreach($data as $v): ?>
					<tr>
						<td><input type="checkbox" class="one" name="checkboxes[]" value="<?php echo $v['id']; ?>"><?php echo $v['id']; ?></td>
						<td class="first-cell"><span><?php echo $v['goods_name']; ?></span></td>
						<td><span><?php echo $v['goods_sn']; ?></span></td>
						<td align="right"><span><?php echo $v['shop_price']; ?></span></td>
						<td><img src="<?php echo $v['goods_img']; ?>" alt="" width="30" height="30" /></td>
						<td align="center">
							<img class="putaway" ip = "<?php echo $v['id']; ?>" is_sale="<?php echo $v['is_sale']; ?>" src="images/<?php if($v['is_sale']==1): ?>yes<?php else: ?>no<?php endif; ?>.gif" onclick="">
						</td>
						<!-- <td align="center">
							<img src="images/<?php if($v['is_sale']==1): ?>yes<?php else: ?>no<?php endif; ?>.gif" onclick="">
						</td>
						<td align="center">
							<img src="images/<?php if($v['is_sale']==1): ?>yes<?php else: ?>no<?php endif; ?>.gif" onclick="">
						</td>
						<td align="center">
							<img src="images/<?php if($v['is_sale']==1): ?>yes<?php else: ?>no<?php endif; ?>.gif" onclick="">
						</td> -->
						<td align="right"><span><?php echo $v['stock']; ?></span></td>
						<td align="center"  ip='<?php echo $v['id']; ?>'>
							<a href="/admin/Goods/goods_edit?ip=<?php echo $v['id']; ?>" class="detBtn" title="编辑"><img src="images/icon_edit.gif" width="16" height="16" border="0"></a>
							<!-- /admin/Goods/goods_edit -->
							<a href="goods.php?act=copy&amp;goods_id=32" title="复制"><img src="images/icon_copy.gif" width="16" height="16" border="0"></a>
							<a class="delBtn" href="/admin/Goods/del?id=<?php echo $v['id']; ?>"  title="回收站"><img src="images/icon_trash.gif" width="16" height="16" border="0"></a>
							<a href="goods.php?act=product_list&amp;goods_id=32" title="货品列表"><img src="images/icon_docs.gif" width="16" height="16" border="0"></a>
						</td>
					</tr>
				<?php endforeach; ?>
  </tbody>
 </table></div>
</form>
	<!-- 分页 -->
	<table id="page-table" cellspacing="0">
		<tbody>
			<tr>
				<td align="right" nowrap="true" style="background-color: rgb(255, 255, 255);">
					<!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
					<div id="turn-page">
						<?php echo $data->render(); ?>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<div>
	<input type="hidden" name="act" value="batch">
	<select name="type" id="selAction" onchange="changeAction()">
		<option value="">请选择...</option>
		<option value="trash">回收站</option>
		<option value="on_sale">上架</option>
		<option value="not_on_sale">下架</option>
		<option value="best">精品</option>
		<option value="not_best">取消精品</option>
		<option value="new">新品</option>
		<option value="not_new">取消新品</option>
		<option value="hot">热销</option>
		<option value="not_hot">取消热销</option>
		<option value="move_to">转移到分类</option>
		<option value="suppliers_move_to">转移到供货商</option>
	</select>

    <input type="hidden" name="extension_code" value="">
    <input type="submit" value=" 确定 " id="btnSubmit" name="btnSubmit" class="button" disabled="true">
</div>
</form>

<div id="footer">版权所有</div>

</body>
<script>
	$('.allSelect').click(function(){
		$('.one').prop("checked",$(this).prop("checked"));
	})
	$(".one").click(function(){
		$(".allSelect").prop("checked",$(".one:checked").length==$(".one").length);
	})

	$('.delBtn').click(function(){
		var ip = $(this).parents('td').attr('ip')
		var is_sale = $(this).attr('is_sale')

		$.ajax({
			url:'/admin/Goods/goods_del',
            //             模块  控制器 方法
            type:'post',
            dataType:'json',
            data:{
                "ip":ip,
                "is_sale":is_sale
            },
            success:(res)=>{
                if (res.error_code == 1) {
                    alert(res.error_msg)
                }else{
                    alert(res.error_msg)
                    // $(".delBtn[ip="+ip+"]").parents('tr').remove();
                    $(this).parents('tr').remove();
                }
            },
            error:function(){
                
            }
		})
	})
	$(".putaway").click(function(){
		var ip = $(this).attr('ip');
		$.ajax({
			url:'/admin/Goods/putaway',
			type:'POST',
			dataType:'json',
			data:{ip},
			success:function(res){
				location.href = '/admin/Goods/goods_list'
				alert(res.error_msg)
			}
		})
	})
</script>
</html>