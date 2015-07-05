<?php
class LoadLib
{
	private $lib_path;
	
	public function __construct()
	{
		$this->lib_path=APPPATH;
	}
	
	public function load($class_name,$path='lib')
	{
		$class_name=ucfirst($class_name);
		$class_path=$this->lib_path.$path.'/'.$class_name.'.php';
		if(!file_exists($class_path))
		{
			echo 'Class '.$class_path.' not founed.';exit();
		}
		require_once($class_path);
		$lib=new $class_name();
		return $lib;
	}
}