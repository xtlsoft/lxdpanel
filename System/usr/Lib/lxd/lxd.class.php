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
    
    namespace lxd;
    
    class lxd{
        public static function list($name = ""){
            $exp = explode("\n",shell_exec("lxc list ".$name));
            $res=array();
            foreach($exp as $k=>$v){
                if($k % 2 && $k!=1 && $v!=""){
                    $exp2 = explode("|",$v);
                    $exp3 = explode(" (",trim($exp2[3]));
                    $res[] = array(
                    "name"=>trim($exp2[1]), 
                    "status"=>trim($exp2[2]), 
                    "ipv4"=>$exp3[0], 
                    "card"=>substr($exp3[1],0,strlen($exp3[1])-1),
                    "ipv6"=>trim($exp2[4])
                    );
                }
            }
            return $res;
        }
        public static function stop($name){
            return shell_exec("lxc stop $name");
        }
        public static function start($name){
            return shell_exec("lxc start $name");
        }
        public static function delete($name){
            return shell_exec("lxc delete $name -f");
        }
        public static function restart($name){
            return shell_exec("lxc restart $name");
        }
        public static function launch($name,$image){
            return shell_exec("lxc launch $image $name");
        }
        public static function reinstall($name,$image){
            self::delete($name);
            return self::launch($name,$image);
        }
    }