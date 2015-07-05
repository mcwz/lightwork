<?php
class Uri
{
	private $uri_string;
	private $uri_segment;
	public function __construct()
	{
		$this->uri_string="";
		$this->uri_segment=array();
		$this->uri_string=$this->_get_uri_string();
		$this->uri_segment=$this->_get_uri_segment();
	}
	
	public function get_uri_segment()
	{
		return $this->uri_segment;
	}
	
	public function get_uri_string()
	{
		return $this->uri_string;
	}
	
	private function _get_uri_string()
	{
		if ( ! isset($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']))
		{
			return '';
		}
		$uri=parse_url($_SERVER['REQUEST_URI']);
		$script_name=$_SERVER['SCRIPT_NAME'];

		$query = isset($uri['query']) ? $uri['query'] : '';
		$uri = isset($uri['path']) ? $uri['path'] : '';
		
		
		$uri=substr($uri,strlen($script_name)+1);
		
		if (trim($uri, '/') === '' && strncmp($query, '/', 1) === 0)
		{
			$query = explode('?', $query, 2);
			$uri = $query[0];
			$_SERVER['QUERY_STRING'] = isset($query[1]) ? $query[1] : '';
		}
		else
		{
			$_SERVER['QUERY_STRING'] = $query;
		}
		
		parse_str($_SERVER['QUERY_STRING'], $_GET);

		if ($uri === '/' OR $uri === '')
		{
			return '/';
		}
		
		
		
		return $uri;
	}
	
	
	private function _get_uri_segment()
	{
		if ($this->uri_string !== '')
		{
			foreach (explode('/', trim($this->uri_string, '/')) as $val)
			{
				$val = trim($val);
				
				if ($val !== '')
				{
					$segments[] = $val;
				}
			}
			return $segments;
		}
		return array();
	}
}