<?php
defined("IN_IA") or exit("Access Denied");
define("RES", "../addons/gtf_mofang/template/mobile/");
class GTF_mofangModuleSite extends WeModuleSite {
    public function doMobileindex() {
        global $_GPC, $_W;
        $weid = $_W['uniacid'];
        include $this->template('index');
    }
}

