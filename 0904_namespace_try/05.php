<?php
include "code.php";

try{
    // 有可能出现问题的代码 如果出现了问题 代码会执行catch里面
  $code = new Code();
  $code->make(6);
}catch (Exception $e){
    echo $e->getMessage();
}

//if($code -> make(10) == false){
////  $code->getError();
//
//}

$a = 3;
$b = 0;
try{
    if($b !=0){
         $c = $a/$b;
         echo "hello";
    }else{
        throw new Exception("除数不能为0");
    }

    echo "world";


}catch (Exception $e){
    echo "代码异常了...";
    echo $e->getMessage();
}

echo "代码正常执行";


/*class Exception{
    public $message = '';
    public function __construct($message)
    {
        $this->message = $message;
    }

    public function getMessage(){
        return $this->message;
    }
}
echo $x;*/