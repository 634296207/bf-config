<?php

require_once '../db.func.php';
require_once '../tools.func.php';

$prefix = getDBPrefix();

$sql = "select * from {$prefix}product order by created_at desc";

$products = queryAll($sql);




?>




<?php include_once 'header.php'; ?>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <div class="row">
                    <div class="col-10">
                      <h4 class="card-title ">所有商品</h4>
                      <p class="card-category"> 所有商品列表</p>
                      <p><?php if(hasInfo()) echo getInfo(basename($_SERVER['SCRIPT_NAME']));?></p>
                    </div>
                    <div class="col-2">
                      <a href="product_add.php" class="btn btn-round btn-info" style="margin-left: 20px;">添加商品</a>
                    </div>
                  </div>

                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead class=" text-primary">
                      <th>
                        ID
                      </th>
                      <th>
                        商品编号
                      </th>
                      <th>
                        商品名称
                      </th>
                      <th>
                        商品描述
                      </th>
                      <th>
                        商品库存
                      </th>
                      <th>
                        商品单价
                      </th>
                      <th>
                        商品上架时间
                      </th>
                      <th>
                        编辑
                      </th>
                      </thead>
                      <tbody>
                        <?php foreach($products as $product):?>
                      <tr>
                        <td>
                          <?php echo $product['id']; ?>
                        </td>
                        <td>
                          <?php echo $product['code']; ?>
                        </td>
                        <td>
                          <?php echo mb_substr($product['name'], 0,15,'utf-8').' ...'; ?>
                        </td>
                        <td>
                          <?php echo mb_substr($product['description'], 0,15,'utf-8').' ...'; ?>
                        </td>
                        <td>
                          <?php echo $product['stock']; ?>
                        </td>
                        <td>
                          <?php echo $product['price']; ?>
                        </td>
                        <td>
                          <?php echo $product['created_at']; ?>
                        </td>
                        <td>
                          <a href="product_edit.php?id=<?php echo $product['id']; ?>">编辑</a>
                          |
                          <a href="product_del.php?id=<?php echo $product['id']; ?>">删除</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php include_once 'footer.php'; ?>