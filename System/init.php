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
    
    use X\Error;
    use X\APIHandle\Handle;
    use X\Autoloader;
    use X\Route;
    use X\App;
    use XDO\XDO;
    use XDO\Tool as XDOTool;
    
    //Define start time
    $GLOBALS['_startTime'] = microtime();
    
    //Directory Define
    if(!defined("UsrDir")){
        define("UsrDir",SysDir.'usr/');
        define("TemplateDir",UsrDir.'Template/');
        define("PluginDir",UsrDir.'Plugin/');
        define("StaticDir",UsrDir.'Static/');
        define("LibDir",UsrDir.'Lib/');
        define("LangDir",UsrDir.'Lang/');
        define("DatDir",SysDir.'var/');
    }
    
    //Make Sure Installed
    /*
        code...
    */
    
    //Global Vars Define
    $GLOBALS['_G'] = array();
    global $_G;
    $_G['HTTP_HOST'] = explode(":",$_SERVER['HTTP_HOST'])[0];
    $_G['REQUEST_URI'] = explode("?",$_SERVER['REQUEST_URI'])[0];
    
    //Include Autoloader
    require_once LibDir. 'X/Autoloader.class.php';
    
    //Load Error Processor
    Autoloader::load("X/Error");
    
    //Start Session
    @\X\Session::start();
    
    //Load XDO DataDir
    XDO::setDir(DatDir);
    
    //Configure Include
    $GetConfig = XDO::Database("Config")->get("Config");
    $GLOBALS['_C'] = XDO::Database("Config")->getAssoc($GetConfig,"name","value");
    
    //Load Route Config
    foreach(XDOTool::listDir(DatDir.'Config/Route/',0) as $v){
        Route::load(DatDir. 'Config/Route/'. $v);
    }
    
    //Run App
    if(Route::$isLoad){
        App::Run(Route::$Plugin,Route::$Controller,Route::$Action,Route::$var);
    }else{
        Error::HTTP_E(404);
    }
    
    //Include AfterExec
    include(SysDir.'AfterExec.php');