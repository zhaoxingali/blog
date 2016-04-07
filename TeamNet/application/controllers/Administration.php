<?php

/*
* 后台管理逻辑控制器

* 主要功能，实现的是页面的文章的删除修改，移动

* 包括文件资料的上传，静态文件的调用

* author by zxl 
*/ 

class Administration extends CI_Controller
{
    //初始化造类

    public function __construct()
    {
        parent::__construct();
        // 指定数据层
        $this->load->model('Administ');

        $this->load->model('Article');

        $this->load->model('Admin');

        $this->load->helper('url_helper');

        $this->load->library('session');

        $this->load->helper('file');

        $this->load->library('form_validation');

        $this->load->helper(array('form', 'url'));

    }
    // 加载视图层，其中$path 为指定的路径地址，$data 表示前端渲染的数据
    public function loadView($path,$data){
       
        //加载模板
        $this->load->view('templates/admin_header');

        $this->load->view('manage/'.$path,$data);
        // 加载模板
        $this->load->view('templates/admin_footer');
    }

    //加载后台首页 
    public function adminIndex()
    {

        $data['all_article'] = $this->Article->GetList();

        $data['user_list'] = $this->Administ->getuserlist();

        $data['fileslist'] = $this->getFilesList();

        $data['upload_error'] = '';

        $data['success'] = '';

 
        $this->loadView('index',$data);
    }

    // 文件上传
    public function upFile($file=FALSE)
    {

            
            //配置文件信息
            $config['upload_path'] = getcwd().'/uploads/';
            $config['allowed_types'] = '|png|jpg|pdf|psd|pptx|doc|docx|zip|rar|txt|xls|php|js|html|css|7z';
            $config['file_ext_tolower'] = FALSE;
            $config['overwrite'] = FAlSE;
            $config['max_size'] = 2048;
            $config['max_width'] = 1024;
            $config['max_height'] =1024;
            //加载文件上传类，并初始化
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            // 上传类调用上传函数
            if (!$this->upload->do_upload('upfile')) {
                $upload_error = $this->upload->display_errors();

                $data['all_article'] = $this->Article->GetList();

                $data['user_list'] = $this->Administ->getuserlist();

                $data['upload_error'] = $upload_error;

                $this->loadView('index',$data);

            }else{               
                redirect('Administration/adminIndex',$data);
            }
       
    }

    // 读取文件的列表

    public function getFilesList()
    {
        $Files = get_dir_file_info(getcwd().'/uploads/');
        // var_dump($Files);
        return $Files;
    }

    // 删除文件
    public function deleteFiles($filesname=FALSE)
    {
        if (isset($filesname) && $filesname!= FALSE) {

            
        }else{

        }
    }
    
    public function adduser()
    {

        $this->form_validation->set_rules('adminuser', 'Username', 'trim|required|min_length[3]|max_length[12]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('pswconfirm', 'Password Confirmation', 'trim|required|matches[password]');
        if ($this->form_validation->run() == FALSE) {
            $this->adminIndex();
        }else{
            $admin_name = $_POST['adminuser'];
            $admin_password = md5($_POST['password']);
            $usertype = $_POST['usertype'];
            switch ($usertype) {
                case 'root':
                    $permistion = md5('1111');
                    break;
                case 'medium':
                    $permistion = md5('0000');
                    break;
                default:
                    $permistion = md5('sssss');
                    break;
            }
            $mess = array('admin_name'=>$admin_name,'admin_password'=>$admin_password,'admin_permistion'=>$permistion);
            $result = $this->Admin->insertadmin($mess);
            if ($result == true) {
                $data['success'] = 'success';
                $data['all_article'] = $this->Article->GetList();

                $data['user_list'] = $this->Administ->getuserlist();

                $data['fileslist'] = $this->getFilesList();

                $data['upload_error'] = '';


                $this->loadView('index',$data);
            }else{
                $data['add error'] = 'error';
            }

         }
    }
    public function delete()
    {
        if (isset($_GET['code']) &&($_GET['code']==$_SESSION['staticcode']) && isset($_GET['re_id'])) {
            $del  = array('id' =>$_GET['re_id']);
            $this->Admin->delete($del);
            // $result = $this->Admin->update($updata);
        }else{
            echo 'Illegal link';
        }
    }
}

 ?>