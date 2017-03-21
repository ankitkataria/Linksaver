<?php
namespace Blog\Models;

class Post{
	
	public static function DB(){
		return new \PDO("mysql:dbname=linksaver;host:localhost","root","toor");
	}
	public static function userExists($user)
	{
		//echo $user;
		$db=self::DB();
		$query="select * from users";
		$stmt=$db->prepare($query);
		$stmt->execute();
		//echo var_dump($stmt);
		$result=$stmt->fetchAll();

		foreach($result as $row)
		{
			//echo $row['username'];
			if($row['username']==$user)
				return true;
		}
		return false;
		
		
	}
	public static function createUser($user,$pass,$pass_check)
	{
		
		$db=self::DB();
		//$db=\PDO("mysql:dbname=linksaver;host:localhost","root","toor");
		$query=$db->prepare('INSERT INTO users values (:username,:password)');
		if(empty($user)||empty($pass)||empty($pass_check))
			$msg="None of The fields can be left empty";
		else{		
			if(!self::userExists($user))
			{	
				if($pass==$pass_check)
				{
					$res=$query->execute(['username'=>$user,'password'=>$pass]);
					if(!$res)
					{
						//echo "error";
						$msg="Some Error Occured";
						print_r($query->errorInfo());
					}
					else
					{
						$msg="success";
					}
				}
				else
					$msg="the Passwords do not match";

			}
			else
				$msg="The user Name Already Exists";
		}
		return $msg;
	}
	public static function loginUser($user,$pass)
	{
		if(empty($user)||empty($pass))
			return false;
		$db=self::DB();
		$query="select * from users where username=:user and password=:pass";
		$stmt=$db->prepare($query);
		$stmt->execute(['user'=>$user,'pass'=>$pass]);
		//echo $user.$stmt->rowCount();
		if($stmt->rowCount()==1)
		{
			return true;
		}	
		return false;
		
	}
}