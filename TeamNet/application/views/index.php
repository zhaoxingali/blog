<style>
    .article_list{
        width: 10%;
        margin-left: 5%;
        border-right: 2px solid #C6C2C2;
    }
</style>
<div>
    <div class="article_list">
        <!-- start 输出最近动态 -->
        <?php 
        echo "<h4>".$title."</h4>";
         ?>
         <!-- start 逆序输出最近发布的文章 -->
        <?php
        for ($i=count($articles)-1; $i >=0 ; $i--) { 

         ?>
         <p><a href="<?php echo site_url('Blog/get_one_article/'.$articles[$i]['id']); ?>"> 
            <?php echo $articles[$i]['titile']; ?></a></p>
        <?php 
            }
         ?>
    </div>
    <div class="article_content">
        
    </div>
</div>

