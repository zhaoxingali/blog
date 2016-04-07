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

    //得到登录的管理员的信息
    public function get_admin($username)
    {
            $sql = "SELECT admin_password,permission FROM $this->articletable WHERE admin_name = ?";
            $query = $this->db->query($sql,array($username));
            return $query->result_array();
    }

    //插入管理员信息
    public function insertadmin($data)
    {
        $sql = " INSERT INTO $this->articletable (id,admin_name,permission,admin_password) values(NULL,".$this->db->escape($data['admin_name']).",".$this->db->escape($data['admin_permistion']).",".$this->db->escape($data['admin_password']).")";

        $result =$this->db->query($sql);
        return $result;
    }

    //更新权限信息
    public function delete($data)
    {
        if (isset($data)) {
            

             $this->db->where('id',$data['id']);
            // $where = "id = ".$data['id'];

            $str = $this->db->delete($this->articletable);
            
            echo $str;
        }
           
    }

}
 ?>
