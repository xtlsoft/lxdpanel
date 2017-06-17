#!/bin/sh

#
# A Part of lxdpanel
# LXD Console Client
#

echo -n "        
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
      SessionID: "

export LXD_PANEL_SESSIONID=`php /opt/lxdpanel/CLI-Tool/Common/STDIN.php`

echo -n "      SessionPass: "

export LXD_PANEL_SESSIONPASS=`php /opt/lxdpanel/CLI-Tool/Common/STDIN.php`

echo "\n\n      Loading..."

export LXD_PANEL_HOSTNAME=`php /opt/lxdpanel/CLI-Tool/Console/ParseHostname.php "$LXD_PANEL_SESSIONID" "$LXD_PANEL_SESSIONPASS"`

clear

echo "        
 Welcome to LXD Cloud Compute Platform!
 -------------------------------------------------------------
  ______                                          __
 |  ____|                      ______            |  |  ______
 | |       _______   _______  |  ____|  _______  |  | |  __  |
 | |      |  ___  | |  ___  | | |____  |  ___  | |  | | |__| |
 | |____  | |___| | | |   | | |____  | | |___| | |  | |  ____|
 |______| |_______| |_|   |_|  ____| | |_______| |__| | |____
                              |______|                |______|
 
 -------------------------------------------------------------
 Enjoy Using!\n"

lxc exec $LXD_PANEL_HOSTNAME bash

echo "
  ____________________________
 |                            |
 |Goodbye! Welcome back again!|
 |____________________________|
"