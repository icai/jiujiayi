<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php  if($do == 'fans_sync_set') { ?>
<div class="we7-page-title">
	粉丝管理
</div>
<ul class="we7-page-tab">
	<li class="">
		<a href="<?php  echo url('mc/fans')?>" >全部粉丝</a>
	</li>
	<li class="active">
		<a href="<?php  echo url('mc/fans/fans_sync_set')?>">粉丝同步设置</a>
	</li>
</ul>
<div id="js-profile-sync" ng-controller="syncCtrl" ng-cloak>
	<table class="table we7-table table-hover table-form">
		<col width="140px " />
		<col />
		<col width="140px" />
		<tr>
			<th class="text-left" colspan="3">粉丝同步</th>
		</tr>
		<tr>
			<td >是否开启</td>
			<td>
				{{ syncSetting == 1 ? '开启' : '关闭' }}
			</td>
			<td class="text-center">
				<label>
					<input name="" class="form-control" type="checkbox"  style="display: none;">
					<div ng-class="syncSetting == 1 ? 'switch switchOn' : 'switch'"  ng-click="setSync()"></div>
				</label>
			</td>
		</tr>
	</table>

</div>

<script>
	angular.module('profileApp').value('config', {
		'syncSetting' : "<?php  echo $sync_setting;?>",
		'saveSyncSetting' : "<?php  echo url('mc/fans/fans_sync_set', array('operate' => 'save_setting'))?>"
	});
	angular.bootstrap($('#js-profile-sync'), ['profileApp']);
</script>
<?php  } else { ?>
<div id="main" ng-controller="DisplayCtrl" ng-cloak>
<div class="we7-page-title">
	粉丝管理
</div>
<ul class="we7-page-tab">
	<li class="active">
		<a href="<?php  echo url('mc/fans')?>" >全部粉丝</a>
	</li>
	<li class="">
		<a href="<?php  echo url('mc/fans/fans_sync_set')?>">粉丝同步设置</a>
	</li>
</ul>
<div class="we7-page-search we7-padding-bottom clearfix">
	<div class="pull-right">
		<button class="btn btn-primary we7-padding-horizontal add-group" data-toggle="popover">+添加分组</button>
	</div>
	<form action="" method="post" class="form-inline" role="form">
		<div class="form-group">
			<div class="form-controls">
				<select name="follow" class="we7-select" >
					<option value="1" <?php  if($follow == 1) { ?>selected<?php  } ?>>已关注</option>
					<option value="2" <?php  if($follow == 2) { ?>selected<?php  } ?>>取消关注</option>
				</select>
			</div>
		</div>
		<div class="form-group we7-margin-left-sm">
			<?php  echo tpl_form_field_daterange('time', array('start' => date('Y-m-d', $starttime), 'end' => date('Y-m-d', $endtime)))?>
		</div>
		<div class="form-group we7-margin-left-sm">
			<div class="input-group col-sm-12" >
				<div class="input-group-btn">
					<button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false"> {{ searchMod == 1 ? '精确' : '模糊'}}
						<span class="caret"></span>
					</button>
					<ul role="menu" class="dropdown-menu">
						<li>
							<a href="javascript:;" ng-click="switchSearchMod(1)">精确</a>
						</li>
						<li>
							<a href="javascript:;" ng-click="switchSearchMod(2)">模糊</a>
						</li>
					</ul>
				</div>
				<input name="search_mod" type="text" style="display:none;" ng-model="searchMod">
				<input name="nickname" value="<?php  echo $nickname;?>" class="form-control" placeholder="" type="text">
				<span class="input-group-btn"><button class="btn btn-default"><i class="fa fa-search"></i></button></span>
			</div>
		</div>
		
		<input name="tag" value="<?php  echo $tag;?>" type="hidden">
	</form>
</div>
<div class="popover-add-group" style="display: none;">
	<div class="input-group" style="width: 250px;">
		<p>标签名称</p>
		<input name="addtag" value="" class="form-control" placeholder="分组名称" type="text">
	</div>
	<div class="popover-btn we7-margin-top-sm">
		<a href="javascript:;" class="btn btn-primary we7-margin-right-sm" onclick="addTag()">确定</a>
		<a href="javascript:;"  class="btn btn-default popover-hide">取消</a>
	</div>
</div>


<div class="fans-content">
	<div class="fans-list">
		<div class="panel we7-panel">
			<div class="panel-heading">
				<?php  if(empty($tag)) { ?>全部<?php  } else { ?><?php  echo $fans_tag[$tag]['name'];?>
				<a href="javascript:;" class="color-default fans-group-edit we7-margin-left-sm edit-group" data-toggle='popover'>重命名</a>
				<a href="javascript:;" class="color-default fans-group-del we7-margin-left-sm" data-toggle='popover'>删除</a>
				<?php  } ?>
				<div class="pull-right we7-form">
						<input id='credit1' type="radio" name='1' <?php  if($type == '') { ?>checked='checked'<?php  } ?> onclick="changetype('')" />
						<label for="credit1">全部</label>
						<input id='credit3' type="radio" name='1' <?php  if($type == 'bind') { ?>checked='checked'<?php  } ?> onclick="changetype('bind')"/>
						<label for="credit3">
						会员
						</label>
					<script>
						changetype = function(type) {
							if (type == '') {
								url = "<?php  echo url('mc/fans', array('follow' => $follow, 'time[start]' => date('Y-m-d', $starttime), 'time[end]' => date('Y-m-d', $endtime), 'nickname' => $nickname, 'tag' => $tag, 'type' => ''))?>"
							} else {
								url = "<?php  echo url('mc/fans', array('follow' => $follow, 'time[start]' => date('Y-m-d', $starttime), 'time[end]' => date('Y-m-d', $endtime), 'nickname' => $nickname, 'tag' => $tag, 'type' => 'bind'))?>"
							}
							location.href = url;
						}
					</script>
				</div>
			</div>
			<div class="panel-body">
				<table class="table we7-table table-hover fans-info vertical-middle">
					<col width="20px" />
					<col width="60px"/>
					<col />
					<col />
					<tr>
						<th class="text-left" colspan="4">
							<div class="we7-form">
								<input id='checkall' type="checkbox" we7-check-all="1" name='openid[]' onclick="checkall()"/>

								<label for="checkall">全选 </label>
								<script>
									checkall = function() {
										check = $('#checkall').prop('checked') ==  true ? 'checked' : '';
										$('.openid').prop('checked', check);
									}
								</script>
								<a href="javascript:;" class="btn btn-primary test we7-margin-left-sm batch-group" data-toggle='popover' >打标签</a>
								<a href="javascript:;" class="btn btn-default we7-margin-left-sm" ng-click="sync('check')">同步选中粉丝信息</a>
								<a href="javascript:;" class="btn btn-default we7-margin-left-sm" ng-click="downloadFans()">同步全部粉丝信息</a>
							</div>
						</th>
					</tr>
					<?php  if(is_array($fans_list)) { foreach($fans_list as $fan) { ?>
					<tr>
						<td>
							<div class="we7-form">
								<input id='option[<?php  echo $fan['fanid'];?>]' type="checkbox" we7-check-all="1" class="openid" name='openid[]' value="<?php  echo $fan['openid'];?>"/>
								<label for="option[<?php  echo $fan['fanid'];?>]"> </label>
							</div>
						</td>
						<td>
							<a href="<?php  echo url('mc/chats', array('openid' => $fan['openid']))?>" target="_blank" class="avatar">
								<img src="<?php  echo tomedia($fan['tag']['headimgurl'])?>" width="48" />
							</a>
						</td>
						<td>
							<p><a href="<?php  echo url('mc/chats', array('openid' => $fan['openid']))?>" target="_blank" class="nick-name" data-fanid="<?php  echo $fan['fanid'];?>" data-group="<?php  echo $fan['groupid'];?>"><?php  echo $fan['nickname'];?></a></p>
							<p class="remark-name"><a href=""><?php  echo $fan['member']['realname'];?></a> <?php  if(!empty($fan['member']['mobile'])) { ?><i class="wi wi-iphone fans-tel"></i><?php  } ?></p>
							<div class="fans-tag-area">
								<span class="tag-list put-group get-fans-tag js-group" data-id="<?php  echo $fan['fanid'];?>" data-toggle='popover'>
									<?php  if(is_array($fan['tag_show'])) { foreach($fan['tag_show'] as $k => $tag_show) { ?>
									<?php  if($k == 0 && $tag_show == '无标签') { ?>
									无标签
									<?php  } else { ?>
									<a href="javascript:;" class="label label-primary"><?php  echo $tag_show;?></a>
									<?php  } ?>
									<?php  } } ?>
									<span class="tag-btn" >
										<i class="caret"></i>
									</span>
								</span>

							</div>
						</td>
						<td>
							<?php  if(empty($fan['follow'])) { ?>
							<p>取消关注：<?php  echo date('Y-m-d H:i:s', $fan['unfollowtime'])?></p>
							<?php  } else { ?>
							<p>关注：<?php  echo date('Y-m-d H:i:s', $fan['followtime'])?></p>
							<?php  } ?>
						</td>
					</tr>
					<?php  } } ?>
				</table>
			</div>
		</div>
	</div>
	<div class="fans-group-list">
		<dl>
			<dt class="fans-group-item">
				<a href="<?php  echo url('mc/fans', array('follow' => $follow, 'nickname' => $nickname, 'tag' => 0, 'time[start]' => date('Y-m-d', $starttime), 'time[end]' => date('Y-m-d', $endtime)))?>">全部用户（<?php  echo $fans['total'];?>）</a>
			</dt>
			<?php  if(is_array($fans_tag)) { foreach($fans_tag as $tag_info) { ?>
			<dd class="fans-group-item <?php  if($tag == $tag_info['id']) { ?>active<?php  } ?>">
				<a href="<?php  echo url('mc/fans', array('follow' => $follow, 'nickname' => $nickname, 'tag' => $tag_info['id'], 'time[start]' => date('Y-m-d', $starttime), 'time[end]' => date('Y-m-d', $endtime)))?>"><?php  echo $tag_info['name'];?>（<?php  echo $tag_info['count'];?>）</a>
			</dd>
			<?php  } } ?>
		</dl>
	</div>
</div>
	<div class="popover-edit-group" style="display: none;">
		<div class="input-group" style="width: 250px;">
			<p>标签名称</p>
			<input name="edittag" value="" class="form-control" placeholder="分组名称" type="text">
		</div>
		<div class="popover-btn we7-margin-top-sm">
			<a href="javascript:;" class="btn btn-primary we7-margin-right-sm" onclick="editTagName()">确定</a>
			<a href="javascript:;"  class="btn btn-default popover-hide">取消</a>
		</div>
	</div>

	<div class="popover-del-group" style="display: none;">
		<div class="input-group" style="width: 250px;">
			<p>删除标签后，该标签下的所有用户将失去该标签属性。是否确定删除？</p>
		</div>
		<div class="popover-btn we7-margin-top-sm">
			<a href="javascript:;" class="btn btn-primary we7-margin-right-sm" onclick="delTag()">确定</a>
			<a href="javascript:;"  class="btn btn-default popover-hide">取消</a>
		</div>
	</div>
	<div class="popover-group-list" >

	</div>
	<div class="pull-right we7-margin-top">
		<?php  echo $pager;?>
	</div>
</div>
<script>
	$("[data-toggle='popover']").on('show.bs.popover', function () {
		$("[aria-describedby]").popover('hide');
	});
	$(function(){
		var uid = '';
		$(".add-group").popover({
			placement : 'bottom',
			html : true,
			template : '<div class="popover we7-popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
			content : $('.popover-add-group').html(),
		});
		$(".edit-group").popover({
			placement : 'bottom',
			html : true,
			template : '<div class="popover we7-popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
			content : $('.popover-edit-group').html(),
		});
		$(".fans-group-del").popover({
			placement : 'bottom',
			html : true,
			template : '<div class="popover we7-popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
			content : $('.popover-del-group').html(),
		});

		$(".put-group").popover({
			placement : 'bottom',
			html : true,
			template : '<div class="popover we7-popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
			content : '' +
			'<div class="we7-form">' +
				'<div class="form-group row">'+
					<?php  if(is_array($fans_tag)) { foreach($fans_tag as $tags) { ?>
					'<div class="col-sm-4" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><input id="option<?php  echo $tags['id'];?>" data-tag="<?php  echo $tags['id'];?>" type="checkbox" name="tagname" value="<?php  echo $tags['id'];?>" />' +
					'<label for="option<?php  echo $tags['id'];?>"><?php  echo $tags['name'];?> </label>' +
		'<input type="hidden" name="fanid"  /></div>' +
		<?php  } } ?>
				'</div>' +
			'</div>' +
			'<div class="popover-btn we7-margin-top-sm">' +
			'<a href="javascript:;" class="btn btn-primary we7-margin-right-sm" onclick="editFansTag()">确定</a>' +
			'<a href="javascript:;"  class="btn btn-default popover-hide">取消</a>' +
			'<script type="text/javascript">$(":radio,:checkbox").we7_check();<\/script>' +
			'</div>',
		});

		$(".batch-group").popover({
			placement : 'bottom',
			html : true,
			template : '<div class="popover we7-popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
			content : '' +
			'<div class="we7-form">' +
			'<div class="form-group">'+
			<?php  if(is_array($fans_tag)) { foreach($fans_tag as $tags) { ?>
			'<input id="option<?php  echo $tags['id'];?>" data-tag="<?php  echo $tags['id'];?>" type="checkbox" name="tagname" value="<?php  echo $tags['id'];?>" />' +
					'<label for="option<?php  echo $tags['id'];?>"><?php  echo $tags['name'];?> </label>' +
			<?php  } } ?>
		'</div>' +
		'</div>' +
		'<div class="popover-btn we7-margin-top-sm">' +
		'<a href="javascript:;" class="btn btn-primary we7-margin-right-sm" onclick="batchEditFansTag()">确定</a>' +
		'<a href="javascript:;"  class="btn btn-default popover-hide">取消</a>' +
		'<script type="text/javascript">$(":radio,:checkbox").we7_check();<\/script>' +
		'</div>',
		});
		$('body').on('click', '.popover-hide', function(){
			$("[data-toggle='popover']").popover('hide');
		});
	});
	$('.get-fans-tag').click(function() {
	 fanid = $(this).data('id');
	 groupid = $('[data-fanid="'+fanid+'"]').data('group');
	 group = [];
	 groupid = groupid.toString();
	 group = groupid.split(',');
	 $('.check-tag').attr('checked', '');
	 for (var i = 0; i < group.length; i++) {
		$('[data-tag="'+group[i]+'"]').attr("checked",'checked');
	 }
	$('[name="fanid"]').val(fanid);
	 });

	batchEditFansTag = function() {
		$("[data-toggle='popover']").popover('hide');
		openids = $('.openid');
		openid = [];
		for(k in openids) {
			if (openids[k].checked) {
				openid.push(openids[k].value);
			}
		}
		tags = $('[name="tagname"]:checked');
		checktags = [];
		for(k in tags) {
			if (tags[k].checked) {
				checktags.push(tags[k].value);
			}
		}
		if (checktags.length > 3) {
			util.message('每个粉丝最多打3个标签', '', 'info');
			return false;
		}
		if (openid.length < 1) {
			util.message('请选择粉丝', '', 'info');
			return false;
		}
		if (checktags.length < 1) {
			util.message('请选择标签', '', 'info');
			return false;
		}
		$.post("<?php  echo url('mc/fans/batch_edit_fans_tag')?>", {'openid' : openid, 'tag' : checktags}, function(data) {
			data = $.parseJSON(data);
			if (data.message.errno == 0) {
				util.message('修改成功', '<?php  echo url('mc/fans')?>', 'success');
			} else {
				util.message(data.message.message, '', 'info');
			}
		});
	}

	editFansTag = function() {
		$("[data-toggle='popover']").popover('hide');
		tags = $('[name="tagname"]:checked');
		checktags = [];
		for(k in tags) {
			if (tags[k].checked) {
				checktags.push(tags[k].value);
			}
		}
		fanid = $('[name="fanid"]').val();
		$.post("<?php  echo url('mc/fans/edit_fans_tag')?>", {'tags' : checktags, 'fanid' : fanid}, function(data) {
			data = $.parseJSON(data);
			if (data.message.errno == 0) {
				util.message('设置成功', "<?php  echo url('mc/fans')?>", 'success');
			} else {
				util.message(data.message.message, "", 'info');
			}
		});
	}

	editTagName = function() {
		$("[data-toggle='popover']").popover('hide');
		tag = "<?php  echo $fans_tag[$tag]['id'];?>";
		tag_name = $('[name="edittag"]').val();
		$.post("<?php  echo url('mc/fans/edit_tagname')?>", {'tag' : tag, 'tag_name' : tag_name}, function(data) {
			data = $.parseJSON(data);
			if (data.message.errno == 0){
				util.message('修改成功', "<?php  echo url('mc/fans')?>", 'success');
			} else {
				util.message(data.message.message, '', 'info');
			}
		});
	}

	delTag = function() {
		$("[data-toggle='popover']").popover('hide');
		tag = "<?php  echo $fans_tag[$tag]['id'];?>";
		$.post("<?php  echo url('mc/fans/del_tag')?>", {'tag' : tag}, function(data) {
			data = $.parseJSON(data);
			if (data.message.errno == 0) {
				util.message('删除成功', "<?php  echo url('mc/fans')?>", 'success');
			} else {
				util.message(data.message.message, "", 'info');
			}
		});
		$("[data-toggle='popover']").popover('hide');
	};
	addTag = function() {
		$("[data-toggle='popover']").popover('hide');
		tag = $('[name="addtag"]').val();
		$.post("<?php  echo url('mc/fans/add_tag')?>", {'tag' : tag}, function(data) {
			data = $.parseJSON(data);
			if (data.message.errno != 0) {
				util.message(data.message.message, '', 'info');
				return false;
			} else {
				util.message('添加成功', "<?php  echo url('mc/fans/display')?>", 'ajax');
				return false;
			}
		});
	}


	window.onbeforeunload = function(e) {
		if(running) {
			return (e || window.event).returnValue = '正在进行微信素材数据同步，确定离开页面吗.';
		}
	}
	angular.module('fansApp').value('config', {
		'addTagUrl' : "<?php  echo url('mc/fans/add_tag')?>",
		'syncAllUrl' : "<?php  echo url('mc/fans/download_fans')?>",
		'syncUrl' : "<?php  echo url('mc/fans/sync')?>",
		'msgUrl' : "<?php  echo url('mc/fans')?>",
		'searchMod' : "<?php  echo $search_mod;?>"
	});
	angular.bootstrap($('#main'), ['fansApp']);
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>