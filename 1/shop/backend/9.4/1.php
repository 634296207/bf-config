<?php
class paging
{   //总记录数
    public $TotalNum;
    //每页条页数
    public $PageSize;
    //url
    public $Url;
    //当前页码数
    public $VarPageNo;
    //总页码数
    public $PPOr;

    public function __construct($TotalNum,$PageSize)
    {
        $this->PageSize=$PageSize;
        $this->PPOr=$this->getPPOr();
        $this->Url=$this->getUrl();
        $this->TotalNum=$TotalNum;
        $this->VarPageNo=$this->getVarPageNo();
    }

    public function getPPOr()
    {
        return $PPOr = ceil($this->TotalNum/$this->PageSize);
    }
    public function getVarPageNo()
    {
        return $_GET['VarPageNo']??1;
    }
    public function getUrl()
    {
        return "http//".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
    }
    //首页
    public function Main()
    {
        return "<a href='{$this->Url}?VarPageNo=1'>首页</a>";
    }
    public function Back()
    {   $VarPageNo=$this->VarPageNo-1;
        return "<a href='{$this->Url}?VarPageNo={$VarPageNo}'>上一页</a>";
    }
    public function PgDn()
    {   $VarPageNo=$this->VarPageNo+1;
        return "<a href='{$this->Url}?VarPageNo={$VarPageNo}'>下一页</a>";
    }
    public function Last()
    {
        return "<a href='{$this->Url}?VarPageNo={$this->PPOr}'>尾页</a>";
    }
    public function show()
    {
        $str = "<span>当前是{$this->VarPageNo}页</span>";
        $str .= "<span>共{$this->PPOr}页</span>";
        if($this->VarPageNo > 1)
        {
            $str .= $this->Back().$this->Main();
        }
        if($this->VarPageNo < $this->PPOr)
        {
            $str .= $this->PgDn().$this->Last();
        }
        return $str;
    }
}