<?php 
/**
 * 日志类
 */

class Log {
	const LOGFILE = 'curr.log';
	public static function write($content){
		$content .= "\r\n";
		$log = self::isBak(); //计算路径
		$fp = fopen($log,'ab');
		fwrite($fp, $content);
		fclose($fp);
	}
	public static function isBak(){
		$log = ROOT .'data/log/'. self::LOGFILE;
		if(!file_exists($log)){
			touch($log);
			return $log;
		}
		//清除缓存 判断大小
		 clearstatcache(true,$log);
		 $size = filesize($log);
		 if($size <= 1024*1024){
		 	return $log;
		 } 
		 //大于1M
		 if(!self::bak()){
		 	return $log;
		 }else{
		 	touch($log);
		 	return $log;
		 }
	}
	public static function Bak(){
		$log = ROOT .'data/log/'. self::LOGFILE;
		$bak = ROOT .'data/log/'. date('Y-m-d').mt_rand(10000,99999).'bak';
		return rename($log,$bak);
	}
}
