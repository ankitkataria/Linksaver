<?php

namespace Blog\Controllers;
use Blog\Models\Link;
session_start();
class HomeController extends BaseController{
    public function get(){
        //echo "testing home controller";
        if(isset($_SESSION['curr_user']))
        {
        	$linksTable=Link::getLinks($_SESSION['curr_user']);
			//echo "table for links: $linksTable";
			$this->render("profile.html",["currUser"=>$_SESSION['curr_user'],'linksTable'=>$linksTable]);
        }
        else
        	$this->render("home.html");
    }
}
