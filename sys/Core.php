<?php
class Core
{
	private $sys_config;
	private $loader;
	private $uri_segment;
	public function __construct(&$param)
	{
		$this->loader=$param['loader'];
		$this->_get_config();
	}
	
	/**
	*加载设置
	*/
	private function _get_config()
	{
		$load_config=$this->loader->load('LoadConfig');
		$this->sys_config=$load_config->get_config();
	}
	
	/**
	*主要运行方法
	*/
	public function run()
	{
		$uri_obj=$this->loader->load('Uri');
		$this->uri_segment=$uri_obj->get_uri_segment();
		$router_obj=$this->loader->load('Router','sys',$this->uri_segment);
		$router=$router_obj->get_router();
		
		require_once(SYSPATH.'Controller.php');
		$cpath=C_PATH.$router['directory'].$router['class'].'.php';
		if(file_exists($cpath))
		{
			$this->loader->load('LoadLib');			
			$this->loader->load('Model');
			$this->loader->load('View');
			$this->loader->load('OutPut');
			
			require_once(C_PATH.$router['directory'].$router['class'].'.php');
			$class=$router['class'];
			$controller=new $class();
			
			foreach ($this->loader->inited_classes as $var => $one_class)
			{
				$controller->$var =$one_class;
			}
			
			call_user_func_array(array($controller,$router['method']), $router['param']);

		}			
	}
}