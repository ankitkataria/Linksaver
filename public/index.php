<?php
require_once __DIR__."/../vendor/autoload.php";
//echo "on index.php";
ToroHook::add("404",function(){
	echo "404 Error";
	http_response_code(404);
});
Toro::serve(array(
    '/home' => Blog\Controllers\HomeController::class,
    '/register' => Blog\Controllers\RegisterController::class,
    '/login'=> Blog\Controllers\LoginController::class,
));

