<?php
class Session{

	public static function init(){
		session_start();
	}
	public static function set($key, $value){
		 $_SESSION[$key]=$value;
	}
	public static function get($key){
		 if(isset($_SESSION[$key])){
		 	return $_SESSION[$key];
		 }else{
		 	return false;
		 }
	}
	public static function checkSession(){
		  self::init();
		  if(self::get("adminLogin")==false){
		  		self::destroy();
		  }
	}
	public static function checkLogin(){
		  self::init();
		  if(self::get("adminLogin")==true){
		  		header("Location: dashboard.php");
		  }
	}
	public static function destroy(){
		   session_destroy();
		   header("Location: login.php");
	}

}
?>