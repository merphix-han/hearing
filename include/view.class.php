<?php 
/**
 * 根据访问文件名
 * 自动加载view文件
 * 
 */
$view = substr(basename($_SERVER['PHP_SELF']),0,-4);
if(is_file(ROOT . 'view/' . $view .'.html')){
	include(ROOT . 'view/' . $view .'.html');
}
else{
	echo "模板不存在";
}
