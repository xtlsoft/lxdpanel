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
    
    class MainController extends Controller{
        public function Index(){
            $this->Data = array(
                    "code" => "403",
                    "msg"  => "Forbidden",
                    "infomation"=> "lxdpanel.staticFile.MainController:Index"
                );
            $this->View("Manage/Index");
        }
    }