<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('profile/common', TEMPLATE_INCLUDEPATH)) : (include template('profile/common', TEMPLATE_INCLUDEPATH));?>
<div id="js-profile-tplnotice" ng-controller="tplCtrl" ng-cloak>
	<table class="table we7-table table-form">
		<col width="200px " />
		<col />
		<col width="100px" />
		<tr>
			<th>设置通知模板</th>
			<th></th>
			<th></th>
		</tr>
		<tr ng-repeat="(key, tpl) in tplList track by key">
			<td class="text-left">
				{{ tpl.name }}
			</td>
			<td class="text-left color-gray">
				{{ tpl.tpl }}
			</td>
			<td >
				<div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#jsauth_acid" ng-click="changeActive(key)">修改</a></div>
			</td>
		</tr>
	</table>
	<div class="modal fade" id="jsauth_acid" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">{{ tplList[active]['name'] }}</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="" name="" id="" ng-model="activetpl" class="form-control" placeholder="{{ tplList[active]['name'] }}" />
						<span class="help-block">{{ tplList[active]['help'] }}</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="saveTpl()">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	angular.module('profileApp').value('config', {
		'tplList' : <?php  echo json_encode($tpl)?>,
		'url' : "<?php  echo url('profile/tplnotice/set')?>"
	});
	angular.bootstrap($('#js-profile-tplnotice'), ['profileApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>