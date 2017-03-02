<?php
/**
 * @Author:	  merphix
 * @DateTime:	2016-10-31 11:20:46
 * @Description: mysql类
 */
class mysql{
	private static $ins = null;
	private $conn = null;
	private $conf = array();
	public function __construct(){
		$this->conf = Conf::getIns();
		$this->connect($this->conf->db_host,$this->conf->db_user,$this->conf->db_password,$this->conf->db_name);
		$this->setChar($this->conf->char);
	}
	public static function getIns(){
		if(self::$ins instanceof self){
			return self::$ins;
		}else{
			self::$ins = new self();
			return self::$ins;
		}
	}
	public function connect($h,$u,$p,$n){
		$this->conn = new mysqli($h,$u,$p,$n);
		if($this->conn->connect_error) {
            die('连接失败' . $mysqli->connect_error);
        }
	} 
	public function setChar($char = 'utf8'){
		$sql = 'set names '.$char;
		$this->query($sql);

	}
	public function query($sql){

		$rs = $this->conn->query($sql);
		log::write($sql);
		return $rs;
	}
	public function getAll($sql){
		$rs = $this->query($sql);
		while($row = $rs->fetch_assoc()){
			$list[] = $row;
		}
		return $list;
	}
	public function getRow($sql){
		$rs = $this->query($sql);
		return $rs->fetch_assoc();
	}
	public function autoExecute($table,$arr,$mode = 'insert',$where = 'where 1 limit 1'){
		if(!is_array($arr)){
			return false;
		}
		if($mode == 'update'){
			$sql = 'update '.$table.' set ';
			foreach($arr as $k=>$v){
				$sql .= $k.' = "'.$v.'",';
			}
			$sql .= $where;
			return $this->query($sql);
		}
			$sql = 'insert into '.$table . ' ( ' .implode(',',array_keys($arr)) . ' ) ' ;
			$sql .= ' values ("' . implode('","',array_values($arr)) . '" ) '; 
			return $this->query($sql);
		

	}
}