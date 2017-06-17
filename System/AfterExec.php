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
    
    /*#?? AfterExec File ??#*/
    
    namespace lxdpanel\AfterExec;
    
    /* function setHeader() */
    \X\Header::set("X-Execute-Time: ".((microtime()-$GLOBALS['_startTime'])*1000)."ms");
    \X\Header::set("X-Powered-By: lxdpanel");
    \X\Header::set("X-WebServer: Workerman-lxdpanel");
    \X\Header::set("X-Program-Author: xtl<xtl@xtlsoft.top>");