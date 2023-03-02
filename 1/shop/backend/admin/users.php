<?php

// 查询用户信息并且展示
// 引入文件
require_once '../db.func.php';
require_once '../tools.func.php';
// 查询用户, 最后注册的先显示
$sql = "select id, username, name, age, email, phone, created_at from user order by created_at desc";
// 运行sql, 获取数据
$result = queryAll($sql);

?>
<?php include_once 'header.php'; ?>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <div class="row">
                    <div class="col-10">
                      <h4 class="card-title ">所有用户</h4>
                      <p class="card-category"> 用户列表</p>
                      <p class="card-category"> <?php if(hasInfo()) echo getInfo(basename($_SERVER['SCRIPT_NAME']));?></p>
                    </div>
                    <div class="col-2">
                      <a href="user_add.php" class="btn btn-round btn-info" style="margin-left: 20px;">添加用户</a>
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
                        用户名
                      </th>
                      <th>
                        姓名
                      </th>
                      <th>
                        年龄
                      </th>
                      <th>
                        邮箱
                      </th>
                      <th>
                        联系电话
                      </th>
                      <th>
                        注册时间
                      </th>
                      <th>
                        操作
                      </th>
                      </thead>
                      <tbody>
                        <?php foreach($result as $user):?>
                      <tr>
                        <td>
                          <?php echo $user['id'];?>
                        </td>
                        <td>
                          <?php echo $user['username'];?>
                        </td>
                        <td>
                          <?php echo $user['name'];?>
                        </td>
                        <td>
                          <?php echo $user['age'];?>
                        </td>
                        <td>
                          <?php echo $user['email'];?>
                        </td>
                        <td>
                          <?php echo $user['phone'];?>
                        </td>
                        <td>
                          <?php echo $user['created_at'];?>
                        </td>
                        <td>
                          <a href="user_edit.php?id=<?php echo $user['id']?>">编辑</a>
                          |
                          <a href="user_del.php?id=<?php echo $user['id']?>">删除</a>
                        </td>
                      </tr>
                    <?php endforeach;?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php include_once 'footer.php'; ?>