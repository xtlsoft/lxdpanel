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
    
    /*
    
  LXD Panel Console System
  Version 1.0.1
   ______                                          __
  |  ____|                      ______            |  |  ______
  | |       _______   _______  |  ____|  _______  |  | |  __  |
  | |      |  ___  | |  ___  | | |____  |  ___  | |  | | |__| |
  | |____  | |___| | | |   | | |____  | | |___| | |  | |  ____|
  |______| |_______| |_|   |_|  ____| | |_______| |__| | |____
                               |______|                |______|
                               
    */
    
    error_reporting(E_ALL&~E_NOTICE);
    
    $APIConfig = require("/opt/lxdpanel/Config.php");
    
    echo <<<EOF
        
 LXD Panel Console System
 Version 1.0.1
 
 WebTTY Based on GoTTY, Backend Based on lxdpanel.
 -------------------------------------------------------------
  ______                                          __
 |  ____|                      ______            |  |  ______
 | |       _______   _______  |  ____|  _______  |  | |  __  |
 | |      |  ___  | |  ___  | | |____  |  ___  | |  | | |__| |
 | |____  | |___| | | |   | | |____  | | |___| | |  | |  ____|
 |______| |_______| |_|   |_|  ____| | |_______| |__| | |____
                              |______|                |______|
 
 -------------------------------------------------------------
  
   Client Login:
      SessionID: 
EOF;
    $SessionID = trim(fgets(STDIN));
    echo <<<EOF
      SessionPass: 
EOF;
    $SessionPass = trim(fgets(STDIN));
    echo "\r\n      Loading...\r\n";
    
    /** Session Parse Start **/
    /*
        function SessionParse()
    */
    
    $Username = $SessionID;
    
    /** Session Parse Stop **/
    
    return $Username;
    
    // system("clear");
    
    
    // system("exit && bash -c \"lxc exec --mode=interactive ".$Username." bash\"");
    