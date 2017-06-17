<?php
    /**
     *  _   __     __       _
     * | |  \ \   / /      | |    LXD Panel
     * | |   \ \_/ /       | |    
     * | |    \   /    ____| |    Author: xtl(xtl@xtlsoft.top)
     * | |    / _ \   |  __  |    
     * | |   / / \ \  | |__| |    Made with love!
     * |_|  /_/   \_\ |______|    Have fun!
     * 
     */
    
    namespace Controller\Manage;
    
    use X\Base\Controller;
    use X\Header;
    use lxd\lxd;
    use XDO\XDO;
    use Model\Manage\User;
    
    class UserController extends Controller{
        public function __construct($var){
            if($var['action'] != "logout"){
                if(User::isLoggedIn()){
                    Header::jump($_GET['refer'] ? $_GET['refer'] : "/manage/");
                }
            }
        }
        public function Login(){
            $this->View("Login/Login");
        }
        public function Test(){
            echo '<pre>';
            var_dump(lxd::list("xtlsoft","ubuntu:"));
        }
        public function init(){
            $time = User::getUserInfo("xtlsoft")['createDate'];
            User::setUserInfo("xtlsoft","password",User::encryptPassword("123456",$time));
        }
        public function checkLogin(){
            
            $data = json_decode($_GET['data'],1);
            $row = User::getUserInfo($data['account']);
            
            if(User::encryptPassword($data['password'],$row['createDate'],1) === $row['password']){
                $_SESSION['lxd_user_login'] = $data['account'];
                $_SESSION['lxd_user_login_pass'] = $row['password'];
                $status = "success";
            }else{
                $status = "error";
            }
            
            $this->Data = array(
                    "status"=>$status
                );
            $this->view("System/Json");
        }
        public function logout(){
            unset($_SESSION['lxd_user_login']);
            unset($_SESSION['lxd_user_login_pass']);
            Header::jump($_GET['refer'] ? $_GET['refer'] : "/login/?msg=Logged+out!");
        }
    }