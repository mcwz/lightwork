<?php
class LoadConfig
{
	private $config;
	public function __construct()
	{
		if(!file_exists(APPPATH.'config.php'))
		{
			echo "config.php file does not exists.";exit();
		}
		require_once(APPPATH.'config.php');
		if(!isset($config) OR !is_array($config))
		{
			echo 'There must define an array called $config in config.php';exit();
		}
		$this->config=$config;
	}
	public function get_config()
	{
		return $this->config;
	}
}