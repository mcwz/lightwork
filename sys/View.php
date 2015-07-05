<?php
class View
{
	private $view_path;
	
	public function __construct()
	{
		$this->view_path=APPPATH.'views/';
	}
	
	public function load($view_name,$data_assign=array())
	{
		$view_name=ucfirst($view_name);
		$view_path=$this->view_path.$view_name.'.php';
		if(!file_exists($view_path))
		{
			echo 'View '.$view_path.' is not founded.';exit();
		}
		
		if (is_array($data_assign))
		{
			extract($data_assign);
		}

		ob_start();
		
		//if (function_usable('eval'))
		//{
			echo eval('?>'.preg_replace('/;*\s*\?>/', '; ?>', str_replace('<?=', '<?php echo ', file_get_contents($view_path))));
		//}
		//else
		//{
			//include($view_path); // include() vs include_once() allows for multiple views with the same name
		//}
		
		$buffer = ob_get_contents();
		@ob_end_clean();
		return $buffer;
	}
}