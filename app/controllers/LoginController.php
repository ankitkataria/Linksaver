<?php
	namespace Blog\Controllers;
	use Blog\Models\Post;
	use Blog\Models\Link;
	session_start();

	class LoginController extends BaseController{
		public function post()
		{

			$user_login=$_POST['user_login'];
			$pass_login=$_POST['pass_login'];
			/*if(Post::loginUser($user_login,$pass_login))
			{
				$this->render("error.html",[$errMsg=>'Login Successful']);
			}*/

			if(Post::loginUser($user_login,$pass_login))
			{
				$_SESSION['curr_user']=$user_login;
				//echo $_SESSION['curr_user'];
				$linksTable=Link::getLinks($_SESSION['curr_user']);
				//echo "table for links: $linksTable";
				$this->render("profile.html",["currUser"=>$user_login,'linksTable'=>$linksTable]);
			}
			else
			{
				$this->render("error.html",['errMsg'=>"The username or password don't exist or have been entered wrongly."]);
			}
		}
		/*
		public function get()
		{
			echo "Yo in Login Controller";
		}*/
	}



?>