<?php

namespace Blog\Controllers;

class HomeController extends BaseController{
    public function get(){
        //echo "testing home controller";
        $this->render("home.html");
    }
}
