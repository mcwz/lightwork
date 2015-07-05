<?php

//error_reporting(E_ALL);
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);
//date_default_timezone_set('PRC');
define("BASEPATH",dirname(__FILE__).DIRECTORY_SEPARATOR);
define("APPPATH",BASEPATH.'app'.DIRECTORY_SEPARATOR);
define("SYSPATH",BASEPATH.'sys'.DIRECTORY_SEPARATOR);
define("C_PATH",APPPATH.'controllers'.DIRECTORY_SEPARATOR);
define("M_PATH",APPPATH.'models'.DIRECTORY_SEPARATOR);
define("V_PATH",APPPATH.'views'.DIRECTORY_SEPARATOR);

/**
* 加载loadclass类用于整个系统加载类使用
*
*/
if(!file_exists(SYSPATH.'LoadClass.php'))
{
	echo "system core files missed. running stop .(100001)";exit();
}
else
{
	require_once(SYSPATH.'LoadClass.php');
	$loader=new LoadClass();
	//加载核心类，并开始运行
	$core=$loader->load('core','sys',array('loader'=>&$loader));
	$core->run();
}