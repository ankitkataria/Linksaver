<?php 
namespace Blog\Models;

class Link{
	public static function DB(){
		return new \PDO("mysql:dbname=linksaver;host=localhost","root","toor");
	}
	public static function insertLink($user,$link,$link_des)
	{
		$db=self::DB();
		$q="insert into links values(:username,:link,:description)";
		if(empty($user)||empty($link)||empty($link_des))
			$msg="No fields can be left empty";
		else if (!filter_var($link, FILTER_VALIDATE_URL)){
			$msg="Invalid URL";
		}
		else{
			$stmt=$db->prepare($q);
			$res=$stmt->execute(['username'=>$user,'link'=>$link,'description'=>$link_des]);
			if($res)
				$msg="done";
			else
				$msg="Some Error Occured. Try Again";

			
		}
		return $msg;
	}
	public static function getLinks($user){
		$db=self::DB();
		$stmt=$db->prepare("select * from links where username=:username");
		$stmt->execute(['username'=>$user]);
		$result=$stmt->fetchAll();
		$linksTable="<tr><th>Links</th><th>Description</th></tr>";
		if(empty($result))
			return "No Links Saved Yet";
		else{
			
			foreach($result as $row)
			{
				$linksTable=$linksTable."<tr><td>".$row['link']."</td><td>".$row['description']."</td><td><form><button type='submit' formmethod='post' formaction='/delLink' name='link_name' value=".$row['link'].">&times;</button></form></td></tr>";
	
			}
			return $linksTable;
		}

	}
	public function delLink($user,$link)
	{
		$db=self::DB();
		$msg="";
		$q="delete from links where username=:user and link=:link";
		$stmt=$db->prepare($q);
		$res=$stmt->execute(['user'=>$user,'link'=>$link]);
		if(!$res)
			$msg="error";
		return $msg;
	}
}

