<?php
/**
 * gtf_mofang模块定义
 *
 * @author GTF团队
 * @url 
 */
defined('IN_IA') or exit('Access Denied');

class Gtf_mofangModule extends WeModule {
	
	/*设置活动默认数据*/
    public function fieldsFormDisplay($rid = 0) {
        
    }

    public function fieldsFormValidate($rid = 0) {
        return '';
    }
	
	/*保存活动入库*/
    public function fieldsFormSubmit($rid) {

    }
	
	/*删除活动*/
    public function ruleDeleted($rid) {
       
    }

	/*系统设置用不到*/
    public function settingsDisplay($settings) {

        global $_GPC, $_W;

    }

}