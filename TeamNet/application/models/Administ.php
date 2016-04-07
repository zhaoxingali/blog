<?php

 //后台数据层 

class Administ extends CI_Model
{
    

    //将文章表设置为私有变量
    private $admintable = 'admin';
    //构造函数
    public function __construct()
    {

        parent::__construct();
        
        //加载文章数据库

        $this->load->database();

    }

    public function getuserlist($slug=FALSE)
    {
        //判断文章的id是否存在
        if ($slug===FALSE) {

            $query = $this->db->get($this->admintable);

            return $query->result_array();

        }else{

            $slug = intval($slug);

            $sql = "SELECT * FROM ". $this->admintable. " WHERE id=".$slug;

            $query = $this->db->query($sql);

            return $query->result_array();
        }
    }
}
 ?>