
 <?php $url = base_url()."public/bootstrap/";?>
<script src="<?php echo $url; ?>js/jquery.js"></script>
<script src="<?php echo $url; ?>js/bootstrap.min.js"></script>
<style type="text/css">
    /* Custom Styles */
    .container{
        width:60%;
        margin:0 auto;
    }
    .row ul.nav-tabs{
        width: 120px;
        margin-top: 20px;
        border-radius: 4px;
        border: 1px solid #ddd;
        font-size:0.8em;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.067);
    }
    .row ul.nav-tabs li{
        margin: 0;
        border-top: 1px solid #ddd;
    }
    .row ul.nav-tabs li:first-child{
        border-top: none;
    }
    .row ul.nav-tabs li a{
        margin: 0;
        padding: 8px 16px;
        border-radius: 0;
    }
    .row ul.nav-tabs li.active a,.row ul.nav-tabs li.active a:hover{
        color: #fff;
        background: #0088cc;
        border: 1px solid #0088cc;
    }
    .row ul.nav-tabs li:first-child a{
        border-radius: 4px 4px 0 0;
    }
    .row ul.nav-tabs li:last-child a{
        border-radius: 0 0 4px 4px;
    }
    .row ul.nav-tabs.affix{
        top: 30px; /* Set the top position of pinned element */
    }
    .col-xs-3,.jumbotron{
        margin-left:-20%;
        margin-right: 20px;
    }
    .jumbotron{
        text-align: right;
    }
    .jumbotron h1{
        font-size: 16px;
    }
    .col-xs-3{
        float:left;
    }
    .col-xs-9 h2,.col-xs-9 p{
        margin:0 0 10px 8%;
    }
    .oprate ,.label{
        margin: 0 20px;
        float:right;
    }
    .label-default{
        margin-right: 30px;
    }
    .menes ul li {
        margin-right: 30px;
        display: inline;
    }
    .error_message{
      float:right;
      font-size:12px;
      color:red;
      margin-top: -125px;
      margin-left: 50px
    }
    .error_message p{
      margin-bottom: 25px;
    }
    .panel-body input{
        right:20px;
    }
    </style>
<div class="container">
    <div class="jumbotron">
        <h1>
        <button type="button" class="btn btn-primary btn-lg" style="text-shadow: black 5px 3px 3px;">
            <span class="glyphicon glyphicon-user"></span>欢迎 <?php echo $_SESSION['user'];?>
         </button>
       </h1>
    </div>
    <div class="row">
        <div class="col-xs-3" id="myScrollspy">
            <ul class="nav nav-tabs nav-stacked" data-spy="affix" data-offset-top="125">
                <li class="active"><a href="#section-1">文章管理</a></li>
                <li><a href="#section-2">图片管理</a></li>
                <li><a href="#section-3">文件管理</a></li>
                <li><a href="#section-5">用户管理</a></li>
            </ul>
        </div>
        <div class="col-xs-9">
            <h4 id="section-1">文章管理</h4>
            <?php if (isset($all_article)): ?>
                    <?php foreach ($all_article as $key => $value): ?>
                            <?php echo "<p><span class='label-default'>".$value['id']."</span>".$value['titile']."<a class='oprate' href='#'>删除</a><a href='#' class='oprate'>修改</a><span class='label label-default'>分类：".$value['keyword']."</span></p>"; ?>
    
                    <?php endforeach ?>
                    <?php else: ?>
                    <?php      echo '没有任何文章'; ?>                            
            <?php endif ?>    

            <hr>
            <h4 id="section-2">图片管理</h4>
                <div class="panel-heading">
                  <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" 
                         href="#collapseTwo">
                         删除图片
                      </a>
                  </h4>
                </div>
                  <div class="panel-body">
                      
                  </div>
            <hr>
            <h4 id="section-3">文件管理</h4>
                <div class="panel panel-info">
                        <div class="panel-heading">
                           <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" 
                                 href="">
                                 上传文件
                              </a>
                           </h4>
                        </div>
                           <div class="panel-body">
                                <?php echo form_open_multipart('Administration/upFile');?>
                                    <label for="">选择文件
                                        <input type="file" name="upfile" multiple>
                                    </label>
                                    <?php echo $upload_error; ?>
                                    
                                    <button class='btn' type="submit">上传</button>
                                    </form>
                           </div>
                         
                </div>
                <div class="panel panel-warning">
                        <div class="panel-heading">
                           <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" 
                                 href="">
                                 文件删除
                              </a>
                           </h4>
                        </div>
                           <div class="panel-body">
                           <?php if ($fileslist): ?>
                                  <?php foreach ($fileslist as $key => $filename): ?>
                                      <?php echo "<p>".$key."<a class='oprate' href='#'>删除</a><span class='label'>文件大小".round(($filename['size']/1024/1024),3).'M</span></p><br/>'; ?>
                                  <?php endforeach ?>
                           <?php endif ?>
                           </div>
                        </div>
                </div>
            <hr>
            <h4 id="section-5">用户管理</h4>
                <?php 
                    if (isset($_SESSION['permission']) && ($_SESSION['permission'] == md5('1111') || $_SESSION['permission']==md5('0000')||$_SESSION['permission'] == md5('ssss'))){
                      // 判断管理员权限
                      if ($_SESSION['permission']==md5('1111')) {
                          // // 管理员信息列表
                          if (isset($user_list)) {
                              echo "
                             
                                  <div class='panel panel-info'>
                                      <div class='panel-heading'>
                                         <h4 class= 'panel-title'>
                                            <a data-toggle='collapse' data-parent='#accordion' 
                                               href='#collapseAdd'>
                                               增加管理员
                                            </a>
                                         </h4>
                                      </div>
                                         <div class='panel-body'>";
                              echo form_open('Administration/adduser');

                              echo "
                                      <label for=''>账号
                                        <input type='text' name='adminuser'>
                                      </label>
                                      <label for=''>密码
                                      <input type='password' name='password'>
                                      </label>
                                      <label for=''>确认密码
                                        <input type='password' name='pswconfirm'>
                                      </label>
                                      <label for=''>用户类型
                                        <select name='usertype'>
                                          <option value='Temp'>临时管理员</option>
                                          <option value='medium'>普通管理员</option>
                                          <option value='root'>终极管理员</option>
                                          
                                          </select>
                                      </label>
                                      <div class='error_message'>";
                                echo  validation_errors();
                                echo $success;
                                echo "</div>
                                      <div>
                                        <button type='submit'>提交</button>
                                      </div>
                                      </form>
                                    ";
                               
                                echo "     </div>
                                       </div>
                                       <div class='panel panel-warning'>
                                          <div class='panel-heading'>
                                             <h4 class='panel-title'>
                                                <a data-toggle='collapse' data-parent='#accordion' 
                                                   href='#collapseDel'>
                                                  删除管理员
                                                </a>
                                             </h4>
                                          </div>
                                             <div class='panel-body'>";
                                              $code = rand(0,100);
                                              $_SESSION['staticcode'] =$code ;
                                              foreach ($user_list as $key => $value) {
                                                  echo "<p>".$value['admin_name']."<a class='oprate' href='".site_url()."/Administration/delete?code=".$code."&re_id=".$value['id']."'>撤销管理员身份</a></p>"; 
                                              }
                                }else{
                                    echo "<span class='label'>没有管理员信息</span>";
                                }   
                          }else{
                                  if (isset($user_list)) {

                                      echo " <div class='panel panel-info'>
                                                        <div class='panel-heading'>
                                                           <h4 class= 'panel-title'>
                                                              <a data-toggle='collapse' data-parent='#accordion' href='#collapseAdd'>
                                                                 管理员列表
                                                              </a>
                                                           </h4>
                                                        </div>
                                                        <div id='collapseAdd' class='panel-collapse collapse'>
                                                           <div class='panel-body'>";

                                                foreach ($user_list as $key => $value) {

                                                    echo "<p>".$value['admin_name']."</p>"; 
                                                }
                                  }else{
                                       echo "<span class='label'>没有管理员信息</span>";
                                  }   
                          }
                        }else{
                                    // 
                                        echo "您没有查看管理员账号的权限";
                                    }
                                    echo "  </div>
                                          </div>
                                        </div>";
        
                                   ?>
                               </div>
                        </div>
            <hr>
        </div>
    </div>
</div>