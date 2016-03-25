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

    public function check()
    {
        $username = $_POST['username'];
        $psw = $_POST['password'];
        if ($username === '' || $psw === '' ) 
        {
            //加载登录页面
            $this->load_login();
            echo "数据为空";
            return false;

        }else if (strlen($username)>16 || strlen($psw)>16) 
        {

            $this->load_login();
            echo '用户名或密码太长';

        }else{

            $row = $this->Admin->get_admin($username);
            if ($row[0]['admin_password']==md5($psw)) 
            {
                $this->session->set_userdata(array('user'=>$username));
                redirect('/Blog/Get_article');

            }else{
                $this->load_login();
                echo "账号和密码不符合";
            }
        }
    }
}

?>
