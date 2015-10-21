<?php
/**
* @copyright Copyright(c) 2011 jooyea.cn
* @file site.php
* @brief
* @author webning
* @date 2011-03-22
* @version 0.6
* @note
*/
/**
* @brief Site
* @class Site
* @note
*/
class site extends IController
{
    public $layout = 'site';

    public function __construct()
    {
        echo 'sdfsdfsadfasdfsssssssssssssss<br><br>';
        echo IWeb::exeTime().'<br><br>';
        exit;
    }

    function init()
    {
        echo '我是方法';
        //CheckRights::checkUserRights();
    }
}
?>