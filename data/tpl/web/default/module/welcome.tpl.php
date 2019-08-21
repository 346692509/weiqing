<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="module-welcome welcome-container clearfix" id="js-module-welcome" ng-controller="userModuleWelcomeCtrl" ng-cloak>
	<!-- 默认后台入口 start -->
	<div class="panel we7-panel module-go-panele" ng-if="module_info.welcome_display">
		<div class="panel-heading we7-padding clearfix">
			<h4 class="pull-left">应用后台管理1</h4>
			<a href="<?php  echo url('module/welcome/welcome_display', array('m' => $module_name))?>" class="btn btn-primary pull-right" target="_blank">
				 进入后台
			</a>
			<div class="switch-box pull-right we7-margin-right">
				<div class=" switch" ng-class="{'switchOn' : module_info.direct_enter_status}" ng-click="changeEnterStatus()"></div>
			</div>
			
			<div class="pull-right we7-margin-right module-go-home">
				后台快捷入口 <i class="wi wi-info">
						<div class="tooltip bottom" role="tooltip">
							<div class="tooltip-arrow"></div>
							<div class="tooltip-inner">
								<p> <i class="wi wi-info "></i> 1.开启开关后，从应用列表，可以<span class=" color-red">直接进入应用的独立后台</span>，无需进入应用的欢迎页面</p>
								<p> <i class="wi wi-info "></i> 2.为确保登录后直接进入应用独立后台，请先设置登录系统后跳转至<span class=" color-red">应用入口页面</span>。<a href="/index.php?c=user&a=profile&" class="color-default" target="_blank">请前去设置</a></p>
								<p> <i class="wi wi-info "></i>3.开启开关后，点击<span class=" color-red">进入后台</span>会出现<span class=" color-red">悬浮的菜单</span>，方便您从应用后台返回系统。如图所示</p>
								<p>
									<img src="./resource/images/welcome/module/1.png" alt="">
									<img src="./resource/images/welcome/module/2.png" alt="">
								</p>
								<p> <i class="wi wi-info"></i> 4.关闭该功能，请返回应用欢迎页，关闭开关。</p>
							</div>
						</div>
					</i>
				
			</div>
        </div>
	</div>
	<!-- 默认后台入口 end -->

	<!-- 关联账号 -->
	<div class="panel we7-panel ">
		<div class="panel-heading">
			<h4>关联平台</h4>
			<a ng-if="account_info.current_user_role != 'clerk'" href="<?php  echo url('module/link-account', array('m' => $module_name, 'uniacid' => $uniacid))?>" class="more">查看更多</a>
		</div>
		<div class="panel-body">
			<div class="account-list">
				<div class="account-item main" ng-click="account_switch(account_info.switchurl)" ng-if="account_info">
					<img src="{{ account_info.logo }}" class="account-img logo" alt="" >
					<div class="info">
						<div class="title">
							{{ account_info.name }}
						</div>
						<div class="type">
							<i class="wi wi-{{ account_info.type_sign}}"></i><span ng-bind="account_info.type_name"></span>
						</div>
					</div>
				</div>
				<div class="account-item" ng-repeat="link_account in link_accounts" ng-if="$index < 4" ng-click="account_switch(link_account.switchurl)"> <!-- 最多4个-->
					<img ng-src="{{ link_account.logo }}" class="account-img logo" alt="">
					<div class="info">
						<div class="title">
							{{ link_account.name }}
						</div>
						<div class="type">
							<i class="wi wi-{{ link_account.type_sign}}"></i><span ng-bind="link_account.type_name"></span>
						</div>
					</div>
				</div>
				<!-- 为空的时候显示 -->
				<!--<div class="empty">-->
					<!--<a href="" class="btn btn-primary" >添加子账号</a>-->
					<!--<p>可添加改应用下关联子账号</p>-->
				<!--</div>-->
			</div>
		</div>
	</div>
	<!-- 关联账号end -->

	<!-- 功能快捷入口 start -->
	<div class="panel we7-panel">
		<div class="panel-heading">
			<h4>功能快捷入口</h4>
			<a ng-if="account_info.current_user_role != 'clerk'" href="<?php  echo url('module/shortcut', array('m' => $module_name, 'uniacid' => $uniacid))?>" class="more" >管理快捷入口</a>
		</div>
		<div class="panel-body "> 
			<div class="quick-list" ng-if="!(shortcuts | we7IsEmpty)">
				<a href="{{ shortcut.url }}" target="_blank" class="quick-item" ng-repeat="shortcut in shortcuts" ng-if="shortcuts.length && $index < 6">
					<div class="icon">
						<img src="{{shortcut.icon}}" alt="" ng-if="shortcut.welcome_display">
						<img ng-src="{{attachurl}}{{shortcut.icon}}" alt="" ng-if="!shortcut.welcome_display">
					</div>
					<div class="name text-over" ng-bind="shortcut.title"></div>
				</a>
			</div>
			<div class="quick-list" ng-if="shortcuts | we7IsEmpty">
				<div class="we7-empty-block" >
					暂无快捷入口
				</div>
			</div>
		</div>
	</div>
	<!-- 功能快捷入口 end -->

	<!-- 入口 start -->
	<div class="panel we7-panel" ng-if="covers || replies" >
		<div class="panel-heading" >
			<h4>入口</h4>
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" ng-class="{active: covers}"><a href="#entry" aria-controls="entry" role="tab" data-toggle="tab" ng-click="changeEntryType('entry')" ng-if="covers">封面</a></li>
				<li role="presentation" ng-class="{active: !covers}"><a href="#keyword" aria-controls="keyword" role="tab" data-toggle="tab"  ng-click="changeEntryType('reply')" ng-if="replies">关键字</a></li>
			</ul>
			<a href="javascript:void(0);" ng-click="pageTo('cover', cover_id)" class="more" ng-if="entryType == 'cover'">查看更多</a>
			<a href="javascript:void(0);" ng-click="pageTo('reply', cover_id)" class="more" ng-if="entryType == 'reply'">查看更多</a>
		</div>
		<div class="panel-body">
			<div class="tab-content">
				<div class="tab-pane" ng-class="{'active': covers}" id="entry">
					<div class="entry-list">
						<div class="entry-item" ng-repeat="cover in covers" ng-if="$index < 3"> <!-- 3个-->
							<div data-url="<?php  echo $_W['siteroot'];?>app/{{ cover.url}}" data-size="100" class="qr js-url-qrcode">
								<div class="qrcode-block"><canvas></canvas></div>
							</div>
							<div class="info">
								<div class="entry-title">
									<span class="title">入口名称</span>
									<span ng-bind="cover.title"></span>
								</div>

								<div class="entry-keyword-list" ng-if="false">
									<span class="title">关键字</span> 
									<div ng-repeat="item in cover.keyword" > <!-- todo 这块写循环-->
										<span class="entry-keyword-item text-over"  ng-show="$index < 3"> 
											<span >权限信息权限信息权限信息权限信息</span>
										</span>
										<span ng-show="$index == 3">....</span>
									</div>
									<div  > <!-- todo 这块写循环-->
										<span class="entry-keyword-item text-over" > <!-- 记得 加上这个 ng-show="$index < 3"-->
											<span >权限信息权限信息权限信息权限信息</span>
										</span>
									</div>
									<div  > <!-- 这块写循环-->
										<span class="entry-keyword-item text-over" > <!-- 记得 加上这个 ng-show="$index < 3"-->
											<span >权限信息权限信息权限信息权限信息</span>
										</span>
									</div>
									<div  > <!-- 这块写循环-->
										<span class="entry-keyword-item text-over" > <!-- 记得 加上这个 ng-show="$index < 3"-->
											<span >权限信息权限信息权限信息权限信息</span>
										</span>
									</div>
									<div  > <!-- 这块写循环-->
										<span ng-show="$index == 3">....</span>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane" ng-class="{'active': !covers}" id="keyword">
					<div class="keyword-list">
						<div class="keyword-item" ng-repeat="reply in replies">
							<div class="keyword">
								<span class="title">关键字</span>
								<span class="keyword-label text-over" ng-repeat="keyword in reply.keywords" ng-bind="keyword.content" ng-if="$index == 0"></span> <!--1个-->
							</div>
							<div class="content">
								<span class="title">回复内容</span>
								<span ng-bind="reply.module_info.title | limitTo:10"></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 入口 end-->

	<!-- 权限 start -->
	<div class="panel we7-panel" ng-if="account_info.current_user_role != 'clerk'">
		<div class="panel-heading">
			<h4>应用操作员</h4>
			<a href="<?php  echo url('module/permission', array('m' => $module_name))?>" class="more" ng-if="user_permissions"> 查看更多</a>
			<a href="<?php  echo url('module/permission/post', array('m' => $module_name))?>" target="_blank" class="more" ng-if="user_permissions"> 添加操作员</a>
		</div>
		<div class="panel-body">
			<div class="permission-box-list" ng-if="!(user_permissions | we7IsEmpty)">
				<div class="permission-box-item" ng-repeat="permission in user_permissions" ng-if="$index < 3"> <!-- 3个 -->
					<div class="logo">
						<img src="{{permission.user_info.avatar || './resource/images/nopic-user.png'}}" alt="">
					</div>
					<div class="info">
						<div class="name text-over" ng-bind="permission.user_info.username"></div>
						<div class="permission-list text-over"> 
							<span class="title">权限信息</span>
							<div ng-repeat="(index, permission_name) in permission.permission" >
								<span class="permission-item text-over" ng-show="$index < 3">
									<span ng-if="!permission_name">全部</span>
									<span ng-if="permission_name != 'all'" ng-bind="permission_name"></span>
								</span>
								<span ng-show="$index == 3">....</span>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<div class="permission-box-list" ng-if="user_permissions | we7IsEmpty">
				<div class="we7-empty-block" >
					暂无操作员
				</div>
			</div>
		</div>
	</div>
	<!-- 权限 end -->

	<!-- 公告 start -->
	<div class="panel we7-panel">
		<div class="panel-heading">
			<h4>公告</h4>
			<a ng-if="account_info.current_user_role != 'clerk'" href="<?php  echo url('article/notice-show');?>" class="more">查看更多</a>
			<?php  if($_W['role'] == ACCOUNT_MANAGE_NAME_FOUNDER) { ?>
			<a ng-if="account_info.current_user_role != 'clerk'" href="<?php  echo url('article/notice/post');?>" class="more">去新建</a>
			<?php  } ?>
		</div>
		<div class="panel-body">
			<div class="tab-content">
				<div class="tab-pane active"  id="notice">
					<ul class="list-group notice-statistics">
						<li class="list-group-item" ng-if="notices" ng-repeat="notice in notices">
							<a href="{{notice.url}}" ng-if="notice.style.color && notice.style.bold" style="color:{{notice.style.color}};font-weight:bold">{{notice.title}}</a>
							<a href="{{notice.url}}" ng-if="notice.style.color && !notice.style.bold" style="color:{{notice.style.color}};">{{notice.title}}</a>
							<a href="{{notice.url}}" ng-if="notice.style.bold && !notice.style.color" style="font-weight:bold;">{{notice.title}}</a>
							<a href="{{notice.url}}" ng-if="!notice.style.color && !notice.style.color">{{notice.title}}</a>
							<span class="pull-right color-gray">
								{{ notice.createtime}}
							</span>
						</li>

						<div class="we7-empty-block" ng-if="!notices">
							暂无公告
						</div>

					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- 公告 end -->

	
	<!-- 推荐应用 start -->
	<div class="panel we7-panel" ng-init="commentModulesShow = true" ng-show="commentModulesShow" ng-if="false">
		<div class="panel-heading">
			<h4>推荐应用</h4>
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" :ng-class="{active: key == 'recommend'}" ng-click="changeTab(key)" ng-repeat="(key, item) in recommend"><a href="{{'#' + key}}" role="tab" aria-controls="{{key}}" data-type="{{key}}" data-toggle="tab" >{{item.name}}</a></li>
			</ul>
			<a href="javascript:void(0);" class="more" ng-click="commentModulesShow = false">关闭</a>
			<a href="http://s.w7.cc/" class="more" target="_blank">去市场</a>
		</div>
		<div class="panel-body">
			<div class="tab-content">
				<div class="tab-pane " :ng-class="{active: key == 'recommend'}"  id="{{key}}" ng-repeat="(key, item) in recommend">
					<div class="app-statistics">
						<div class="left-box">
							<div id="{{key + '-app-carousel'}}" class="carousel slide recommend-app-carousel" data-ride="carousel">
								<ol class="carousel-indicators">
									<li data-target="{{'#' + key + '-app-carousel'}}" data-slide-to="{{index}}"  ng-class="{active: index == 0}" ng-repeat="(index, ad) in item.ads"></li>
								</ol>
								<div class="carousel-inner" role="listbox">
									<div class="item advertising-box" ng-class="{active: index == 0}" ng-repeat="(index, ad) in item.ads">
										<a ng-href="{{ad.url}}" target="_blank">
											<img ng-src="{{ad.cdn_logo}}" alt="">
										</a>
									</div>
								</div>
							</div>
							<div class="go-store" ng-if="key != 'recommend' && item.ads.length == 0">
								<div class="icon">
									<img ng-src="{{'resource/images/welcome/' + item.icon + '-icon.png'}}" alt="">
								</div>
								<div class="name">
									{{item.name}}
								</div>
								<div class="title">
									网罗市场最新应用，更快了解最新应用
								</div>
								<a href="//s.w7.cc" class="btn btn-primary">去应用市场</a>
							</div>
						</div>
						<div class="right-box">
							<a ng-href="{{'//s.w7.cc/module-'+app.aid+'.html'}}" target="_blank" class="app-item" ng-repeat="app in item.list">
								<div class="app-item-box">
									<div class="info">
										<div class="logo">
											<img ng-src="{{app.cdn_logo}}" alt="">
										</div>
										<div class="text-over">
											<div class="name text-over" ng-bind="app.title"></div>
											<div class="time" ng-bind="'下载次数' + app.down_count"></div>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 推荐应用 end -->
	
</div>

<script>
	angular.module('moduleApp').value('config', {
		family: "<?php echo IMS_FAMILY;?>",
		'module_name': "<?php  echo $module_name;?>",
		'uniacid': "<?php  echo $uniacid;?>",
		'attachurl' : "<?php  echo $_W['attachurl'];?>",
		'apiLink': '//api.w7.cc',
		'notices' : <?php  echo json_encode($notices)?>,
		'links' : {
			'cover_url' : "<?php  echo url('platform/cover')?>",
			'reply_url' : "<?php  echo url('platform/reply')?>",
			'shortcut' : "<?php  echo url('module/shortcut/display', array('m' => $module_name, 'uniacid' => $uniacid))?>",
			'get_module_info_url' : "<?php  echo url('module/welcome/get_module_info', array('m' => $module_name, 'uniacid' => $uniacid))?>",
			'get_module_replies_url' : "<?php  echo url('module/welcome/get_module_replies', array('m' => $module_name, 'uniacid' => $uniacid))?>",
			'get_module_accounts_url' : "<?php  echo url('module/welcome/get_module_accounts', array('m' => $module_name, 'uniacid' => $uniacid))?>",
			'get_module_covers_url' : "<?php  echo url('module/welcome/get_module_covers', array('m' => $module_name, 'uniacid' => $uniacid))?>",
			'module_permission_url' : "<?php  echo url('module/permission/display', array('m' => $module_name, 'uniacid' => $uniacid))?>",
			'change_direct_enter_status': "<?php  echo url('module/welcome/change_enter_status', array('m' => $module_name, 'uniacid' => $uniacid))?>",
		}
	});
	angular.bootstrap($('#js-module-welcome'), ['moduleApp']);
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>