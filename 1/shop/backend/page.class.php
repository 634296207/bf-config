    <?php // 分页类

final class Page{
    // 总记录数
    public $totalNums;
    // 每页条数
    public $pageSize;
    // url
    public $url;
    // 当前页码
    public $page;
    // 总页码
    public $totalPages;

    public function __construct($totalNums,$pageSize)
    {
//        print_r($_SERVER);
        $this->totalNums = $totalNums;
        $this->pageSize = $pageSize;
        $this->url = $this->getUrl();
        $this->page = $this->getCurrentPage();
        $this->totalPages = $this->getTotalPages();
//        print_r($_SERVER);
//        print_r($this->page);
    }
    // 获取总页码
    public function getTotalPages(){
        return ceil($this->totalNums/$this->pageSize);
    }
    // 获取当前页码
    public function getCurrentPage(){
        return $_GET['page']??1;
    }
    // 获取url
    public function getUrl(){

        return "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

    }
    // 首页
    public function start(){
         return "<a href='{$this->url}?page=1'>首页</a>";
    }
    // 上一页
    public function prev(){
       $page = $this->page - 1;
       return "<a href='{$this->url}?page={$page}'>上一页</a>";
    }
    // 下一页
    public function next(){
        $page = $this->page + 1;
        return "<a href='{$this->url}?page={$page}'>下一页</a>";
    }
    // 尾页
    public function end(){
        return "<a href='{$this->url}?page={$this->totalPages}'>尾页</a>";

    }
    // 显示页码
    public function show(){
        $str = "<span>当前第{$this->page}页</span>";
        $str .= "<span>一共{$this->totalPages}页</span>";
        if($this->page > 1){
          $str .= $this->start().$this->prev();
        }
        if($this->page < $this->totalPages){
            $str .= $this->next().$this->end();
        }   
        return $str;
    }
}