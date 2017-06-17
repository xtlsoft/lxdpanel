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
    
    $APIConfig = require("../Config.php");
    
    if($argv[1] == "stop"){
        echo <<<EOF
LXD Panel Console System
Version 1.0.1
-------------------------------------------------------------
 ______                                          __
|  ____|                      ______            |  |  ______
| |       _______   _______  |  ____|  _______  |  | |  __  |
| |      |  ___  | |  ___  | | |____  |  ___  | |  | | |__| |
| |____  | |___| | | |   | | |____  | | |___| | |  | |  ____|
|______| |_______| |_|   |_|  ____| | |_______| |__| | |____
                             |______|                |______|

-------------------------------------------------------------
[Server] Stopping...

EOF;
        system("sudo pkill -f gotty");
        echo "[Server] Stopped.\r\n";
        die;
    }
    
    echo <<<EOF
LXD Panel Console System
Version 1.0.1
-------------------------------------------------------------
 ______                                          __
|  ____|                      ______            |  |  ______
| |       _______   _______  |  ____|  _______  |  | |  __  |
| |      |  ___  | |  ___  | | |____  |  ___  | |  | | |__| |
| |____  | |___| | | |   | | |____  | | |___| | |  | |  ____|
|______| |_______| |_|   |_|  ____| | |_______| |__| | |____
                             |______|                |______|

-------------------------------------------------------------
[Server] Starting up...

EOF;

// system("bash -c \"".$APIConfig['CLI-Tool']['Console']['Server']['GottyBin']." -w --title-format \\\"".$APIConfig['CLI-Tool']['Console']['Server']['Title']."\\\" -p ".$APIConfig['CLI-Tool']['Console']['Server']['Port']." php /opt/lxdpanel/CLI-Tool/Console/Client.php"."\"");
// system($APIConfig['CLI-Tool']['Console']['Server']['GottyBin']." -w --title-format \"".$APIConfig['CLI-Tool']['Console']['Server']['Title']."\" -p ".$APIConfig['CLI-Tool']['Console']['Server']['Port']." lxc exec xtlsoft bash");
system("bash -c \"".$APIConfig['CLI-Tool']['Console']['Server']['GottyBin']." -w --title-format \\\"".$APIConfig['CLI-Tool']['Console']['Server']['Title']."\\\" -p ".$APIConfig['CLI-Tool']['Console']['Server']['Port']." sh /opt/lxdpanel/CLI-Tool/Console/Client.sh"."\"");

echo "[Server] Started.
";