<?php
class LoadClass
{
	private $base_path;
	public static $inited_classes=array();
	public function __construct()
	{
		$this->base_path=BASEPATH;
	}
	
	public function load($class_name, $directory = 'sys', $param = NULL)
	{
		//is this class loaded
		$class_name=ucfirst($class_name);
		//static $_inited_classes = array();
		if (isset($this->inited_classes[$class_name]))
		{
			return $this->inited_classes[$class_name];
		}
		
		$class_path=$this->base_path.DIRECTORY_SEPARATOR.$directory.DIRECTORY_SEPARATOR;
		$class_file=$class_path.$class_name.'.php';
		if(!file_exists($class_file))
		{
			echo 'Can\'t find the class which located in '.$class_file;
			exit();
		}
		else
		{
			if (class_exists($class_name, FALSE) === FALSE)
			{
				require_once($class_file);
			}
		}
		
		$this->inited_classes[$class_name] = isset($param)
			? new $class_name($param)
			: new $class_name();
		return $this->inited_classes[$class_name];
	}
}