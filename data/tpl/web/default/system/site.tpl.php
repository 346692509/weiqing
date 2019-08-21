<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div id="system-site-setting" ng-controller="systemSiteSettingCtrl" ng-cloak>
	<ul class="we7-page-tab">
		<li<?php  if($do == 'basic') { ?> class="active"<?php  } ?>><a href="<?php  echo url('system/site/basic');?>">基本信息</a></li>
		
	</ul>
	<div class="clearfix">
		<div class="form-files-box">
			<?php  if($do == 'basic') { ?>
			<div>
				<!-- 基本设置 start -->
				<div class="form-files we7-margin-bottom">
					<div class="form-file header">基本设置</div>
					<!-- 站点开关 start -->
					<div class="form-file">
						<div class="form-label">关闭站点</div>
						<div class="form-value"></div>
						<div class="form-edit">
							<label>
								<div ng-class="settings.status == undefined || settings.status == 0 ? 'switch' : 'switch switchOn'"  ng-click="saveSettingSwitch('status', settings.status)"></div>
							</label>
						</div>
					</div>
					<!-- 站点开关 end -->

					<!-- 关闭原因 start -->
					<div class="form-file">
						<div class="form-label">关闭原因</div>
						<div class="form-value" ng-bind="settings.reason"></div>
						<div class="form-edit">
							<we7-modal-form label="'关闭原因'" on-confirm="saveSetting(formValue, 'reason', 'string')" value="settings['reason']"></we7-modal-form>
						</div>
					</div>
					<!-- 关闭原因 end -->

					<!-- 备案号 start -->
					<div class="form-file">
						<div class="form-label">备案号</div>
						<div class="form-value"><?php  echo $settings['icp'];?><span class="we7-margin-left">直接填写备案号即可,系统已添加工信部链接</span></div>
						<div class="form-edit">
							<we7-modal-form label="'备案号'" on-confirm="saveSetting(formValue, 'icp', 'string')" value="settings['icp']"></we7-modal-form>
						</div>
					</div>
					<div class="form-file">
						<div class="form-label">联网备案信息</div>
						<div class="form-value"><?php  echo $settings['policeicp']['policeicp_location'];?> <?php  echo $settings['policeicp']['policeicp_code'];?><span class="we7-margin-left">直接填写联网备案信息即可,系统已添加工信部链接</span></div>
						<div class="form-edit">
							<a href="#policeicp" data-toggle="modal" data-target="#policeicp">修改</a>
						</div>
					</div>
					<div class="modal fade modal-form" id="policeicp" role="dialog">
						<div class="we7-modal-dialog modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
									<div class="modal-title">联网备案信息</div>
								</div>
								<div class="modal-body we7-form">
									<div class="form-group">
										<label class="col-sm-2 control-label">备案地</label>
										<div class="col-sm-10">
											<input type="text" ng-model="policeicp.value.location" class="form-control" placeholder="例如：京公网安备"  autocomplete="off" >
										</div>
									</div>
									<div class="form-group marbot0">
										<label class="col-sm-2 control-label">备案号</label>
										<div class="col-sm-10">
											<input type="text" ng-model="policeicp.value.code" class="form-control" placeholder="例如：11000002000001" autocomplete="off" >
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary" ng-click="saveSetting(policeicp, 'policeicp', 'string')" data-dismiss="modal">确定</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
								</div>
							</div>
						</div>
					</div>
					<!-- 备案号 end -->

					<!-- 调试模式 start -->
					<div class="form-file">
						<div class="form-label">调试模式</div>
						<div class="form-value"></div>
						<div class="form-edit">
							<div ng-class="settings.develop_status == undefined || settings.develop_status == 0 ? 'switch' : 'switch switchOn'"  ng-click="saveSettingSwitch('develop_status', settings.develop_status)"></div>
						</div>
					</div>
					<!-- 调试模式 end -->

					<!-- 日志开关 start -->
					<div class="form-file">
						<div class="form-label">日志开关</div>
						<div class="form-value"></div>
						<div class="form-edit">
							<div ng-class="settings.log_status == undefined || settings.log_status == 0 ? 'switch' : 'switch switchOn'"  ng-click="saveSettingSwitch('log_status', settings.log_status)"></div>
						</div>
					</div>
					<!-- 日志开关 end -->
				</div>
				<!-- 基本设置 end -->

				<!-- 站点风格 start -->
				
				<!-- 站点风格 end -->
			</div>
			<?php  } ?>

			<?php  if($do == 'copyright') { ?>
				
			<?php  } ?>

			<?php  if($do == 'about') { ?>
				
			<?php  } ?>
		</div>
	</div>
</div>

<script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=F51571495f717ff1194de02366bb8da9&s=1"></script>
<script type="text/javascript">
	$("input[name='status']").click(function() {
		if ($(this).val() == 1) {
			$(".reason").show();
			var reason = $("input[name='reasons']").val();
			$("textarea[name='reason']").text(reason);
		} else {
			$(".reason").hide();
		}
	});
	$("input[name='mobile_status']").click(function() {
		if ($(this).val() == 0) {
			$("#login_type_status-1").attr("checked", false);
			$("#login_type_status-0").prop("checked", true);
			$("#login_type_status-1").attr("disabled", true);
		} else {
			$("#login_type_status-1").attr("disabled", false);
		}
	});
</script>

<script>
	angular.module('systemApp').value('config', {
		'settings' : <?php  echo json_encode($settings)?>,
		'template' : <?php  echo json_encode($template)?>,
		'template_ch_name' : <?php  echo json_encode($template_ch_name)?>,
		'saveSettingUrl' : "<?php  echo url('system/site/save_setting')?>",
	});
	angular.bootstrap($('#system-site-setting'), ['systemApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>