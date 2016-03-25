<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/*
*创建Admin类实现登陆操作
*
*/
class Admin extends CI_Model
{
    

    //将文章表设置为私有变量
    private $articletable = 'admin';
    //构造函数
    public function __construct()
    {

        parent::__construct();
        
        //加载文章数据库

        $this->load->database();

    }

    //得到登陆人的信息
    public function get_admin($username)
    {
            $sql = "SELECT admin_password FROM $this->articletable WHERE admin_name = ?";
            $query = $this->db->query($sql,array($username));
            return $query->result_array();
    }
}
 ?>
