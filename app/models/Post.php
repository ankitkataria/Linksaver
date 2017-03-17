<?

namespace Blog\Models;

class Post{
	public static function DB(){
		return new \PDO("mysql:dbname=blog;host:localhost","root","toor");
	}
}