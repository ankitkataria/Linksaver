<?php
namespace Blog\Controllers;
use Blog\Models\Link;
session_start();
class AddLinkController extends BaseController{
	public function post(){
		$link=$_POST['link'];
		$link_des=$_POST['link_des'];
		$user=$_SESSION['curr_user'];
		$msg=Link::insertLink($user,$link,$link_des);
		$this->render("error.html",['errMsg'=>$msg]);
	}
}
?>