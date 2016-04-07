<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller 
{

    

    public function __construct()
    {

        parent::__construct();
        //加载admin数据模型
        $this->load->model('Admin');
        //初始化session类
        $this->load->library('session');
        $this->load->helper('url_helper');
    }

    //加载登陆页面
    public function load_login()
    {   
        /*
        *此处可以用CI的表单验证类，未研究清楚自己写验证
        *需要加载$this->form
        */ 
        //加载登录页面
        // $this->load->view('templates/header');
        
        $this->load->view('login');
        // $this->load->view('templates/footer');

    }
    //登录判断
    public function check()
    {
        $username = $_POST['username'];
        $psw = $_POST['password'];
        if ($username === '' || $psw === '' ) 
        {
            //加载登录页面
            
            $data['mess'] = "账号或密码为空";
            $this->load->view('login',$data);

            return false;

        }else if (strlen($username)>16 || strlen($psw)>16) 
        {

            
            $data['mess'] = "用户名和密码太长";
            $this->load->view('login',$data);
            return false;

        }else{

            $row = $this->Admin->get_admin($username);
            if (count($row)!=0) {
                if ($row[0]['admin_password']==md5($psw)) 
                {
                    $this->session->set_userdata(array('user'=>$username,'permission'=>$row[0]['permission']));
                    redirect('Administration/adminIndex');
    
                }else{
                    
                    $data['mess'] =  "账号和密码不符合";
                    $this->load->view('login',$data);
                    return false;
                }
            }else{
                $data['mess'] =  "未找到当前用户";
                $this->load->view('login',$data);
                return false ;
            }
            
        }
    }
}

?>
