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
     
    namespace Model\Manage;
    
    use XDO\XDO;
     
    class User{
        public static function initDB(){
            return XDO::Database("Machine");
        }
        public static function getUserInfo($username){
            return self::getAllUser()[$username];
        }
        public static function setUserInfo($username,$key,$value){
            $db=self::initDB();
            return $db->put("Machine.where[name=$username]",array($key=>$value));
            
        }
        public static function getAllUser(){
            $db=self::initDB();
            $row = $db->get("Machine");
            $row = $db->getAssoc($row,"name");
            return $row;
        }
        public static function encryptPassword($pwd,$time,$fromJson=0){
            if($fromJson){
                return hash("sha512",hash("sha256",hash("sha256",hash("sha256",$time).hash("sha256",hash("sha256",$pwd.$time).hash("sha256",$time)))));
            }
            return hash("sha512",hash("sha256",hash("sha256",hash("sha256",$time).hash("sha256",hash("sha256",md5($pwd).$time).hash("sha256",$time)))));
        }
        public function isLoggedIn(){
            if(!$_SESSION['lxd_user_login']) return false;
            $account = $_SESSION['lxd_user_login'];
            $password = $_SESSION['lxd_user_login_pass'];
            if(self::getUserInfo($account)['password'] == $password){
                return true;
            }
        }
    }