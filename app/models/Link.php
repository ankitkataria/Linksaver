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
		else{
			$stmt=$db->prepare($q);
			$res=$stmt->execute(['username'=>$user,'link'=>$link,'description'=>$link_des]);
			if($res)
				$msg="Successfully inserted Link";
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
				$linksTable=$linksTable."<tr><td>".$row['link']."</td><td>".$row['description']."</td></tr>";
			}
			return $linksTable;
		}

	}
}