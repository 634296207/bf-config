<?php include_once "header.php"; ?>
<?php
$id = $_GET['id'];
$sql = "select * from {$prefix}product where id = $id";
$product = queryOne($sql);
?>


<!-- Start Product Details -->
<section class="htc__product__details pt--120 pb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                <div class="product__details__container">
                    <div class="product__big__images" style="width: 100%;max-width: 100%">
                        <div class="portfolio-full-image tab-content">
                            <div role="tabpanel" class="tab-pane fade in active">
                                <img width="100%" src="<?php echo $product['pic']; ?>" alt="full-image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12 smt-30 xmt-30">
                <div class="htc__product__details__inner">
                    <div class="pro__detl__title">
                        <h2><?php echo $product['name']; ?></h2>
                    </div>
                    <div class="pro__details">
                        <p><?php echo mb_substr($product['description'],0,30,'utf8').'...'; ?></p>
                    </div>
                    <ul class="pro__dtl__prize">
                        <!-- <li class="old__prize">￥13500.21</li> -->
                        <li>￥<?php echo $product['price']; ?></li>
                    </ul>
                    <input type="hidden" name="product_stock" value="<?php echo $product['stock']?>">
                    <div class="product-action-wrap">
                        <div class="prodict-statas"><span>数量 :</span></div>
                        <div class="product-quantity">
                            <form id='myform' method='POST' action='cart_add.php'>
                                <div class="product-quantity">
                                        <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" readonly="readonly" type="text" name="qtybutton" value="1">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <ul class="pro__dtl__btn">
                        <li class="buy__now__btn"><a href="javascript:document.getElementById('myform').submit()">加入购物车</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Product Details -->
<!-- Start Product tab -->
<section class="htc__product__details__tab bg__white pb--120">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <ul class="product__deatils__tab mb--60" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#description" role="tab" data-toggle="tab">商品描述</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="product__details__tab__content">
                    <!-- Start Single Content -->
                    <div role="tabpanel" id="description" class="product__tab__content fade in active">
                        <div class="product__description__wrap">
                            <?php echo $product['description']; ?>
                        </div>
                    </div>
                    <!-- End Single Content -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Product tab -->
<div class="only-banner ptb--10 bg__white">
</div>
<?php include_once 'footer.php'; ?>
<script>
    var inc_obj = document.getElementsByClassName('inc qtybutton')[0];
    var product_count_input = document.querySelector('[name=qtybutton]');
    var stock = parseInt(document.querySelector('[name=product_stock]').value);
    inc_obj.onclick = function(){
        var current = parseInt(product_count_input.value);
        if(current > stock){
            alert('商品数量, 不能大于库存!');
            product_count_input.value = stock;
        }
    }
</script>