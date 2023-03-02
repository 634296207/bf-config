<?php include_once 'header.php'; ?>

    <div class="cart-main-area bg__white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <p><?php if (hasInfo()) echo getInfo(basename($_SERVER['SCRIPT_NAME'])) ?></p>
                    <form action="#">
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th class="product-thumbnail"></th>
                                    <th class="product-name">商品名称</th>
                                    <th class="product-price">单价</th>
                                    <th class="product-quantity">数量</th>
                                    <th class="product-subtotal">总计</th>
                                    <th class="product-remove">编辑</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($cart_result as $cart): ?>
                                    <tr>
                                        <td class="product-thumbnail"><a href="#"><img
                                                        src="<?php echo($cart['pic']); ?>"
                                                        alt="product img"/></a></td>
                                        <td class="product-name"><a href="#"><?php echo($cart['name']); ?></a></td>
                                        <td class="product-price"><span
                                                    class="amount">￥<?php echo($cart['price']); ?></span></td>
                                        <td class="product-quantity"><input type="number"
                                                                            value="<?php echo($cart['product_count']); ?>"/>
                                        </td>
                                        <td class="product-subtotal">￥<?php echo sprintf('%.2f', $cart['sum']) ?></td>
                                        <td class="product-remove"><a
                                                    href="cart_delete.php?id=<?php echo $cart['id'] ?>">X</a></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-7 col-xs-12">
                                <div class="buttons-cart">
                                    <a href="#">继续购物</a>
                                </div>

                            </div>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <div class="cart_totals">
                                    <table>
                                        <tbody>
                                        <tr class="cart-subtotal">
                                            <th>小计</th>
                                            <td>
                                                <span class="amount">￥<?php echo sprintf('%.2f', $total_price); ?></span>
                                            </td>
                                        </tr>
                                        <tr class="shipping">
                                            <th>快递</th>
                                            <td>
                                                <ul id="shipping_method">
                                                    <li>
                                                        <input type="radio" checked/>
                                                        <label>
                                                            包邮
                                                        </label>
                                                    </li>
                                                    <li></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>总价</th>
                                            <td>
                                                <strong><span
                                                            class="amount">￥<?php echo sprintf('%.2f', $total_price); ?></span></strong>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <div class="wc-proceed-to-checkout" style="clear: both;">
                                        <a href="checkout.php">去付款</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="only-banner ptb--10 bg__white">
    </div>
<?php include_once 'footer.php'; ?>