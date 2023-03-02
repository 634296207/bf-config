<?php


// 自定义异常类
// 目的: 灵活控制 修改 异常 的 样式...

class MyException extends  Exception {
    public $message;
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->message = "<p style='color:red'>".$message."<p>";
    }

    public function getMyMessage(){
        return $this->message;
    }
}
class MyException1 extends  Exception {
    public $message;
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->message = "<p style='color:green'>".$message."<p>";
    }

    public function getMyMessage(){
        return $this->message;
    }
}
$a = 1;
try{
    if ($a == 1){
        throw new MyException("一定会抛的");
    }else if($a == 2){
       throw new MyException1("一定会抛的");
    }else{
        echo '没有任何异常....';
    }

}catch (MyException $e){
    echo "这是 异常 抛的...";
    echo $e->getMyMessage();
}catch (MyException1 $e){
    echo "这是 异常1 抛的...";
    echo $e->getMyMessage();
}finally{
    echo "无论如何一定会执行的代码....";
}
// pdo ... 重点再说异常....


