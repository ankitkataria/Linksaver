<?php
namespace Blog\Controllers;

use Blog\Models\Post;
//require_once __DIR__."/../models/Post.php";

class RegisterController extends BaseController{
	public function post()
	{
		$user=$_POST['user'];
		$pass=$_POST['pass'];
		$pass_check=$_POST['pass_check'];
		//$btn=$_POST['btn'];
		//echo $btn;
		
		$msg=Post::createUser($user,$pass,$pass_check);
		$this->render("error.html",['errMsg'=>$msg]);
		

	}
	public function get()
	{
		echo 'yo';
	}

}
?>