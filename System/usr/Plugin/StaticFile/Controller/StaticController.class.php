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
    
    namespace Controller\StaticFile;
    
    use X\Base\Controller;
    use X\Error;
    use Workerman\WebServer;
    use Workerman\Protocols\Http;
    
    class StaticController extends Controller{
        
        public function Handle($var){
            $path = $var['path'];
            if(is_file(StaticDir.$path)){
                WebServer::initMimeTypeMapStatic();
                $file_path = StaticDir.$path;
                // Check 304.
                $info = stat($file_path);
                $modified_time = $info ? date('D, d M Y H:i:s', $info['mtime']) . ' ' . date_default_timezone_get() : '';
                if (!empty($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $info) {
                    // Http 304.
                    if ($modified_time === $_SERVER['HTTP_IF_MODIFIED_SINCE']) {
                        // 304
                        Http::header('HTTP/1.1 304 Not Modified');
                        return;
                    }
                }
                
                // Http header.
                if ($modified_time) {
                    $modified_time = "Last-Modified: $modified_time";
                }
                $file_size = filesize($file_path);
                $file_info = pathinfo($file_path);
                $extension = isset($file_info['extension']) ? $file_info['extension'] : '';
                $file_name = isset($file_info['filename']) ? $file_info['filename'] : '';
                $header = "HTTP/1.1 200 OK\r\n";
                if (isset(WebServer::$mimeTypeMap[$extension])) {
                    Http::header("Content-Type: " . WebServer::$mimeTypeMap[$extension]);
                }// else {
                //    Http::header("Content-Type: application/octet-stream");
                //    Http::header("Content-Disposition: attachment; filename=\"$file_name\"");
                //}
                Http::header("Connection: keep-alive");
                Http::header($modified_time);
                Http::header("Content-Length: $file_size");
                //$trunk_limit_size = 1024*1024;
                //if ($file_size < $trunk_limit_size) {
                echo file_get_contents($file_path);
                //}
            }else{
                Error::HTTP_E(404);
            }
        }
        
    }