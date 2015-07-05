<?php
class Home
{
	function index()
	{	
		//$test=$this->Model->load('TestModel');
		//$test->test();
		$data['world']='hello world.';
		$html=$this->View->load('home',$data);
		$this->OutPut->display($html);
	}
}