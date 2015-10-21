<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>后台管理</title>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/admin.css";?>" />
	<meta name="robots" content="noindex,nofollow">
	<link rel="shortcut icon" href="favicon.ico" />
	<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/jquery/jquery-1.11.3.min.js"></script><script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/jquery/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artdialog/artDialog.js"></script><script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/runtime/_systemjs/artdialog/skins/aero.css" />
	<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/form/form.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/autovalidate/validate.js"></script><link rel="stylesheet" type="text/css" href="/runtime/_systemjs/autovalidate/style.css" />
	<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
	<script type='text/javascript' src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/common.js";?>"></script>
	<script type='text/javascript' src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/admin.js";?>"></script>
	<script type='text/javascript' src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/menu.js";?>"></script>
</head>
<body>
	<div class="container">
		<div id="header">
			<div class="logo">
				<a href="<?php echo IUrl::creatUrl("/system/default");?>"><img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/logo.gif";?>" width="303" height="43" /></a>
			</div>
			<div id="menu">
				<ul name="menu">
				</ul>
			</div>
			<p><a href="<?php echo IUrl::creatUrl("/systemadmin/logout");?>">退出管理</a> <a href="<?php echo IUrl::creatUrl("/system/admin_repwd");?>">修改密码</a> <a href="<?php echo IUrl::creatUrl("/system/default");?>">后台首页</a> <a href="<?php echo IUrl::creatUrl("");?>" target='_blank'>商城首页</a> <span>您好 <label class='bold'><?php echo isset($this->admin['admin_name'])?$this->admin['admin_name']:"";?></label>，当前身份 <label class='bold'><?php echo isset($this->admin['admin_role_name'])?$this->admin['admin_role_name']:"";?></label></span></p>
		</div>
		<div id="info_bar">
			<label class="navindex"><a href="<?php echo IUrl::creatUrl("/system/navigation");?>">快速导航管理</a></label>
			<span class="nav_sec">
			<?php $adminId = $this->admin['admin_id']?>
			<?php $query = new IQuery("quick_naviga");$query->where = "admin_id = $adminId and is_del = 0";$items = $query->find(); foreach($items as $key => $item){?>
			<a href="<?php echo isset($item['url'])?$item['url']:"";?>" class="selected"><?php echo isset($item['naviga_name'])?$item['naviga_name']:"";?></a>
			<?php }?>
			</span>
		</div>

		<div id="admin_left">
			<ul class="submenu"></ul>
			<div id="copyright"></div>
		</div>

		<div id="admin_right">
			<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/editor/kindeditor-min.js"></script><script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/editor/lang/zh_CN.js"></script><script type="text/javascript">window.KindEditor.options.uploadJson = "/index.php?controller=pic&action=upload_json";window.KindEditor.options.fileManagerJson = "/index.php?controller=pic&action=file_manager_json";</script>
<div class="headbar">
	<div class="position"><span>商品</span><span>></span><span>商品分类管理</span><span>></span><span>编辑分类</span></div>
</div>
<div class="content_box">
	<div class="content form_content">
		<form action="<?php echo IUrl::creatUrl("/goods/category_save");?>" method="post">
			<input name="id" value="" type="hidden" />
			<table class="form_table" cellpadding="0" cellspacing="0">
				<colgroup>
					<col width="150px" />
					<col />
				</colgroup>

				<tr>
					<th>分类名称：</th>
					<td>
						<input class="normal" name="name" type="text" value="" pattern="required" alt="分类名称不能为空" /><label>* 必选项</label>
					</td>
				</tr>
				<tr>
					<th>上级分类：</th>
					<td>
						<!--分类数据显示-->
						<span id="__categoryBox" style="margin-bottom:8px"></span>
						<script id="categoryButtonTemplate" type="text/html">
						<ctrlArea>
						<input type="hidden" value="<%=templateData['id']%>" name="parent_id" />
						<button class="btn" type="button" onclick="return confirm('确定删除此分类？') ? $(this).parent().remove() : '';">
							<span class="del"><%=templateData['name']%></span>
						</button>
						</ctrlArea>
						</script>
						<button class="btn" type="button" onclick="selectGoodsCategory('<?php echo IUrl::creatUrl("/block/goods_category/type/radio");?>','parent_id')"><span class="add">设置分类</span></button>
						<label>如果不选择上级分类，默认为顶级分类</label>
					</td>
				</tr>
				<tr>
					<th>首页是否显示：</th>
					<td>
						<label class='attr'><input name="visibility" type="radio" value="1" checked="checked" /> 是 </label>
						<label class='attr'><input name="visibility" type="radio" value="0" /> 否 </label>
					</td>
				</tr>
				<tr>
					<th>排序：</th><td><input class="normal" name="sort" pattern='int' empty alt='排序必须是一个数字' type="text" value=""/></td>
				</tr>
				<tr>
					<th>SEO标题：</th><td><input class="normal" name="title" type="text" value="" /></td>
				</tr>
				<tr>
					<th>SEO关键词：</th><td><input class="normal" name="keywords" type="text" value="" /></td>
				</tr>
				<tr>
					<th>SEO描述：</th><td><textarea name="descript" cols="" rows=""></textarea></td>
				</tr>
				<tr>
					<td></td><td><button class="submit" type="submit"><span>确 定</span></button></td>
				</tr>
			</table>
		</form>
	</div>
</div>

<script type="text/javascript">
$(function()
{
	var formObj = new Form();
	formObj.init(<?php echo JSON::encode($this->categoryRow);?>);
})
//商品分类回填
<?php if(isset($this->categoryRow['parent_id'])){?>
<?php $categoryId = $this->categoryRow['parent_id']?>
<?php $query = new IQuery("category");$query->where = "id in ($categoryId)";$categoryData = $query->find(); foreach($categoryData as $key => $item){?><?php }?>
createGoodsCategory(<?php echo JSON::encode($categoryData);?>);
<?php }?>
</script>
		</div>
	</div>

	<script type='text/javascript'>
		//DOM加载完毕执行
		$(function(){
			//隔行换色
			$(".list_table tr:nth-child(even)").addClass('even');
			$(".list_table tr").hover(
				function () {
					$(this).addClass("sel");
				},
				function () {
					$(this).removeClass("sel");
				}
			);

			//后台菜单创建
			<?php $menu = new Menu($this->admin);?>
			var data = <?php echo $menu->submenu();?>;
			var current = '<?php echo $menu->current;?>';
			var url='<?php echo IUrl::creatUrl("/");?>';
			initMenu(data,current,url);
		});
	</script>
</body>
</html>
