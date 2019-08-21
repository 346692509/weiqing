<?php

defined("IN_IA") or define("IN_IA", true);
require __DIR__ . "/../../../../data/config.php";
$db = [];
if (empty($config["db"]["master"])) {
    $db = $config["db"];
} else {
    $db = $config["db"]["master"];
}
return [
    "we7_pre" => $db["tablepre"], 
    "type" => "mysql", 
    "hostname" => $db["host"], 
    "database" => $db["database"], 
    "username" => $db["username"], 
    "password" => $db["password"], 
    "hostport" => $db["port"], 
    "dsn" => '', 
    "params" => [PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true], 
    "charset" => "utf8", 
    "prefix" => '', 
    "we7_prefix" => $db["tablepre"], 
    "debug" => true, 
    "deploy" => 0, 
    "rw_separate" => false, 
    "master_num" => 1,
    "slave_no" => '', 
    "read_master" => false,
    "fields_strict" => true, 
    "resultset_type" => "array", 
    "auto_timestamp" => false, 
    "datetime_format" => "Y-m-d H:i:s", 
    "sql_explain" => false
];
// return [
// // 数据库类型
// 'type'           => 'mysql',
// // 服务器地址
// 'hostname'       => '127.0.0.1',
// // 数据库名
// 'database'       => 'niushop_b2c_2.6',
// // 用户名
// 'username'       => 'root',
// // 密码
// 'password'       => 'root',
// // 端口
// 'hostport'       => '3306',
// // 连接dsn
// 'dsn'            => '',
// // 数据库连接参数
// 'params'         => [],
// // 数据库编码默认采用utf8
// 'charset'        => 'utf8',
// // 数据库表前缀
// 'prefix'         => '',
// // 数据库调试模式
// 'debug'          => true,
// // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
// 'deploy'         => 0,
// // 数据库读写是否分离 主从式有效
// 'rw_separate'    => false,
// // 读写分离后 主服务器数量
// 'master_num'     => 1,
// // 指定从服务器序号
// 'slave_no'       => '',
// // 是否严格检查字段是否存在
// 'fields_strict'  => true,
// // 数据集返回类型 array 数组 collection Collection对象
// 'resultset_type' => 'array',
// // 是否自动写入时间戳字段
// 'auto_timestamp' => false,
//     // 是否需要进行SQL性能分析
// 'sql_explain'    => false,
// ];