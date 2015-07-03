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
 
include("database.php");
include(ROOT.DS.'app'.DS.'config'.DS."constants.php");
$config= new DATABASE_CONFIG();
$name = 'default';
$settings = $config->{$name};
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
}else{
	if($_POST["host"] != '' && $_POST["port"] != '' && $_POST["email"] != '' && $_POST["password"] != '' ){ 
	//echo dirname(__FILE__);exit;
		$reading = fopen(ROOT.DS.'app'.DS.'config'.DS.'constants.php', 'r');
		$writing = fopen(ROOT.DS.'app'.DS.'config'.DS.'constants_tmp.php', 'w');

		$replaced = false;
		while (!feof($reading)) {
		  $line = fgets($reading);
		  if (stristr($line,'define("SMTP_HOST", "ssl://smtp.gmail.com");')) {
			$line = 'define("SMTP_HOST", "'.$_POST['host'].'");'. PHP_EOL;
		  }
		  if (stristr($line,'define("SMTP_PORT", "465");')) {
			$line = 'define("SMTP_PORT", "'.$_POST['port'].'");'. PHP_EOL;
		  }
		  if (stristr($line,'define("SMTP_UNAME", "youremail@gmail.com");')) {
			$line = 'define("SMTP_UNAME", "'.$_POST['email'].'");'. PHP_EOL;
		  }
		  if (stristr($line,'define("SMTP_PWORD", "******");')) {
			$line = 'define("SMTP_PWORD", "'.$_POST['password'].'");'. PHP_EOL;
		  }
		  fputs($writing, $line);
		}
		fclose($reading); fclose($writing);
		// might as well not overwrite the file if we didn't replace anything
		
		unlink(ROOT.DS.'app'.DS.'config'.DS.'constants.php');
		rename(ROOT.DS.'app'.DS.'config'.DS.'constants_tmp.php', ROOT.DS.'app'.DS.'config'.DS.'constants.php');
		//header('location: ' . $_SERVER['PHP_SELF']);
		header('location: ' . ROOT.DS.'app'.DS.'config');
	}else{
	$host = $config->default['host'];
	$login = $config->default['login'];
	$password = $config->default['password'];
	$database = $config->default['database'];
	$conn=mysqli_connect($host, $login, $password, $database);
	$sql = "show tables from " .$database;
	$x = mysqli_query($conn, $sql);?>
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
			margin-right:30px;
			margin-bottom:10px;
			padding-left:15px;
		}
		.verify{
			width:100px;
			height:30px;
			border-radius:15px;
			background-color:#5EBB40;
			color:#fff;
		}
		.sidebar{
		list-style-type:none;}
		.sidebar li{color:#ccc;font-size:14px;}
		.sidebar li.active{color:#000;font-size:14px;}
		
		</style>
	</head>
	<body>
		<div id="container">
			<div id="content">
				<table width="100%" align="center">
				<tr>
				<td>
					<ul class="sidebar">
						<li class="active">PHP Configuration</li>
						<li>MYSQL Configuration</li>
						<li>Database Configuration</li>
						<li>Sub Folder Configuration</li>
						<li>Smtp Configuration</li>
					</ul>
				</td>
				<td align="center">
				<table cellpadding="8" cellspacing="8" style="border:1px solid #999999;color:#000000" align="center" width="520px">
					<tr>
						<td colspan="2" align="center" style="border-bottom:1px solid #999999">
							<h3 style="color:#245271">Orangescrum Environment Check</h3>
						</td>
					</tr>
	<?php 	if(mysqli_num_rows($x) > 0){ ?>
	<tr>
		<td align="center" style="padding-top:0px">
			<img src="<?php echo HTTP_ROOT; ?>img/yes1.png"/>
		</td>
		<td align="left" style="padding-top:0px">
			<h4><span style="font-weight:normal;">"<b>database.sql</b>" imported properly.</span></h4>
		</td>
	</tr>
	<?php if(SUB_FOLDER != ''){?>
	<tr>
		<td align="center" style="padding-top:0px">
			<img src="<?php echo HTTP_ROOT; ?>img/yes1.png"/>
		</td>
		<td align="left" style="padding-top:0px">
			<h4><span style="font-weight:normal;">Sub folder is set properly.</span></h4>
		</td>
	</tr>
	<?php if(SMTP_UNAME == "youremail@gmail.com" || SMTP_UNAME == "youremail@domain.com" || SMTP_PWORD == "******") {?>
	<tr>
		<td colspan="2" style="padding-top:0px">
			<form action="install.php" method="POST">
				<input type="text" class="email" name="host" placeholder="ssl://smtp.gmail.com"/>
				<input type="text" class="email" name="port" placeholder="465"/>
				<input type="email" class="email" name="email" placeholder="youremail@gmail.com"/>
				<input type="password" class="email" name="password" />
				<input type="submit" class="verify" value="Verify"/>
			</form>
		</td>
	</tr>
	<tr>
		<td align="center" style="padding-top:0px">
			<img src="<?php echo HTTP_ROOT; ?>img/cross.png"/>
		</td>
		<td align="left" style="padding-top:0px">
			<h4><span style="font-weight:normal;">Please provide your email(Gmail/sendgrid/mandrill) credentials to send email.</span></h4>
		</td>
	</tr>	
	<?php }else{ ?>
	<tr>
		<td align="center" style="padding-top:0px">
			<img src="<?php echo HTTP_ROOT; ?>img/yes1.png"/>
		</td>
		<td align="left" style="padding-top:0px">
			<h4><span style="font-weight:normal;">SMTP email sending details provided properly.</span></h4>
		</td>
	</tr>
	<?php if(is_writable(HTTP_ROOT."app/tmp") && is_writable(HTTP_ROOT."app/webroot")){ ?>
	<tr>
		<td align="center" style="padding-top:0px">
			<img src="<?php echo HTTP_ROOT; ?>img/yes1.png"/>
		</td>
		<td align="left" style="padding-top:0px">
			<h4><span style="font-weight:normal;">"app/tmp" and "app/webroot" has write permission(777).</span></h4>
		</td>
	</tr>
	<?php }else{ ?>
	<tr>
		<td align="center" style="padding-top:0px">
			<img src="<?php echo HTTP_ROOT; ?>img/cross.png"/>
		</td>
		<td align="left" style="padding-top:0px">
			<h4><span style="font-weight:normal;">Make sure that you have write permission (777) to `app/tmp` and `app/webroot` folders.</span></h4>
		</td>
	</tr>
	<?php }}
	}else{ ?>
	<tr>
		<td align="center" style="padding-top:0px">
			<img src="<?php echo HTTP_ROOT; ?>img/cross.png"/>
		</td>
		<td align="left" style="padding-top:0px">
			<h4><span style="font-weight:normal;">It seems you have not updated sub folder name. Please move all downloaded file to a folder and update that folder name as sub folder name in constants.php.</span></h4>
		</td>
	</tr>
	<?php }
	}else{ ?>
	<tr>
		<td align="center" style="padding-top:0px">
			<img src="<?php echo HTTP_ROOT; ?>img/cross.png"/>
		</td>
		<td align="left" style="padding-top:0px">
			<h4><span style="font-weight:normal;">Please import "<b>database.sql</b>" to your database.</span></h4>
		</td>
	</tr>
	<?php } ?>
	</tr>
	</table>
	</td></tr></table>
			</div>
		</div>
	</body>
	</html>
	<?php
	}
}
?>