<?php
class Model
{
	private $model_path;
	
	public function __construct()
	{
		$this->model_path=APPPATH.'models/';
	}
	
	public function load($class_name)
	{
		$class_name=ucfirst($class_name);
		$class_path=$this->model_path.$class_name.'.php';
		if(!file_exists($class_path))
		{
			echo 'Model '.$class_path.' not founed.';exit();
		}
		require_once($class_path);
		$lib=new $class_name();
		return $lib;
	}
}