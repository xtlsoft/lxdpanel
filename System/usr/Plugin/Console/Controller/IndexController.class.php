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
    
    namespace Controller\Console;
    
    use X\Base\Controller;
    
    class IndexController extends Controller{
        public function WebTTY(){
            global $APIConfig;
            
            $this->Data['Port'] = $APIConfig['_WebConsolePort'];
            $this->Data['Protocol'] = $APIConfig['_WebConsoleProtocol'];
            
            $this->View("Console/WebTTY");
        }
    }