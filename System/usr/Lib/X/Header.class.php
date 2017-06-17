<?php
    
    namespace X;
    
    use Workerman\Protocols\Http;
    use Workerman\Protocols\HttpCache;
    
    class Header{
        static function code($code,$stxt=""){
            if(!$stxt){
                $stxt = self::getStatusByCode($code);
            }
            Http::header("HTTP/1.1 $code $stxt");
            Http::header("Status: $code $stxt");
        }
        static function mime($mime){
            Http::header("Content-type: $mime");
        }
        static function jump($uri){
            self::code("302");
            Http::header("location: $uri");
        }
        static function down($fileName){
            Http::mime("application/force-download");
            header("Content-Disposition: attachment; filename=".$fileName);
        }
        static function getStatusByCode($code){
            return HttpCache::$codes[$code];
        }
        static function set($set){
            return Http::header($set);
        }
    }