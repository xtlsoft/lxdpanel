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
    
    use Workerman\Worker;
    use Workerman\Protocols\Http;
    use \Workerman\Connection\TcpConnection;
    require_once __DIR__.'/Workerman/Autoloader.php';
    
    //加载配置
    global $APIConfig;
    
    foreach($APIConfig['CLI'] as $conf){
        
        if($conf['type'] == "WebConsole"){
            if($conf['SSL']){
                $worker = new Worker("Websocket://{$conf['IP']}:{$conf['Port']}",array("ssl" => array(
                        "local_cert" => $conf['Cert']['crt'],
                        "local_pk"   => $conf['Cert']['key']
                    )));
                $worker->transport = 'ssl';
                $APIConfig['_WebConsoleProtocol'] = "wss";
            }else{
                $worker = new Worker("Websocket://{$conf['IP']}:{$conf['Port']}");
                $APIConfig['_WebConsoleProtocol'] = "ws";
            }
            $APIConfig['_WebConsolePort'] = $conf['Port'];
            $worker->name = $conf['Name'];
            $worker->count = $conf['Thread'];
            
            $worker->onConnect = function($connection){
                //To do this, PHP_CAN_DO_PTS must be enabled. See ext/standard/proc_open.c in PHP directory.
                $descriptorspec = array(
                    0 => array('pty'),
                    1 => array('pty'),
                    2 => array('pty')
                );
    
                //Pipe can not do PTY. Thus, many features of PTY can not be used.
                //e.g. sudo, w3m, luit, all C programs using termios.h, etc.
                // $descriptorspec = array(
                //     0=>array("pipe", "r"),
                //     1=>array("pipe", "w"),
                //     2=>array("pipe", "w")
                // );
    
                unset($_SERVER['argv']);
                $env = array_merge(
                    array('COLUMNS'=>130, 'LINES'=> 50), $_SERVER
                );
                $connection->process = proc_open("sh /opt/lxdpanel/CLI-Tool/Console/Client.sh", $descriptorspec, $pipes, null, $env);
                $connection->pipes = $pipes;
                stream_set_blocking($pipes[0], 0);
                $connection->process_stdout = new TcpConnection($pipes[1]);
                $connection->process_stdout->onMessage = function($process_connection, $data)use($connection)
                {
                    $connection->send($data);
                };
                $connection->process_stdout->onClose = function($process_connection)use($connection)
                {
                    $connection->close();   //Close WebSocket connection on process exit.
                };
                $connection->process_stdin = new TcpConnection($pipes[2]);
                $connection->process_stdin->onMessage = function($process_connection, $data)use($connection)
                {
                    $connection->send($data);
                };
            };
            
            $worker->onMessage = function($connection, $data)
            {
                // if(ALLOW_CLIENT_INPUT)
                // {
                    fwrite($connection->pipes[0], $data);
                // }
            };
            
            $worker->onClose = function($connection)
            {
                $connection->process_stdin->close();
                $connection->process_stdout->close();
                fclose($connection->pipes[0]);
                $connection->pipes = null;
                proc_terminate($connection->process);
                proc_close($connection->process);
                $connection->process = null;
            };

            $worker->onWorkerStop = function($worker)
            {
                foreach($worker->connections as $connection)
                {
                    
                    $connection->process_stdin->close();
                    $connection->process_stdout->close();
                    fclose($connection->pipes[0]);
                    $connection->pipes = null;
                    proc_terminate($connection->process);
                    proc_close($connection->process);
                    $connection->process = null;
                    
                    $connection->close();
                    
                }
            };
            
            continue;
        }
        
        
        if($conf['SSL']){
            $http_worker = new Worker("http://{$conf['IP']}:{$conf['Port']}",array("ssl" => array(
                    "local_cert" => $conf['Cert']['crt'],
                    "local_pk"   => $conf['Cert']['key']
                )));
            $http_worker->transport = 'ssl';
        }else{
            $http_worker = new Worker("http://{$conf['IP']}:{$conf['Port']}");
        }
        
        $http_worker->name = $conf['Name'];
        
        $http_worker->count = $conf['Thread'];
        
        $http_worker->onMessage = function($_CONN, $_DATA)use($conf)
        {
            
            // //Start time
            // $start = microtime();
            
            $_GLOBALS['_DATA'] = $_DATA;
            
            @ob_start();
            
            //定义系统目录
            defined("SysDir") or define("SysDir",dirname(dirname(__FILE__)) .'/System/' );
            //加载应用
            $App = require(SysDir.'init.php');
            
            // Http::header("X-Execute-Time: ".microtime()-$start);
            
            $_CONN->send(ob_get_clean());
            
            if($conf['Debug']){
                die();
            }
        };
    }

    // 运行worker
    Worker::runAll();