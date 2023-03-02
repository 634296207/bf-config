
<?php


/**
 * connect 连接数据库
 * 
 * @return resource 连接资源, 失败返回错误信息
 */
function connect(){
	//用require引入config.php文件
	$config = require dirname(__FILE__)."/config.php";
	//连接mysqli 定义连接mysqli的参数
	$link = mysqli_connect(
		//ip地址
		$config['db_host'].':'.$config['db_port'],
		//登录数据库的用户名
		$config['db_user'],
		//登录数据库的密码
		$config['db_password'],
		//选择进入数据库的名字
		$config['db_name']
	);
	//若错误存在 
	if(!is_null(mysqli_connect_error())){
		//则返回'数据库连接错误: '.mysqli_connect_error()
		die('数据库连接错误: '.mysqli_connect_error());
	}
	//若不存在错误 则返回 $link
	return $link;
}


/**
 * queryOne 查询一条数据
 * 
 * @param  string $sql sql语句
 * 
 * @return array      查询到的关联数组, 没有返回空数组
 */
function queryOne($sql){
	//调用connect函数  选择数据库信息
	$link = connect();
	//请求操作数据库
	$result = mysqli_query($link,$sql);
	//定义空数组 以填充数据
	$data = [];
	//若结果存在且返回了集中行数据
	if($result && mysqli_num_rows($result)>0){
		//则返回转换为关联数组的查询结果
		$data = mysqli_fetch_assoc($result);
	}
	//不存在查询结果 返回空数组
	return $data;
}
/**
 * queryAll
 * 
 * @param  string $sql sql语句
 * 
 * @return array 二维关联数组, 没有就返回空数组
 */
function queryAll($sql){
	//调用connect函数  选择数据库信息
	$link = connect();
	//请求操作数据库
	$result = mysqli_query($link,$sql);
	//定义空数组 以填充数据
	$data = [];
	//若结果存在且返回了集中行数据
	if($result && mysqli_num_rows($result)>0){
		//则返回转换为关联数组的查询结果
		$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
	}
	return $data;
}

/**
 * getDBPrefix 返回前缀
 * 
 * @return string 数据表的前缀
 */

function getDBPrefix(){
	//用require引入文件config.php
	$config = require dirname(__FILE__)."/config.php";
	//返回数据表的前缀
	return $config['db_prefix'];
}

/**
 * execute 增删改操作
 * 
 * @param  string $sql sql语句
 * 
 * @return bool      有影响行数, true, 没有影响行数, false
 */

function execute($sql){
	//调用connect函数  选择数据库信息
	$link = connect();
	////请求操作数据库
	mysqli_query($link,$sql);
	return mysqli_affected_rows($link)>0;
}

/**
 *  获取总记录数
 */

function getTotalNums($sql){
    $link = connect();
    $result = mysqli_query($link,$sql);
    // 获取结果集中的总记录数
    return mysqli_num_rows($result);

}