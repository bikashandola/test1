<?php
/*********************************************************************************
 * Orangescrum Community Edition is a web based Project Management software developed by
 * Orangescrum. Copyright (C) 2013-2014
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact Orangescrum, 2059 Camden Ave. #118, San Jose, CA - 95124, US. 
   or at email address support@orangescrum.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * Orangescrum" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by Orangescrum".
 ********************************************************************************/
#ob_clean();
#echo('<pre>'.print_r($ini_array,true).'</pre>');exit;
/*$data = Array(
	'SMTP_HOST' => "ssl://smtp.gmail.com",
	"SMTP_PORT" => 4658,
	"SMTP_UNAME" => "acharya.satyajeetabc@gmail.com",
	"SMTP_PWORD "=> "test12345");
write_php_ini($data, "config.ini");
$ini_array1 = parse_ini_file("config.ini");
print_r($ini_array1);
function write_php_ini($array, $file)
{
    $res = array();
    foreach($array as $key => $val)
    {
        if(is_array($val))
        {
            $res[] = "[$key]";
            foreach($val as $skey => $sval) $res[] = "$skey = ".(is_numeric($sval) ? $sval : '"'.$sval.'"');
        }
        else $res[] = "$key = ".(is_numeric($val) ? $val : '"'.$val.'"');
    }
    safefilerewrite($file, implode("\r\n", $res));
}

function safefilerewrite($fileName, $dataToSave)
{    if ($fp = fopen($fileName, 'w'))
    {
        $startTime = microtime(TRUE);
        do
        {            $canWrite = flock($fp, LOCK_EX);
           // If lock not obtained sleep for 0 - 100 milliseconds, to avoid collision and CPU load
           if(!$canWrite) usleep(round(rand(0, 100)*1000));
        } while ((!$canWrite)and((microtime(TRUE)-$startTime) < 5));

        //file was locked so now we can store information
        if ($canWrite)
        {            fwrite($fp, $dataToSave);
            flock($fp, LOCK_UN);
        }
        fclose($fp);
    }

}
ini_set('display_errors',0);*/
include("database.php");
$config= new DATABASE_CONFIG();

$name = 'default';
$settings = $config->{$name};

/*$host = $config->default['host'];
$login = $config->default['login'];
$password = $config->default['password'];
$database = $config->default['database'];
	
$conn=mysqli_connect($host, $login, $password);
#print_r($conn); exit;*/
if(trim($settings['database']) == "") {
    ?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta name="robots" content="noindex,nofollow" />
		<link rel="shortcut icon" href="images/favicon_new.ico"/>
		<title>Orangescrum Setup Wizard</title>
		<style>
		*{
			padding:5;
			margin:5;	
			font-family:Tahoma, Verdana;
		}
		.link:hover {
			text-decoration:underline;
		}
		h4 {
			font-size:14px;
		}
		</style>
	</head>
	<body>
		<div id="container">
			<div id="content">
				<table width="100%" align="center"><tr><td align="center">
				<table cellpadding="8" cellspacing="8" style="border:1px solid #999999;color:#000000" align="center" width="520px">
					<tr>
						<td align="center" style="border-bottom:1px solid #999999">
							<h3 style="color:#245271">4 simple steps to get started with Orangescrum</h3>
						</td>
					</tr>
					<tr>
						<td align="left" style="padding-top:10px">
							<h4>Step1: <span style="font-weight:normal;">Create a new MySQL database (`utf8_unicode_ci` collation)</span></h4>
							<h4>Step2: <span style="font-weight:normal;">Add your database connection details and the database name in `app/Config/database.php` page</span></h4>
							<h4>Step3: <span style="font-weight:normal;">Get the `database.sql` file from the root directory and import that to your database.</span></h4>
							<h4>Step4: <span style="font-weight:normal;">Provide the details of SMTP email sending options in `app/Config/constants.php`</span></h4>
						</td>
					</tr>
                    <tr>
						<td align="center">
							<h4 style="color:#FF0000">Make sure that you have write permission (777) to `app/tmp` and `app/webroot` folders</h4>
						</td>
					</tr>
				</table>
				</td></tr></table>
			</div>
		</div>
	</body>
	</html>
	<?php
	exit;
}?> 
<?php /*else{
if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
    $cnd = 1;
} else {
    $cnd = (is_writable(HTTP_ROOT."app/tmp")) && (is_writable(HTTP_ROOT."app/webroot"));
}
if((defined("SUB_FOLDER") || SUB_FOLDER != '') && (defined('SMTP_UNAME') || SMTP_UNAME != '') && (defined('SMTP_PWORD') || SMTP_PWORD != '')){
	header('Location:'.HTTP_ROOT);exit;
}else{
?>
<?php $step = (isset($_GET['step']) && $_GET['step'] != '') ? $_GET['step'] : '';
		switch($step){
			case 1:
				step_1();
			case 2:
				step_2($conn);
			case 3:
				step_3();
			case 4:
				step_4();
			case 5:
				step_5();
			case 6:
				step_6();
			default:
				//step_1();
		} ?>
		<!DOCTYPE html>
	<html>
	<head>
		<meta name="robots" content="noindex,nofollow" />
		<link rel="shortcut icon" href="images/favicon_new.ico"/>
		<title>Orangescrum Setup Wizard</title>
		<style>
		*{
			padding:5;
			margin:5;	
			font-family:Tahoma, Verdana;
		}
		.link:hover {
			text-decoration:underline;
		}
		h4 {
			font-size:14px;
		}
		.email{
			width:300px;
			height:30px;
			border:1px solid #CCC;
			border-radius:5px;
			margin:10px 30px 10px 10px;
			padding-left:15px;
		}
		.verify{
			width:auto;
			height:30px;
			border-radius:15px;
			background-color:#5EBB40;
			color:#fff;
			cursor:pointer;
		}
		.left-sidebar{float:left;}
		.right-content{float:left; margin-left:100px;}
		.sidebar{width: 175px;line-height:25px;}
		.sidebar li{color:#ccc;font-size:14px;}
		.sidebar li.active{color:#000;font-size:14px;}
		.logo_landing{float: left;margin-top: 28px;width: 200px;}
		.community{text-align:center;float:left;margin: 20px 0 0 200px;}
		.community h2{color:#245271}
		.progress-bar{width:100%;height:20px;border:1px solid #ccc; border-radius:0px 10px 10px 0px; margin-top:20px;}
		.progress-bar-inner{height:20px; border-radius:0px 10px 10px 0px;float:left;}
		.progress-bar-txt{float:left;color:#ccc;text-align:center;}
		</style>
	</head>
	<body>
		<div id="container">
			<div id="content">
				<div class="logo_landing">
					<a href="<?php echo HTTP_ROOT; ?>">
						<img border="0" title="Orangescrum.com" alt="Orangescrum.com" src="<?php echo HTTP_ROOT; ?>img/images/logo_outer.png?v=1">
					</a>
				</div>
				<div class="community">
					<h2>Community Edition</h2>
				</div>
				<div style="clear:both;"></div>
				<div class="left-sidebar">
					<ul class="sidebar">
						<li id="conf" class="active">Welcome!</li>
						<li id="conf_1">PHP Configuration</li>
						<li id="conf_2">MYSQL Configuration</li>
						<li id="conf_3">Database Configuration</li>
						<?php
						if(!defined("SUB_FOLDER") || SUB_FOLDER == ''){
							echo '<li id="conf_4">Sub Folder Configuration</li>';
						} ?>
						<li id="conf_5">Smtp Configuration</li>
						<li id="conf_6">Write Permission Check</li>
					</ul>
				</div>
				<div class="right-content">
					<div id="step_name" class="right-header">
						<h3 style="color:#245271;margin:0px">Welcome!</h3>
						<hr style="background:#ccc;"/>
					</div>
				<table width="100%" align="center">
					<tr>
						<td>
						<table id="form" cellpadding="0" cellspacing="0" style="color:#000000; margin-left:100px;" align="center" width="520px">
							<tr id="sub_folder" style="display:none">
								<td colspan="2" style="padding-top:0px">
									<form method="POST">
										<input type="text" id="sub_text" class="email" name="sub_folder" placeholder="sub folder name"/><span style="color:red;display:none;" id="sub_txt_err">This field can not be left blank.</span>
										<button type="button" class="verify" value="Verify" onclick="sub_folder_ajax();">Submit</button>
									</form>
								</td>
							</tr>
							<tr id="smtp" style="display:none;">
								<td colspan="2" style="padding-top:0px">
									<form method="POST">
										<input id="host" type="text" class="email" name="host" placeholder="ssl://smtp.gmail.com"/><span style="color:red;display:none;" id="smtp_host_err">This field can not be left blank.</span>
										<input id="port" type="text" class="email" name="port" placeholder="465"/><span style="color:red;display:none;" id="smtp_port_err">This field can not be left blank.</span>
										<input id="email" type="email" class="email" name="email" placeholder="youremail@gmail.com"/><span style="color:red;display:none;" id="smtp_email_err">This field can not be left blank.</span>
										<input id="password" type="password" class="email" name="password" /><span style="color:red;display:none;" id="smtp_pwd_err">This field can not be left blank.</span>
										<button type="button" class="verify" value="Verify" onclick="smtp_ajax();">Submit</button>
									</form>
								</td>
							</tr>
						</table>
						<table id="result" cellpadding="0" cellspacing="0" border="1px solid #999999" style="color:#000000; margin-left:100px;" align="center" width="520px">
						</table></td>
					</tr>
				</table>
				<div id="nxt_btn" style="float:right; margin-top:20px;">
					<button type='button' class='verify' value='Verify' onclick='check(1);'>Next </button>
				</div>
			</div>
			<div style="clear:both;"></div>
			</div>
			<div class="progress-bar">
				<div class="progress-bar-inner"></div>
				<span class="progress-bar-txt"></span>
				<div style="clear:both;"></div>
			</div>
		</div>
	</body>
	</html>
	
<?php	} }
function step_1(){ 
	ob_clean();flush();
	$html = '';
if(phpversion() >= 5.3){ 
		$html .='<tr>
		<td align="center" style="padding-top:0px">
			<img src="'.HTTP_ROOT.'img/yes1.png"/>
		</td>
		<td align="center">
			<h4><span style="font-weight:normal;">PHP Version: <?php echo phpversion(); ?></span></h4>
		</td>
		</tr>';
}else{
	$html .='<tr>
		<td align="center" style="padding-top:0px">
			<img src="'.HTTP_ROOT.'img/cross.png"/>
		</td>
		<td align="center">
			<h4><span style="font-weight:normal;">PHP Version: <?php echo phpversion(); ?><br />Higher version(5.3) required.</span></h4>
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
$html .='<tr>
	<td align="center" style="padding-top:0px">
			<img src="'.HTTP_ROOT.'img/cross.png"/>
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
	$html .='<tr>
	<td align="center" style="padding-top:0px">
			<img src="'.HTTP_ROOT.'img/cross.png"/>
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
function step_2($conn){
//global $conn;
//ob_clean();flush();
$html = '';

if($conn){

if(mysql_get_server_info() > 4.1){
	$html .='<tr>
	<td align="center" style="padding-top:0px">
		<img src="'.HTTP_ROOT.'img/yes1.png"/>
	</td>
	<td align="center">
		<h4><span style="font-weight:normal;">MySQL version: '.mysql_get_server_info().'</span></h4>
	</td>
	</tr>';
}else{
	$html .='<tr>
	<td align="center" style="padding-top:0px">
			<img src="'.HTTP_ROOT.'img/cross.png"/>
	</td>
	<td align="center">
		<h4><span style="font-weight:normal;">MySQL version: '.mysql_get_server_info().'. Higher(4.1) Required.</span></h4>
	</td></tr>';
}
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
		<h4><span style="font-weight:normal;">Database is created.</span></h4>
	</td></tr>';

	$sql = "show tables from " .$database;
	$x = mysqli_query($conn, $sql);
	if(mysqli_num_rows($x) > 0){ 
		$html .='<tr>
	<td align="center" style="padding-top:0px">
			<img src="'.HTTP_ROOT.'img/yes1.png"/>
		</td>
		<td align="center">
			<h4><span style="font-weight:normal;">Database is imported Properly.</span></h4>
		</td></tr>';
} else { 
		$html .='<tr>
	<td align="center" style="padding-top:0px">
			<img src="'.HTTP_ROOT.'img/cross.png"/>
		</td>
		<td align="center">
			<h4><span style="font-weight:normal;">Database is not imported. Please Import the "database.sql" file to your database.</span></h4>
		</td></tr>';
}
} else { 
	$html .='<tr>
	<td align="center" style="padding-top:0px">
		<img src="'.HTTP_ROOT.'img/cross.png"/>
	</td>
	<td align="center">
		<h4><span style="font-weight:normal;">Database is not created.Please follow the installation manual to create a database.</span></h4>
	</td></tr>';
}
echo $html; exit;
}
function step_4(){
ob_clean();flush();
	//print_r($_POST);exit;
	if($_POST["sub_name"] != ''){
		$reading = fopen(ROOT.DS.'app'.DS.'config'.DS.'constants.php', 'r');
		$writing = fopen(ROOT.DS.'app'.DS.'config'.DS.'constants_tmp.php', 'w');
		while (!feof($reading)) {
		  $line = fgets($reading);
		  if (stristr($line,"define('SUB_FOLDER', '")) {
			$line = "define('SUB_FOLDER', '".$_POST['sub_name']."/');". PHP_EOL;
		  }
		  fputs($writing, $line);
		}
		fclose($reading); fclose($writing);
		unlink(ROOT.DS.'app'.DS.'config'.DS.'constants.php');
		rename(ROOT.DS.'app'.DS.'config'.DS.'constants_tmp.php', ROOT.DS.'app'.DS.'config'.DS.'constants.php');
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
function step_5(){
	//echo '<pre>';
	//print_r($_POST);exit;
	//echo dirname(__FILE__);exit;
		$reading = fopen(ROOT.DS.'app'.DS.'config'.DS.'constants.php', 'r');
		$writing = fopen(ROOT.DS.'app'.DS.'config'.DS.'constants_tmp.php', 'w');

		$replaced = false;
		while (!feof($reading)) {
		  $line = fgets($reading);
		  if (stristr($line,"define('SMTP_HOST', '")) {
			$line = "define('SMTP_HOST', '".$_POST['host']."');". PHP_EOL;
		  }
		  if (stristr($line,"define('SMTP_PORT', '")) {
			$line = "define('SMTP_PORT', '".$_POST['port']."');". PHP_EOL;
		  }
		  if (stristr($line, "define('SMTP_UNAME', '")) {
			$line = "define('SMTP_UNAME', '".$_POST['email']."');". PHP_EOL;
		  }
		  if (stristr($line, "define('SMTP_PWORD', '")) {
			$line = "define('SMTP_PWORD', '".$_POST['pwd']."');". PHP_EOL;
		  }
		  fputs($writing, $line);
		}
		fclose($reading); fclose($writing);
		// might as well not overwrite the file if we didn't replace anything
		
		unlink(ROOT.DS.'app'.DS.'config'.DS.'constants.php');
		rename(ROOT.DS.'app'.DS.'config'.DS.'constants_tmp.php', ROOT.DS.'app'.DS.'config'.DS.'constants.php');
		$html = '';
		$html .='<tr>
	<td align="center" style="padding-top:0px">
		<img src="'.HTTP_ROOT.'img/yes1.png"/>
	</td>
	<td align="center">
		<h4><span style="font-weight:normal;">SMTP configuration is successfully completed.</span></h4>
	</td></tr>';
	echo $html; exit;
}
function step_6(){
	$html = '';
	if(is_writable(HTTP_ROOT."app/tmp")){
		$html .='<tr>
			<td align="center" style="padding-top:0px">
				<img src="'.HTTP_ROOT.'img/yes1.png"/>
			</td>
			<td align="left" style="padding-top:0px">
				<h4><span style="font-weight:normal;">"app/tmp" and "app/webroot" has write permission(777).</span></h4>
			</td>
		</tr>';
	}else if(is_writable(HTTP_ROOT."app/webroot")){
		$html .= '<tr>
			<td align="center" style="padding-top:0px">
				<img src="'.HTTP_ROOT.'img/yes1.png"/>
			</td>
			<td align="left" style="padding-top:0px">
				<h4><span style="font-weight:normal;">"app/tmp" and "app/webroot" has write permission(777).</span></h4>
			</td>
		</tr>';
	}else{
		$html .='<tr>
			<td align="center" style="padding-top:0px">
				<img src="'.HTTP_ROOT.'img/cross.png"/>
			</td>
			<td align="left" style="padding-top:0px">
				<h4><span style="font-weight:normal;">Make sure that you have write permission (777) to `app/tmp` and `app/webroot` folders.</span></h4>
			</td>
		</tr>';
	}
	echo $html; exit;
}
	

function _isCurl(){
    return function_exists('curl_version');
}
if(defined("SUB_FOLDER") || SUB_FOLDER != ''){ ?>
<script> 
	var folder = '<?php echo SUB_FOLDER; ?>';
</script>
<?php }
?>
<script type="text/javascript" src="<?php echo HTTP_ROOT; ?>js/jquery-1.10.1.min.js"></script>
<script>
$(document).ready(function(){
	/* $.get("install.php?step=1", function(res){
		document.getElementById('result').innerHTML += res;
		$('#conf_1').addClass('active');
		$('#nxt_btn').html("<button type='button' class='verify' value='Verify' onclick='check(2);'>Next </button>");
		$('.progress-bar-inner').css({
			'background':'blue',
			'width':(100/6)+'px'
		});
		var txt = parseInt((100/6));
		$('.progress-bar-txt').html(txt+"% Completed");
	});
}); 
function check(step){
	var cmn_width = 0
	if($('ul li').length == 7){
		cmn_width = 100/6;
	}else{
		cmn_width = 100/5;
	}
	if(step != 4 && step != 5){
		$.get("install.php?step="+step, function(res){
			document.getElementById('result').innerHTML += res;
			$('#conf_'+step).addClass('active');
			if(step == 3 && $('ul li:nth-child(5)').html('Smtp Configuration')){
				$('#nxt_btn').html("<button type='button' class='verify' value='Verify' onclick='check(5);'>Next </button>");
			}else if(step == 6){
				$('#nxt_btn').html("<button type='button' class='verify' value='Verify' onclick='end_check();'>Continue to Orangescrum </button>");
			}else{
				$('#nxt_btn').html("<button type='button' class='verify' value='Verify' onclick='check("+(step+1)+");'>Next </button>");
			}
			$('#step_'+(step-1)).hide();
			if(step != 6){
				$('.progress-bar-inner').css({
					'background':'blue',
					'width':(cmn_width*step)+'%'
				});
				var txt = parseInt(cmn_width*step);
				$('.progress-bar-txt').html(txt+"% Completed");
			}else{
				$('.progress-bar-inner').css({
					'background':'blue',
					'width':'100%'
				});
				$('.progress-bar-txt').html("");
			}
			});
	}else if(step == 4){
		$('#result').hide();
		$('#form').show();
		$('#sub_folder').show();
	}else if(step == 5){
		$('#step_3').hide();
		$('#result').hide();
		$('#form').show();
		$('#smtp').show();
	}
}
function sub_folder_ajax(){
	var cmn_width = 0
	if($('ul li').length == 7){
		cmn_width = 100/6;
	}else{
		cmn_width = 100/5;
	}
	var sub = $('#sub_text').val();
	if(sub == ''){
		$('#sub_txt_err').show();
		return false;
	}else{
		$.post("install.php?step=4", {'sub_name':sub}, function(res){
			document.getElementById('result').innerHTML += res;
			$('#nxt_btn').html("<button type='button' class='verify' value='Verify' onclick='check(5);'>Next </button>");
			$('#conf_4').addClass('active');	
			$('.progress-bar-inner').css({
				'background':'blue',
				'width':(cmn_width*5)+'%'
			});
			var txt = parseInt(cmn_width*5);
			$('.progress-bar-txt').html(txt+"% Completed");			
		});
	}
}

function smtp_ajax(){
	var cmn_width = 0
	if($('ul li').length == 7){
		cmn_width = 100/6;
	}else{
		cmn_width = 100/5;
	}
	var host = $('#host').val();
	var port = $('#port').val();
	var email = $('#email').val();
	var pwd = $('#password').val();
	if(host == ''){
		$('#smtp_host_err').show();
		return false;
	}else if(port == ''){
		$('#smtp_port_err').show();
		return false;
	}else if(email == ''){
		$('#smtp_email_err').show();
		return false;
	}else if(pwd == ''){
		$('#smtp_pwd_err').show();
		return false;
	}else{
		$.post("install.php?step=5", {'host':host, 'port':port, 'email':email, 'pwd':pwd}, function(res){
			$('#conf_5').addClass('active');
			document.getElementById('result').innerHTML += res;
			$('#nxt_btn').html("<button type='button' class='verify' value='Verify' onclick='check(6);'>Next</button>");
			$('#step_4').hide();
			$('#result').show();
			$('#form').hide();
			$('#smtp').hide();
			$('.progress-bar-inner').css({
				'background':'blue',
				'width':(cmn_width*4)+'%'
			});
			var txt = parseInt(cmn_width*4);
			$('.progress-bar-txt').html(txt+"% Completed");
		});
	}
}

function end_check(){
	window.location = '<?php echo HTTP_ROOT; ?>';
}
</script>*/
?>