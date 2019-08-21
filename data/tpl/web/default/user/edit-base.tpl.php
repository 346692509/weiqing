<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div id="js-user-edit-base" ng-controller="UserProfileDisplay" ng-cloak>
	<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('user/edit-header', TEMPLATE_INCLUDEPATH)) : (include template('user/edit-header', TEMPLATE_INCLUDEPATH));?>

	<table class="table we7-table table-hover table-form">
		<col width="140px " />
		<col />
		<col width="120px" />
		<tr>
			<th class="text-left" colspan="3">账户设置设置</th>
		</tr>
		<tr>
			<td class="table-label">头像</td>
			<td><img ng-src="{{profile.avatar}}" class="img-circle user-avatar" width="65px" height="65px" /></td>
			<td><div class="link-group"><a href="javascript:;" ng-click="changeAvatar()">修改</a></div></td>
		</tr>
		<tr>
			<td class="table-label">用户名</td>
			<td ng-bind="user.username"></td>
			<td><div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#name" ng-click="editInfo('username', user.username)">修改</a></div></td>
		</tr>
		<tr>
			<td class="table-label">密码</td>
			<td>******</td>
			<td><div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#pass">修改</a></div></td>
		</tr>
		
		<?php  if(!empty($user['founder_groupid'])) { ?>
		<tr>
			<td class="table-label">注册链接</td>
			<td><?php  echo $user['url'];?></td>
			<td><div class="link-group"><a href="javascript:;" data-url="<?php  echo $user['url'];?>" class="js-clip">复制链接</a></div></td>
		</tr>
		<?php  } ?>
	</table>
	<div class="modal fade" id="name" role="dialog">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">修改用户名</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" ng-model="userOriginal.username" class="form-control" placeholder="用户名" />
						<span class="help-block"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="httpChange('username')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="pass" role="dialog">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">修改密码</div>
				</div>
				<div class="modal-body text-center">
					<div class="we7-form" style="width: 450px; margin: 0 auto;">
						<div class="form-group">
							<label for="" class="control-label col-sm-2">新密码</label>
							<div class="form-controls col-sm-10">
								<input type="password" value="" class="form-control new-password">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="control-label col-sm-2">确认新密码</label>
							<div class="form-controls col-sm-10">
								<input type="password" value="" class="form-control renew-password">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="httpChange('password')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="endtime" role="dialog">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">设置到期时间</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="radio" id="endtype-1" name="endtype" value="2" ng-model="user.endtype" ng-checked="user.endtime != 0"><label class="radio-inline" for="endtype-1">设置期限</label>
						<input type="radio" id="endtype-2" name="endtype" value="1" ng-model="user.endtype" ng-checked="user.endtime == 0"><label class="radio-inline" for="endtype-2">永久</label>
					</div>
					<div class="form-group" ng-show="user.endtype == 2">
						<?php  echo tpl_form_field_date('endtime', $user['endtime']);?>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="httpChange('endtime')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<table class="table we7-table table-hover table-form">
		<col width="140px " />
		<col />
		<col width="100px" />
		<tr>
			<th class="text-left" colspan="3">基础信息</th>
		</tr>
		<tr>
			<td class="table-label">真实姓名</td>
			<td ng-bind="profile.realname"></td>
			<td><div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#realname" ng-click="editInfo('realname', profile.realname)">修改</a></div></td>
		</tr>
		<tr>
			<td class="table-label">出生年月日</td>
			<td ng-bind="profile.births"></td>
			<td><div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#birth">修改</a></div></td>
		</tr>
		<tr>
			<td class="table-label">QQ</td>
			<td ng-bind="profile.qq"></td>
			<td><div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#qq" ng-click="editInfo('qq', profile.qq)">修改</a></div></td>
		</tr>
		<tr>
			<td class="table-label">手机号</td>
			<td ng-bind="profile.mobile"></td>
			<td><div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#mobile" ng-click="editInfo('mobile', profile.mobile)">修改</a></div></td>
		</tr>
		<tr>
			<td class="table-label">邮寄地址</td>
			<td ng-bind="profile.address"></td>
			<td><div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#address" ng-click="editInfo('address', profile.address)">修改</a></div></td>
		</tr>
		<tr>
			<td class="table-label">居住地址</td>
			<td ng-bind="profile.resides"></td>
			<td><div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#reside">修改</a></div></td>
		</tr>
		<!-- 拓展字段 start -->
		<tr ng-repeat="field in extra_fields">
			<td class="table-label" ng-bind="field.title"></td>
			<td ng-bind="profile[field.field]"></td>
			<td><div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#extra" ng-click="editExtra(field, profile )">修改</a></div></td>
		</tr>
		<!-- 拓展字段 end -->
		<tr>
			<td class="table-label">上次登录时间</td>
			<td ng-bind="user.last_visit"></td>
			<td></td>
		</tr>
		<tr>
			<td class="table-label">上次登录IP</td>
			<td ng-bind="user.lastip"></td>
			<td></td>
		</tr>
		<tr>
			<td class="table-label">注册时间</td>
			<td ng-bind="user.joindate"></td>
			<td></td>
		</tr>
		<tr>
			<td class="table-label">到期时间</td>
			<td ng-bind="user.end"></td>
			<td ng-if="false"><div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#endtime">修改</a></div></td>
			<?php  if($user['founder_groupid'] == ACCOUNT_MANAGE_GROUP_VICE_FOUNDER) { ?>
			<td><a href="<?php  echo url('founder/edit/edit_modules_tpl', array('uid' => $uid));?>" class="color-default">修改</a></td>
			<?php  } else { ?>
			<td><a href="<?php  echo url('user/edit/edit_account_dateline', array('uid' => $uid));?>" class="color-default">修改</a></td>
			<?php  } ?>
		</tr>
		

		
			<?php  if($_W['isfounder']) { ?>
			<tr>
				<td class="table-label">备注</td>
				<td ng-bind="user.remark"></td>
				<td><div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#remark" ng-click="editInfo('remark', user.remark)">修改</a></div></td>
			</tr>
			<?php  } ?>
		

	</table>
	<div class="modal fade" id="realname" role="dialog">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">修改真实姓名</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" ng-model="userOriginal.realname">
						<span class="help-block">请填写真实姓名</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="httpChange('realname')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="birth" role="dialog">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">修改出生年月日</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<?php  echo tpl_fans_form('birth',$profile['birth']);?>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="httpChange('birth')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="address" role="dialog">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">修改邮寄地址</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input class="form-control" type="text" ng-model="userOriginal.address">
						<span class="help-block">请填写详细地址</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="httpChange('address')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="reside" role="dialog">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">修改居住地址</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<?php  echo tpl_fans_form('reside',$profile['reside']);?>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="httpChange('reside')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="qq" role="dialog">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">修改QQ</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" ng-model="userOriginal.qq" class="form-control" placeholder="qq" />
						<span class="help-block"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="httpChange('qq')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="remark" role="dialog">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">修改备注</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" ng-model="userOriginal.remark" class="form-control" placeholder="备注" />
						<span class="help-block"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="httpChange('remark')"  ng-click="editInfo('remark', user.remark)">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="mobile" role="dialog">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">修改手机号</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" ng-model="userOriginal.mobile" class="form-control" placeholder="mobile" />
						<span class="help-block"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="httpChange('mobile')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="vice_founder_name" role="dialog">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">修改副创始人姓名</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" ng-model="userOriginal.vice_founder_name" class="form-control" placeholder="副创始人姓名" />
						<span class="help-block"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="httpChange('vice_founder_name')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>

	<!-- 修改拓展字段模态框 start -->
	<div class="modal fade" id="extra" role="dialog">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">修改{{ edit_extra_filed.title }}</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" ng-model="edit_extra_field_val" class="form-control" placeholder="{{ edit_extra_filed.title }}" />
						<span class="help-block"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="httpChange(edit_extra_filed.field)">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<!-- 修改拓展字段模态框 end -->

</div>
<script>
require(['underscore'], function(){
	angular.module('userProfile').value('config', {
		user: <?php echo !empty($user) ? json_encode($user) : 'null'?>,
		profile: <?php echo !empty($profile) ? json_encode($profile) : 'null'?>,
		account_num: <?php echo !empty($account_num) ? json_encode($account_num) : 'null'?>,
		extra_fields: <?php echo !empty($extra_fields) ? json_encode($extra_fields) : 'null'?>,
		links: {
			userPost: "<?php  echo url('user/profile/post')?>",
			recycleUser: "<?php  echo url('user/display/operate', array('type' => 'recycle'))?>",
		},
	});
	angular.bootstrap($('#js-user-edit-base'), ['userProfile']);
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>