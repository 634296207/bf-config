<?php
class cap
{
    public $image;
    public $bgcolor;
    public $captch_code='';
    public function getImagefill()
    {
        return imagefill($this->image,0,0,$this->bgcolor);
    }
    public function getimge()
    {
        return $this->image = imagecreatetruecolor(100,30);
    }
    public function getbg()
    {
        return $this->bgcolor = imagecolorallocate($this->image,255,255,255);
    }
    public function __construct()
    {
        $this->image = $this->getimge();
        $this->bgcolor = $this->getbg();
        $this->captch_code = $this->Letter();
    }
    public function Letter()
    {
        for($i=0;$i<4;$i++)
        {
  	        $fontsize = 6;
  	        $fontcolor = imagecolorallocate($this->image,rand(0,120),rand(0,120),rand(0,120));
            $data = 'qwertyuiplkjhgfdsazxcvbnm123456789';//所有数字字母组成的字符串，为用户考虑去除难辨识的o和0；
            $fontcontent = substr($data,rand(0,strlen($data)),1);//从$data中随机取出一个字符
            $this->captch_code .= $fontcontent;//字符串拼接到$captch_code
            $x=($i*100/4) + rand(5,10);
            $y=rand(5,10);
            imagestring($this->image,$fontsize,$x,$y,$fontcontent,$fontcolor);
        }
        return $this->captch_code;
    }
    public function getSession()
    {
        session_start();
        $_SESSION['authcode'] = $this->captch_code;
    }
    public function getGAS()
    {
        for ($i=0;$i<200;$i++){
            $pointcolor = imagecolorallocate($this->image,rand(50,200),rand(50,200),rand(50,200));//干扰点的颜色不应该干扰用户正常阅读验证码内容，所以随机浅色区域
            imagesetpixel($this->image,rand(1,99),rand(1,29),$pointcolor);
        }
    }
    public function  line()
    {
        for ($i=0;$i<3;$i++){
            $linecolor = imagecolorallocate($this->image,rand(80,200),rand(80,200),rand(80,200));
            imageline($this->image,rand(1,99),rand(1,29),rand(1,99),rand(1,29),$linecolor);
        }
    }
    public function Echo()
    {
        header('content-type:image/png');//输出前添加文件头信息
        return imagepng($this->image);
    }
    public function destroy()
    {
        imagedestroy($this->image);
    }
}