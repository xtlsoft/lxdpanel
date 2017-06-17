<?php

return array(
        "API" => "CLI",
        "CLI" => array(
                // array(
                //     "Name"  => "lxdpanelWorker",
                //     "Port"  => 2345,
                //     "SSL"   => false,
                //     "IP"    => "0.0.0.0",
                //     "Thread"=> 3,
                //     "Debug" => true
                // ),
                array(
                    "Name"  => "lxdpanelMainWorker",
                    "Port"  => 5520,
                    "SSL"   => true,
                    "Cert"  => array(
                            "crt" => "/opt/XSite/Cert/crt.crt",
                            "key" => "/opt/XSite/Cert/key.key"
                        ),
                    "IP"    => "0.0.0.0",
                    "Thread"=> 3,
                    "Debug" => true
                ),
                array(
                    "Name"  => "lxdpanelConsoleWorker",
                    "type"  => "WebConsole",
                    "Port"  => 5521,
                    "SSL"   => true,
                    "Cert"  => array(
                            "crt" => "/opt/XSite/Cert/crt.crt",
                            "key" => "/opt/XSite/Cert/key.key"
                        ),
                    "IP"    => "0.0.0.0",
                    "Thread"=> 3,
                    "Debug" => true
                )
            ),
        "CLI-Tool"=>array(
                "Console"=>array(
                        "Server" => array(
                                "GottyBin"=>"/home/xtlsoft/.go/bin/gotty",
                                "Port"=>5521,
                                "Title"=>"lxdpanel Console"
                            )
                    )
            )
    );
    