<?php
	session_start();
	if(session_destroy())
	{
		//echo "destroying the session";
		header ("Location:/home");
	}
?>