<?php
class Router
{
	private $uri_segment;
	private $router;
	private $directory;
	private $class;
	private $method;
	private $param;
	public function __construct($uri_seg_arr=array())
	{
		$this->uri_segment=array();
		if(is_array($uri_seg_arr))
			$this->uri_segment=$uri_seg_arr;
		$this->class=null;
		$this->method=null;
		$this->param=array();
		$this->directory="";
		
		$this->_get_router();
	}
	
	public function get_router()
	{
		return array('directory'=>$this->directory,'class'=>$this->class,'method'=>$this->method,'param'=>$this->param);
	}
	
	private function _get_router()
	{
		$this->_get_directory();
		$this->_get_class_method_param();
	}
	
	
	private function _get_directory()
	{
		if(count($this->uri_segment)===0)
		{
			$this->directory='';
			return ;
		}
		foreach($this->uri_segment as $seg)
		{			
			if(!file_exists(ucfirst($seg).'.php') && is_dir(C_PATH.$this->directory.$seg))
			{
				$this->directory.=$seg.'/';
			}
			else
			{
				break;
			}
		}
	}
	
	public function _get_class_method_param()
	{

		if(count($this->uri_segment)===0)
		{
			$this->class='Home';
			$this->method='index';
			return ;
		}
		
		$segment_str=implode($this->uri_segment,'/');
		if($this->directory==='')
		{
			$new_segments=$this->uri_segment;
		}
		else
		{
			$new_segments=explode('/',substr($segment_str,strlen($this->directory),strlen($segment_str)-strlen($this->directory)));
		}
		
		$segment_count=count($new_segments);
		if($segment_count>=1)
		{
			$class_file_name=C_PATH.$this->directory.$new_segments[0].'.php';
			if(file_exists($class_file_name))
			{
				$this->class=$new_segments[0];
			}
			else
			{
				echo $new_segments[0].' Class file not found.';exit();
			}
			
		}
		else
		{
			echo 'No Class defined.';exit();
		}
		
		if($segment_count>=2)
		{
			$this->method=$new_segments[1];
		}
		
		if($segment_count>=3)
		{
			unset($new_segments[0],$new_segments[1]);
			$this->param=$new_segments;
		}
	}
	
	
/*
		if(count($this->uri_segment)===0)
		{
			$this->directory='';
			$this->class='Home';
			$this->method='index';
			return ;
		}
		$segments=$this->uri_segment;
		$segments_count = count($this->uri_segment);
		
		$directory_end_flag=false;
		
		for ($i=0;$i<$segments_count;$i++)
		{
			
			$this_seg=ucfirst($segments[$i]);
			if(!file_exists(C_PATH.$this_seg.'.php') && is_dir(C_PATH.$this->directory.$this_seg) && !$directory_end_flag)
			{
				$this->_add_directory($segments[$i]);
			}
			else if(file_exists(C_PATH.$this->directory.$this_seg.'.php'))
			{
				$directory_end_flag=true;
				if($this->class==null)
					$this->class=$this_seg;
			}
			else
			{
				if($this->method==null && $this->class!=null)
					$this->method=$segments[$i];
			}
		}
		
		if($this->class==null)
		{
			$this->class='Home';
		}
		if($this->method==null)
		{
			$this->method='index';
		}
		
		return ;

	}*/

	
	
}