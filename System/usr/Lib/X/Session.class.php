<?php
    
    namespace X;
    
    use Workerman\Protocols\Http;
    
    class Session{
        public function start(){
            return Http::sessionStart();
        }
    }