<?php 
/**
 * 配置文件类
 * 
 */
define('ROOT',str_replace('\\','/',dirname(dirname(__FILE__))).'/');
class Conf{
	protected static $ins = null;
    protected $data = array();
	final protected function __construct(){
		require(ROOT."include/config.php");
		$this->data = $_CFG;
	}
	final public function __clone(){

	}
	public static function getIns(){
		if(self::$ins instanceof self){
			return self::$ins;
		}else{
			self::$ins = new self();
			return self::$ins;
		}
	}
	public function __get($key){
		if(array_key_exists($key,$this->data)){
			return $this->data[$key];
		}else{
			return false;
		}
	}
	public function __set($key,$value){
		$this->data[$key] = $value; 
	}

}
