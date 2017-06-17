<?php
    /**
     * XSite Project
     * 
     * Author: xtl(xtl@xtlsoft.top)
     * 
     */
    
    namespace X\Base;
    
    use X\Error;
    use X\View;
    
    class Controller{
        protected $Data = array();
        protected function View($ViewName){
            if($_GET['inajax'] == "yes"){
                echo json_encode($this->Data);
            }else{
                $tpl = new View($ViewName);
                $tpl->bindVars($this->Data);
                $tpl->show();
                return $tpl;
            }
        }
    }