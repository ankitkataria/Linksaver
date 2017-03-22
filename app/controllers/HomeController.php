<?php

namespace Blog\Controllers;
session_start();
class HomeController extends BaseController{
    public function get(){
        //echo "testing home controller";
        if(isset($_SESSION['curr_user']))
        	$this->render("profile.html",["currUser"=>$_SESSION['curr_user']]);
        else
        	$this->render("home.html");
    }
}
