<?php include_once 'header.php'; ?>
<?php

// 分页实现

// 1.总记录数
$sql0 = "select *  from {$prefix}product";
$totalNums =  getTotalNums($sql0);
// 2.每页条数
$pageSize = 2;
// 3.一共几页
$totalPages = ceil($totalNums/$pageSize);
//
//                                                                          (1-1)*2  0 , 2
//                                                                          (2-1)*2  2 , 2
//                                                                          (3-1)*2  4 , 2
$page = isset($_GET['page'])?$_GET['page']:1;

$start = ($page-1)*2;
$limit = " limit $start,$pageSize";
$sql = "select * from {$prefix}product order by id asc $limit ";

$products = queryAll($sql);


?>
<!-- Start Our Product Area -->
<section class="htc__product__area bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-categories-all">
                    <div class="product-categories-title" style="border-bottom: 1px solid rgba(129, 129, 129, 0.2)">
                        <h3>所有商品</h3>
                        <p><?php if(hasInfo()) echo getInfo(); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach($products as $product):?>
            <div class="col-md-3 single__pro col-lg-3 cat--1 col-sm-4 col-xs-12">
                <div style="margin-top: 20px" class="product foo">
                    <div class="product__inner">
                        <div class="pro__thumb">
                            <a href="product_details.php?id=<?php echo $product['id']; ?>">
                                <img src="<?php echo $product['pic']; ?>" alt="product images">
                            </a>
                        </div>
                        <div class="product__hover__info">
                            <ul class="product__action">
                                <li><a title="加入购物车" href="cart_add.php?id=<?php echo $product['id'];?>&count=1"><span class="ti-shopping-cart"></span></a></li>
                                <li><a title="查看详情" href="product_details.php?id=<?php echo $product['id']; ?>">查看详情</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product__details">
                        <h2><a
                                href="product_details.php?id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a>
                        </h2>
                        <ul class="product__price">
                            <!-- <li class="old__price">￥13006.00</li> -->
                            <li class="new__price">￥<?php echo $product['price']; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
        <div>
            <span>当前第<span style="color: red;font-weight: bold"><?php echo $page?></span>页</span>
            <span>共<span style="color: red;font-weight: bold"><?php echo $totalPages?></span>页</span>
            <?php if($page>1){ ?>
            <span><a href="index.php?page=1">首页</a></span>
            <span><a href="index.php?page=<?php echo $page-1?>">上一页</a></span>
            <?php  }?>
            <?php  if($page < $totalPages ){?>
            <span><a href="index.php?page=<?php echo $page+1?>">下一页</a></span>
            <span><a href="index.php?page=<?php echo $totalPages?>">尾页</a></span>
            <?php }?>

        </div>
    </div>

</section>

<!-- End Our Product Area -->

<?php //include_once 'footer.php'; ?>