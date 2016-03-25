<!-- 查询分页 -->
<style>
    .classify{
        width: 80%;
        margin: 0 auto;
        margin-left: 5%;
        margin-bottom: 50px;
    }
    .content{
        margin-top: 20px;
    }
    .page{
        margin-left: 5%;
    }
</style>
<div class="classify">
    <?php 
    foreach ($all_keyword_article as $key) {
     ?>
    <h1><?php echo $key['titile']; ?></h1>
    <div>
        <span><?php echo $key['keyword'];?></span>
    </div>
    <div class="content">
        <?php echo $key['content'];?>
    </div>
    <?php }; ?>
</div>
<div class='page'>
    <?php
     //显示并分页
    echo $this->pagination->create_links();

     ?>
</div>