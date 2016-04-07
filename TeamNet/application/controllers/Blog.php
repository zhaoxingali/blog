<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

	/*
    *
    *文章发布功能的实现
    *文章列表的读取
    *设置文章url
    *by jack zhao
    *
    */ 
    public function __construct(){
            /*
            *parent::__construct()调用了CI_Controller
            *加载数据模型Article
            */ 
            parent::__construct();
            // 加载数据层
            $this->load->model('Article');
    
            $this->load->helper('url_helper');


    }

    // 加载模板 $path表示视图所在的路径，$data表示渲染数据

    public function loadview($path,$data)
    {
        $this->load->view('templates/header',$data);
            //加载文章页
        $this->load->view($path,$data);
            //加载尾部模板
        $this->load->view('templates/footer');
    }

    //获取导航项
    public function get_nav_li(){
        $result = $this->Article->GetList();
        return $result;
    }
    //获取全部文章标题列表
	public function Get_article()
	{
            // 获取文章列表
          	
            $data['articles'] = $this->get_nav_li();

            $data['title'] = "最近动态";

            $this->loadview('index',$data);
            
	}
    //获取单个文章
    public function get_one_article($slug)
    {
            //查询点击的新闻
            $data['one_article'] = $this->Article->GetList($slug);
            //获取导航条
            $data['articles'] = $this->get_nav_li();
            //如果文章为空，返回404
            if (empty($data['one_article'])) {
                show_404();
            }
            //传送数据
            $data['row'] = $data['one_article'];
            
            //加载视图模板
            $this->loadview('article/news',$data);
    }

    // 获取对应关键字下的文章

    public function get_keyword_arricle($keyword=FALSE,$page=0)
    {  
        // echo $_GET['keyword'];
        if (!isset($keyword) || $keyword == FALSE ) {
            $keyword = $_GET['keyword'];
            if (!isset($_GET['per_page'])) {
                $page = 0;
            }else{
                $page = $_GET['per_page']-1;
            }
        }

        $this->load->library('pagination');
        // 每页显示的文章数
        $limit['num'] = 1;
        //设置页面偏移数
        $limit['offset'] = $page;
        //关键字
        $limit['keyword'] = $keyword;
        //设置分页url
        $config['base_url'] = site_url('Blog/get_keyword_arricle?keyword='.$keyword);

        $config['total_rows'] = count($this->Article->Getallarticle($keyword));

        $config['per_page'] = $limit['num'];

        $config['keyword'] = $limit['keyword'];

        $config['use_page_numbers'] = TRUE;

        $config['page_query_string'] = TRUE;

        $this->pagination->initialize($config);

        //获取导航条
        $data['articles'] = $this->get_nav_li();

        $data['all_keyword_article'] = $this->Article->get_limit_articles($limit);

        $this->loadview('article/classify',$data);                          
    }
}
