<?php
/**
 * 微擎卡券模块微站定义
 *
 * @author 微擎团队
 * @url 
 */
defined('IN_IA') or exit('Access Denied');


class kysc_kyscModuleSite extends WeModuleSite {

	public $settings;

	public function __construct() {
		global $_W;
	}


	public function doWebWeb() {
	    global $_W;
	    session_start();
	    $_SESSION['username']=$_W['username'];
	    $_SESSION['w_uid']=$_W['uid'];
	    $url= $_W["siteroot"] . "addons/" . $_W["current_module"]["name"] . "/core";
	    header("Location:" . $url);exit;
	}
	public function doWebAdmin() {
		global $_W;
		session_start();
		$_SESSION['username']=$_W['username'];
		$_SESSION['w_uid']=$_W['uid'];
		$url= $_W["siteroot"] . "addons/" . $_W["current_module"]["name"] . "/core/admin";
		header("Location:" . $url);exit;
		
	}
	public function doWebWap() {
	    global $_W;
	    session_start();
	    $_SESSION['username']=$_W['username'];
	    $_SESSION['w_uid']=$_W['uid'];
	    $url= $_W["siteroot"] . "addons/" . $_W["current_module"]["name"] . "/core/index.php/wap";
	    header("Location:" . $url);exit;
	}

	public function doWebOfficialWebsite() {
		global $_GPC, $_W;
		header("Location: https://www.niushop.com.cn");
		die;
	}

}