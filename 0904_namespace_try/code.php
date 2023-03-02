<?php
class Code{
    public $error;
    // 生成验证码
    public function make($num){
        $this->line($num);
    }


    // 生成干扰线
    public function line($num){

        if($num > 5){
//            $this->error = "干扰线过多...";
            // 抛出一个异常
            throw new Exception("干扰线太多了...........");

        }
    }


//    public function getError(){
//        echo $this->error;
//    }
}


