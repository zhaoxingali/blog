<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    
    <style>
    header{
        height:50px;
        background: #CDCDCD;
    }
    body,header,nav,ul,li{
        margin:0;
        padding: 0;
        
    }
    nav{
        margin:0 auto;
        width: 70%;
        height:50px;
    }
    nav ul{
        list-style-type:none;
        overflow:hidden;
    }
    nav ul li{
        float: left;
        margin:1% 0;
        margin-left: 3%;
    }
    nav ul li a:link,nav ul li a:visited
    {
        display:block;
        /*width:80px;*/
        font-weight:bold;
        font-variant:small-caps;
        font-size: 24px;
        font-style: italic;
        color:rgba(158,158,158,1);
        text-align:center;
        padding:4px;
        text-decoration:none;
        text-transform:uppercase;
    }
    nav ul li a:hover,nav ul li a:active
    {
        color:#B11C3F;
    }
    </style>
  
</head>
<body>
<header>
    <nav>
        <ul>
            <?php 
            //创建一个数组存放分类
            $nav_ul = array();
            //将文章的分类提取出来
            for ($i=0; $i < count($articles) ; $i++) { 
                $nav_ul[$i] = $articles[$i]['keyword'];
            }
            //去重
            $nav_ul = array_unique($nav_ul);
            echo "<li><a href='".site_url()."/Blog/Get_article'>首页</a></li>";
            for ($i=0; $i < count($nav_ul); $i++) { 
                echo "<li><a href='".site_url()."/Blog/get_keyword_arricle/".$nav_ul[$i]."'>".$nav_ul[$i]."</a></li>";
            }
             ?>
        </ul>
    </nav>
</header>