<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div id="js-link-display" class="module-link-page" ng-controller="linkDisplayCtrl">
    <ol class="breadcrumb we7-breadcrumb">
        <a href="<?php  echo url('module/display')?>"><i class="wi wi-back-circle"></i> </a>
        <li><a href="<?php  echo url('module/display')?>">应用列表</a></li>
        <li>新建应用</li>
    </ol>

    <div class="alert we7-page-alert" >
        <p>主账号仅可设置一个，关联的账号组，数据以主账号的为准。</p>
        <p>关联账号可设置多个，但从任意一个账号进入，数据都与主账号数据保持一致。 </p>
    </div>
    <div class="we7-form">
        <!--选择应用-->
        <div class="form-group ">
            <div class="control-label col-sm-2">
                选择应用
            </div>
            <div class="form-controls col-sm-8">
                <div class="group-post-mudules">
                    <div class="module-item" ng-if="module && module.name">
                        <div class="logo">
                            <img ng-src="{{module.logo}}" alt="">
                        </div>
                        <div class="info">
                            <div ng-bind="module.title" class="title text-over"></div>
                            <div class="icon">
                                <i class="{{item.icon}}" ng-repeat="item in module | moduleInfo"></i>
                            </div>
                        </div>
                        <we7-modal-app   module-list="user_modules" title="'添加应用'" on-confirm="checkModule()">
                            <div class="delete">
                                <i class="wi wi-cut-account" ></i>
                            </div>
                        </we7-modal-app>
                    </div>
                    <we7-modal-app module-list="user_modules" ng-if="!module || !module.name" title="'添加应用'" on-confirm="checkModule()">
                        <div class="module-item add">
                            <i class="wi wi-plus"></i> 添加应用
                        </div>
                    </we7-modal-app>
                </div>
            </div>
        </div>
        <!-- 选中主账号 -->
        <div class="form-group clearfix" ng-if="linkInfo.module_name">
            <div class="control-label col-sm-2">
                选择主账号
            </div>
            <div class="form-controls col-sm-8">
                <div class="group-post-mudules">
                    <div class="module-item" ng-if="linkInfo && linkInfo.main_account && linkInfo.main_account.name">
                        <div class="logo">
                            <img src="{{linkInfo.main_account.logo}}" alt="">
                        </div>
                        <div class="info">
                            <div ng-bind="linkInfo.main_account.name" class="title text-over"></div>
                            <div class="icon">
                                    
                                <i class="{{we7TypeDefault[linkInfo.main_account.type_sign]['icon']}}"></i>
                            </div>
                        </div>   
                        <div class="delete" ng-click="selectAccount('main')">
                            <i class="wi wi-cut-account" ></i>
                        </div>
                    </div>
                    <div class="module-item add" ng-click="selectAccount('main')" ng-if="!(linkInfo && linkInfo.main_account && linkInfo.main_account.name)">
                        <i class="wi wi-plus"></i> 选择主账号
                    </div>
                </div>
            </div>
        </div>
        <!-- 选择账号-->
        <div class="form-group clearfix" ng-if="linkInfo && linkInfo.main_account && linkInfo.main_account.name">
            <div class="control-label col-sm-2">
                选择账号
            </div>
            <div class="form-controls col-sm-8">
                <div class="group-post-mudules">
                    <div class="module-item" ng-repeat="account in linkInfo.link_accounts track by $index">
                        <div class="logo">
                            <img src="{{account.logo}}" alt="">
                        </div>
                        <div class="info">
                            <div ng-bind="account.name" class="title text-over"></div>
                            <div class="icon">
                                    
                                <i class="{{we7TypeDefault[account.type_sign]['icon']}}"></i>
                            </div>
                        </div>
                        <div class="delete" ng-click="deleteLink(account.name)">
                            <i class="wi wi-error" ></i>
                        </div>
                    </div>
                    <div class="module-item add" ng-click="selectAccount('link')">
                        <i class="wi wi-plus"></i> 选择账号
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-offset-2">
            <button class="btn btn-primary" ng-click="submitLinkInfo()">提交</button>
        </div>
    </div>
    <div class="modal fade modal-app" tabindex="-1" id="add_account" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header clearfix">
                    <h4 class="text-over"> 选择账号 </h4>
                    <div class="type"></div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="search-box">
                        <select class="we7-select we7-margin-right" 
                                ng-model="setAccountInfoType" 
                                ng-change="setAccountInfo(setAccountInfoType)">
                            <option value="{{key}}" 
                                ng-repeat="(key, item) in we7TypeDefault"
                                ng-if="module[key + '_support'] == 2 && (key == 'wxapp' || selectAccountLinkType != 'link' || linkInfo.main_account.type_sign != key)" 
                                >{{item.name}}</option>
                        </select>
                        <div class="search-form">
                            <div class="input-group  ">
                                <input class="form-control" name="keyword" type="text" ng-model="keyword" autocomplete="false" >
                                <span class="input-group-btn" ng-click="searchInAccountData(keyword)"><button class="btn btn-default"><i class="fa fa-search"></i></button></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-app-list">
                        <div class="modal-item" ng-repeat="account in searchedAccountData" ng-class="{'active': account.checked == 1}" ng-click="selectedAccount(account)">
                            <div class="logo ">
                                <img ng-src="{{account.logo}}" class="account-logo" alt="">
                                <div class="mark">
                                    <i class="wi wi-right"></i>
                                </div>
                            </div>
                            <div class="name text-over">
                                <i class="{{we7TypeDefault[account.type_sign]['icon']}}"></i>{{account.name}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" ng-click="ngConfirm()">确定</button>
                    <button type="button" class="btn btn-default"  data-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    angular.module('moduleApp').value('config', {
        'submitLinkInfoUrl': '<?php  echo url("module/link/link_account")?>',
        'getLinkAccountUrl': '<?php  echo url("module/link/get_sub_accounts")?>',
        'getMainAccountUrl': '<?php  echo url("module/link/search_link_account")?>',
        'userModules': <?php  echo json_encode($user_modules)?>,
    });
    angular.bootstrap($('#js-link-display'), ['moduleApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>