<?php
namespace Blog\Controllers;
use Blog\Models\Link;
session_start();
class DelLinkController extends BaseController{
	public function post(){
		$link=$_POST['link_name'];
		$user=$_SESSION['curr_user'];
		$res=Link::delLink($user,$link);
		if(!empty($res))
		{
			$this->render("error.html",['errMsg'=>"Some error occurred While Deleting"]);
		}
		else 
			header ("Location:/home");
		//$this->render("error.html",['errMsg'=>$link_num]);

	}
}

