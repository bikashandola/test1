<?php 
echo $this->Html->script('jquery-1.10.2.min');
	switch($step){
		case 1:
			step_1();
		case 2:
			step_2();
		case 3:
			step_3();
		case 4:
			step_4($sub_folder_name);
		case 5:
			step_5($host, $port, $email, $pwd);
		case 6:
			step_6();
		default:
			//step_1();
	}
function step_1(){ 
	ob_clean();flush();
	$html = '';
	$version = phpversion();
	$error = 0;
if($version >= 5.3){ 
		$html .='<tr>
		<td align="center" style="padding-top:0px">
			<img src="'.HTTP_ROOT.'img/yes1.png"/>
		</td>
		<td align="center">
			<h4><span style="font-weight:normal;">PHP Version: '.$version.'</span></h4>
		</td>
		</tr>';
}else{
	$error = 1;
	$html .='<tr>
		<td align="center" style="padding-top:0px">
			<img src="'.HTTP_ROOT.'img/cross.png"/>
			<input id="error" type="hidden" value="1"/>
		</td>
		<td align="center">
			<h4><span style="font-weight:normal;">PHP Version: '.$version.'<br />Higher version(5.3) required.</span></h4>
		</td>
	</tr>';
 }
if(_isCurl()){
$html .='<tr>
		<td align="center" style="padding-top:0px">
			<img src="'.HTTP_ROOT.'img/yes1.png"/>
		</td>
		<td align="center">
			<h4><span style="font-weight:normal;">Curl enabled.</span></h4>
		</td>
		</tr>';
} else {
$error = 1;
$html .='<tr>
	<td align="center" style="padding-top:0px">
			<img src="'.HTTP_ROOT.'img/cross.png"/>
			<input id="error" type="hidden" value="1"/>
	</td>
	<td align="center">
		<h4><span style="font-weight:normal;">Please Enable curl extension in php.ini file.</span></h4>
	</td>
</tr>';
}
$size = ini_get('upload_max_filesize');
$last = substr($size, -1);
$others = substr($size, 0, -1);
if($last == 'G'){
	$size = $others * 1024;
}else{
	$size = $others * 1;
}
if($size < 200){
	$error = 1;
	$html .='<tr>
	<td align="center" style="padding-top:0px">
			<img src="'.HTTP_ROOT.'img/cross.png"/>
			<input id="error" type="hidden" value="1"/>
	</td>
	<td align="center">
		<h4><span style="font-weight:normal;">Please set upload_max_filesize 200MB in php.ini file.</span></h4>
	</td>
	</tr>';
}else {
$html .='<tr>
	<td align="center" style="padding-top:0px">
		<img src="'.HTTP_ROOT.'img/yes1.png"/>
	</td>
	<td align="center">
		<h4><span style="font-weight:normal;">upload_max_filesize is OK.</span></h4>
	</td>
	</tr>';
}
echo $html;exit;
}
function step_2(){
//global $conn;
//ob_clean();flush();
$config= new DATABASE_CONFIG();

$name = 'default';
$settings = $config->{$name};

$host = $config->default['host'];
$login = $config->default['login'];
$password = $config->default['password'];
$database = $config->default['database'];
$mysqli = new mysqli($host, $login, $password);
$html = '';
$a = mysql_get_server_info();
$c = $mysqli->server_info;
$b = floatval($c);
	if($b >= 4.1){
		$html .='<tr><td align="center" style="padding-top:0px"><img src="'.HTTP_ROOT.'img/yes1.png"/></td><td align="center"><h4><span style="font-weight:normal;">MySQL version: '.$c.'</span></h4></td></tr>';
	}else{
		$error = 1;
		$html .='<tr><td align="center" style="padding-top:0px"><img src="'.HTTP_ROOT.'img/cross.png"/><input id="error" type="hidden" value="1"/></td><td align="center"><h4><span style="font-weight:normal;">MySQL version: '.$c.' (Higher(4.1) Required).</span></h4></td></tr>';
	}
echo $html; exit;
}

function step_3(){
ob_clean();flush();
$html = '';
$config= new DATABASE_CONFIG();
$name = 'default';
$settings = $config->{$name};
$host = $config->default['host'];
$login = $config->default['login'];
$password = $config->default['password'];
$database = $config->default['database'];
$conn=mysqli_connect($host, $login, $password, $database);
if($conn){
	$html .='<tr>
	<td align="center" style="padding-top:0px">
		<img src="'.HTTP_ROOT.'img/yes1.png"/>
	</td>
	<td align="center">
		<h4><span style="font-weight:normal;">Database has created.</span></h4>
	</td></tr>';

	$sql = "show tables from " .$database;
	$x = mysqli_query($conn, $sql);
	if(mysqli_num_rows($x) > 0){ 
		$html .='<tr>
	<td align="center" style="padding-top:0px">
			<img src="'.HTTP_ROOT.'img/yes1.png"/>
		</td>
		<td align="center">
			<h4><span style="font-weight:normal;">Database has imported Properly.</span></h4>
		</td></tr>';
} else { 
	$error = 1;
		$html .='<tr>
	<td align="center" style="padding-top:0px">
			<img src="'.HTTP_ROOT.'img/cross.png"/>
			<input id="error" type="hidden" value="1"/>
		</td>
		<td align="center">
			<h4><span style="font-weight:normal;">Database has not imported. Please Import the "database.sql" file to your database.</span></h4>
		</td></tr>';
}
} else {
	$error = 1;
	$html .='<tr>
	<td align="center" style="padding-top:0px">
		<img src="'.HTTP_ROOT.'img/cross.png"/>
		<input id="error" type="hidden" value="1"/>
	</td>
	<td align="center">
		<h4><span style="font-weight:normal;">Database has not created.Please follow the installation manual to create a database.</span></h4>
	</td></tr>';
}
echo $html; exit;
}
function step_4($sub_folder_name){
ob_clean();flush();
	//print_r($_POST);exit;
	if($sub_folder_name != ''){
	chmod(APP_ROOT.'config/constants.php', 777);
	chmod(APP_ROOT.'config/constants_tmp.php', 777);
		$reading = fopen(APP_ROOT.'config/constants.php', 'r');
		$writing = fopen(APP_ROOT.'config/constants_tmp.php', 'w');
		while (!feof($reading)) {
		  $line = fgets($reading);
		  if (stristr($line,"define('SUB_FOLDER', '")) {
			$line = "define('SUB_FOLDER', '".$sub_folder_name."/');". PHP_EOL;
		  }
		  fputs($writing, $line);
		}
		fclose($reading); fclose($writing);
		unlink(APP_ROOT.'config/constants.php');
		rename(APP_ROOT.'config/constants_tmp.php', APP_ROOT.'config/constants.php');
		$html = '';
		$html .='<tr>
	<td align="center" style="padding-top:0px">
		<img src="'.HTTP_ROOT.'img/yes1.png"/>
	</td>
	<td align="center">
		<h4><span style="font-weight:normal;">Sub folder is set successfully.</span></h4>
	</td></tr>';
	echo $html;exit;
	}
}
function step_5($host, $port, $email, $pwd){
	//echo '<pre>';
	//echo dirname(__FILE__);exit;
if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}
if (!defined('WEBROOT_DIR')) {
	define('WEBROOT_DIR', basename(dirname(__FILE__)));
}
if (!defined('WWW_ROOT')) {
	define('WWW_ROOT', dirname(__FILE__) . DS);
}
//print WEBROOT_DIR. "---".WWW_ROOT;exit;
if(strpos($_SERVER['REQUEST_URI'],DS)>-1){
	$params = explode(DS,$_SERVER['REQUEST_URI']);
}else{
	$params = explode((DS=='/'?'\\':"/"),$_SERVER['REQUEST_URI']);
}
$nreq = implode('/',$params);
$root = "http://".$_SERVER['HTTP_HOST'].substr($nreq,0,strpos($nreq,'app/webroot'));
#echo $root;exit;
$dir = WWW_ROOT;//print $dir;exit;
//$dir = explode(DS, $dir);
//$path = $_SERVER['DOCUMENT_ROOT'];
//$path = $path.DS.$dir[1].DS.$dir[2].DS;
//
//echo DIRECTORY_SEPARATOR;exit;
$path = substr($dir, 0,strpos($dir,'app'.DS.'webroot'));//print $path.'app'.DS;exit;
define('PATH', $path.'app'.DS);
define("Config_Path", PATH.'Config/');
		$reading = fopen(Config_Path.'constants.php', 'r');
		//print_r($reading);exit;
		$writing = fopen(Config_Path.'constants_tmp.php', 'w');

		$replaced = false;
		while (!feof($reading)) {
		  $line = fgets($reading);
		  if (stristr($line,"define('SMTP_HOST', '")) {
			$line = "define('SMTP_HOST', '".$host."');". PHP_EOL;
		  }
		  if (stristr($line,"define('SMTP_PORT', '")) {
			$line = "define('SMTP_PORT', '".$port."');". PHP_EOL;
		  }
		  if (stristr($line, "define('SMTP_UNAME', '")) {
			$line = "define('SMTP_UNAME', '".$email."');". PHP_EOL;
		  }
		  if (stristr($line, "define('SMTP_PWORD', '")) {
			$line = "define('SMTP_PWORD', '".$pwd."');". PHP_EOL;
		  }
		  fputs($writing, $line);
		}
		fclose($reading); fclose($writing);
		// might as well not overwrite the file if we didn't replace anything
		$html = '';
		if(unlink(Config_Path.'constants.php')){
			if(copy(Config_Path.'constants_tmp.php', Config_Path.'constants.php')){
				$html .='<tr><td align="center" style="padding-top:0px"><img src="'.HTTP_ROOT.'img/yes1.png"/></td><td align="center"><h4><span style="font-weight:normal;">SMTP configuration is successfully completed.</span></h4></td></tr>';
			}
		}
		echo $html; exit;
}
function step_6(){
	$html = '';
	if((is_writable(APP_ROOT."tmp")) && (is_writable(APP_ROOT."webroot"))){
		$html .='<tr>
			<td align="center" style="padding-top:0px">
				<img src="'.HTTP_ROOT.'img/yes1.png"/>
			</td>
			<td align="left" style="padding-top:0px">
				<h4><span style="font-weight:normal;">"app/tmp" and "app/webroot" has write permission(777).</span></h4>
			</td>
		</tr>';
	}else{
		//chmod(HTTP_ROOT."app/tmp", 0777);
		//chmod(HTTP_ROOT."app/webroot", 0777);
		$error = 1;
		$html .='<tr>
			<td align="center" style="padding-top:0px">
				<img src="'.HTTP_ROOT.'img/cross.png"/>
				<input id="error" type="hidden" value="1"/>
			</td>
			<td align="left" style="padding-top:0px">
				<h4><span style="font-weight:normal;">Please execute 777 permission to "app/tmp" and "app/webroot" folders.</span></h4>
			</td>
		</tr>';
	}
	echo $html; exit;
}
function _isCurl(){
    return function_exists('curl_version');
}
?>