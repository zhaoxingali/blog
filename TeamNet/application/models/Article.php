<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
/*
*创建Article类实现文章的读取
*
*/
class Article extends CI_Model
{
    /*
    *包括文章发布和文章列表页

    *文章的获取

    *文章修改

    *文章删除
    */

    //将文章表设置为私有变量
    private $articletable = 'entries';

    public function __construct(){

        parent::__construct();
        
        //加载文章数据库

        $this->load->database();

    }
    // 获取文章列表 参数为文章id
    public function GetList($slug=FALSE)
    {
        //判断文章的id是否存在
        if ($slug===FALSE) {

            $query = $this->db->get($this->articletable);

            return $query->result_array();

        }else{

            $slug = intval($slug);

            $sql = "SELECT * FROM ". $this->articletable. " WHERE id=".$slug;

            $query = $this->db->query($sql);

            return $query->result_array();
        }
    }
    // 获取关键词的文章，参数为查询分类
    public function Getallarticle($keyword)
    {
        $sql = "SELECT * FROM $this->articletable WHERE keyword = ?";

        $query = $this->db->query($sql,array($keyword));

        return $query->result_array();
    }

    //得到相应页面的条数 $arr数组三个参数 第一个是查询条件，第二个为查询条数，第三个为偏移量
    public function get_limit_articles($arr= array('keyword'=>FALSE,'num'=>FALSE,'offset'=>FALSE))
    {

        if (isset($arr['keyword']) && isset($arr['num']) && isset($arr['offset']) && $arr['keyword']!==FALSE && $arr['num']!==FALSE && $arr['offset']!==FALSE) {

            $count = count($this->Getallarticle($arr['keyword']));
           
            if ($count<=1) {

                $result = $this->Getallarticle($arr['keyword']);

            }else{

                $sql = "SELECT * FROM $this->articletable WHERE keyword = ? ORDER BY id DESC LIMIT ".$arr['offset'].",".$arr['num'];
                $query = $this->db->query($sql,array($arr['keyword']));
                $result = $query->result_array();
            }
            return $result;
        }else{
            echo "not find";
        }
    }

}
 ?>
