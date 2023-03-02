<?php
require_once "db.func.php";
/**
 * setSession 设置session
 *
 * @param string $key    session的名字
 * @param string $value  session的值
 * @param string $prefix session前缀, 用来区分, 前台session还是后台session
 *
 * @return void
 */
function setSession($key, $value, $prefix = '') {
    session_id() || session_start();
    if (!empty($prefix)) {
        $_SESSION[$prefix][$key] = $value;
    } else {
        $_SESSION[$key] = $value;
    }
}
/**
 * getSession 获取session
 *
 * @param  string $key    session名字
 * @param  string $prefix session前缀
 *
 * @return string         session的值, 如果获取不到, 返回空字符串
 */
function getSession($key, $prefix = '') {
    session_id() || session_start();
    if (!empty($prefix)) {
        return isset($_SESSION[$prefix][$key]) ? $_SESSION[$prefix][$key] : '';
    } else {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : '';
    }
}
/**
 * deleteSession 清除session
 *
 * @param  string $key    session名字
 * @param  string $prefix session前缀
 *
 * @return void
 */
function deleteSession($key, $prefix = '') {
    session_id() || session_start();
    if (!empty($prefix)) {
        unset($_SESSION[$prefix][$key]);
    } else {
        unset($_SESSION[$key]);
    }
}
/**
 * setInfo 设置系统消息
 *
 * @param string $info 消息的具体内容
 *
 * @return  void
 */
function setInfo($info, $filename = '') {
    if ($filename) {
        setSession('info', [$filename => $info], 'system');
    } else {
        setSession('info', $info, 'system');
    }
}
/**
 * getInfo 获取系统消息
 *
 * @return string 系统消息, 有就返回消息, 没有就空字符串
 */
function getInfo($filename = '') {
    $info = getSession('info', 'system');
    if (is_array($info) && array_key_exists($filename, $info)) {
        deleteSession('info', 'system');
        return $info[$filename];
    }
    if (is_string($info)) {
        deleteSession('info', 'system');
        return $info;
    }
    return "";
}
/**
 * hasInfo 是否有消息需要展示
 *
 * @return boolean 有则返回true, 没有返回false
 */
function hasInfo() {
    return !empty(getSession('info', 'system'));
}
/**
 * check_form 表单验证
 *
 * @param  array $arr 包含验证值的一个数组
 * @param  array $rules 包含验证规则的一个数组
 *
 * @return bool 如果验证通过, 最终返回true, 如果中途出错, 会保存错误信息, 并且返回false
 */
function check_form($arr, $rules) {
    // 需要展示的错误信息
    $info_arr = [
        'is_unique' => "%s已经存在!", // 判断是否唯一
        'match_regex' => "%s格式不正确!", // 判断是否符合正则
        'not_empty' => "请填写%s!", // 判断是否为空
        'not_equal' => "%s和%s不能相同!", // 不能相同
        'is_equal' => "%s和%s必须一致!", // 必须一致
    ];
    foreach ($rules as $element => $rule) {
        // 判断非空
        if (isset($rule['require']) && $rule['require'] && $arr[$element] === "") {
            $info = sprintf($info_arr['not_empty'], $rule['name']);
            setInfo($info);
            return false;
        }
        // 判断类型, 自动进行正则判断
        if (isset($rule['type'])) {
            switch ($rule['type']) {
            case 'phone':
                $regex = "/^1([38]\d|5[0-35-9]|7[3678])\d{8}$/";
                break;
            case 'age':
                $regex = "/^1[89]$|^[2-9]\d$|^1[01]\d$|^120$/";
                break;
            case 'email':
                $regex = "/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/";
                break;
            }
            if (!preg_match($regex, $arr[$element])) {
                $info = sprintf($info_arr['match_regex'], $rule['name']);
                setInfo($info);
                return false;
            }
        }
        // 判断是否检测唯一
        if (array_key_exists('is_unique', $rule) && queryOne($rule['is_unique'])) {
            $info = sprintf($info_arr['is_unique'], $rule['name']);
            setInfo($info);
            return false;
        }
        // 判断是否和另一个值互斥
        if (array_key_exists('not_equal', $rule) && $arr[$element] === $arr[$rule['not_equal']]) {
            $info = sprintf($info_arr['not_equal'], $rule['name'], $rules[$rule['not_equal']]['name']);
            setInfo($info);
            return false;
        }
        // 判断是否和另一个值相等
        if (array_key_exists('is_equal', $rule) && $arr[$element] !== $arr[$rule['is_equal']]) {
            $info = sprintf($info_arr['is_equal'], $rule['name'], $rules[$rule['is_equal']]['name']);
            setInfo($info);
            return false;
        }
    }
    return true;
}

/**
 * add_cart 添加购物车
 *
 * @param  int $product_id 商品id
 * @param  int $product_count 商品数量
 * @param  int $user_id 用户id
 * @param  string $prefix 数据表前缀
 *
 * @return void
 */
function add_cart($product_id, $product_count, $user_id, $prefix) {
    // 根据商品id和用户id, 查询购物车中, 是否有该条记录
    $sql = "select product_count from {$prefix}cart where product_id = $product_id and user_id = $user_id";
    $res = queryOne($sql);
    // 格式化当前时间
    $created_at = date('Y-m-d H:i:s');
    if ($res) {
        // 如果数据库中有结果, 更新结果, 写入数据库
        $new_count = intval($res['product_count']) + intval($product_count);
        $sql = "update {$prefix}cart set product_count = $new_count, created_at = '$created_at' where product_id = $product_id and user_id = $user_id";
    } else {
        // 如果没有, 则插入数据库
        $sql = "insert into {$prefix}cart(product_id,user_id,product_count,created_at) values($product_id,$user_id,$product_count,'$created_at')";
    }
    $res = execute($sql);
    if (!$res) {
        setInfo('添加购物车失败!!!');
    }
}