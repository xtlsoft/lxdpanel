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
    
    class IndexController extends Controller{
        public function Index(){
            $this->Data['sitename'] = $GLOBALS['_C']['sitename'];
            $this->View("Index");
        }
    }