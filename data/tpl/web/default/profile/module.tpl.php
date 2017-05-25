<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="we7-page-title">
	应用 
</div>

<ul class="we7-page-tab">
</ul>
<div class="we7-page-search">
	<form method="get" class="form-inline">
		<input type="hidden" name="c" value="profile">
		<input type="hidden" name="a" value="module">
		<input type="hidden" name="letter" value="<?php  echo $_GPC['letter'];?>">
		<div class="input-group we7-margin-bottom col-sm-4">
			<input class="form-control " name="keyword" value="<?php  echo $keyword;?>" type="text" placeholder="名称" >
			<span class="input-group-btn"><button class="btn btn-default"><i class="fa fa-search"></i></button></span>
		</div>
	</form>
</div>
<div class="js-module-display" ng-controller="ModuleMoreCtrl" ng-cloak>
	<div we7-initial-searchbar we7-search-callback="searchModule(letter)"></div>
	<div class="ext-apply-list clearfix">
		<?php  if(is_array($modules)) { foreach($modules as $row) { ?>
		<div class="ext-apply-item <?php  if($row['shortcut']) { ?>apply-show<?php  } ?>"  ng-show="activeLetter ? activeLetter == '<?php  echo $row['first_pinyin'];?>' : '1'">
			<img src="<?php  echo $row['preview'];?>" class="apply-img <?php  if(!$row['enabled']) { ?>gray<?php  } ?>" />
			<h2 class="apply-title"><?php  echo $row['title'];?></h2>
			<span class="color-green">
				<?php  if($row['enabled']) { ?>
					启用
				<?php  } else { ?>
					禁用
				<?php  } ?>
			</span>
			<div class="cover-dark">
				<a href="<?php  echo url('home/welcome/ext', array('m' => $row['name']));?>" class="mange-goto"><i class="fa fa-angle-right"></i>进入应用</a>
				<?php  if($row['shortcut']) { ?>
				<a href="<?php  echo url('profile/module/shortcut', array('modulename' => $row['name'], 'shortcut' => STATUS_OFF))?>" onclick="return ajaxopen(this.href);" class="manage-show"><i class="wi wi-remove"></i> <span>移出菜单</span></a>
				<?php  } else { ?>
				<a href="<?php  echo url('profile/module/shortcut', array('modulename' => $row['name'], 'shortcut' => STATUS_ON))?>" onclick="return ajaxopen(this.href);" class="manage-show"><i class="wi wi-eye"></i> <span>显示到菜单</span></a>
				<?php  } ?>
				<a href="<?php  echo url('profile/module/top', array('modulename' => $row['name']))?>" class="manage-stick"><i class="wi wi-stick-sign"></i><span>置顶</span></a>
			</div>
		</div>
		<?php  } } ?>
	</div>
	<div class="pull-right"><?php  echo $pager;?></div>
</div>
<script type="text/javascript">
	angular.module('moduleApp').value('config', {
		searchurl : '<?php  echo url('profile/module', array('keyword' => $_GPC['keyword']))?>'
	});
	angular.bootstrap($('.js-module-display'), ['moduleApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
