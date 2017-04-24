<!--  
* ## Copyleft by Niklas Linz ##
* This is a detailed explanation
* EnigmarCommunityFramework is licensed under the
* GNU Lesser General Public License v3.0

* Permissions of this copyleft license are conditioned on making available complete 
* source code of licensed works and modifications under the same license or the GNU 
* GPLv3. Copyright and license notices must be preserved. Contributors provide an 
* express grant of patent rights. However, a larger work using the licensed work through 
* interfaces provided by the licensed work may be distributed under different terms and 
* without source code for the larger work.
 -->

<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/ecf/core/class/loginProcess.php';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/ecf/core/api/enigmarAPI.php';
if (isLoggedin ( true )) {
	header ( 'Location: http://' . $_SERVER ['HTTP_HOST'] . '/index.php' );
}
?>

<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8">
<title>Enigmar.de | Restricted Authentication</title>
<meta name="description"
	content="Only for team members. For public visit, use https://public.enigmar.de">
<meta name="author" content="Niklas Linz">
<link rel="icon" href="/content/favicon.ico">
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link href="/ecf/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="/ecf/themes/default/global.css" rel="stylesheet"
	type="text/css">
<link href="/ecf/themes/default/login.css" rel="stylesheet"
	type="text/css">

</head>

<body>
	<div class="container">
		<div id="loginField" class="logo-field">
			<img src="/content/images/enigmar-web-auth.png" alt="Enigmar-logo"
				style="width: 100%;">
			<div id="loginText" class="logo-text">
							<?php
							if ($exitCode == 0) {
								echo '<div class="alert alert-success" role="alert"> <strong>Success: </strong>' . $exitMsg . '</div>';
								$_SESSION ['login'] = true;
							} else {
								if ($exitCode == 1) {
									echo '<div class="alert alert-warning" role="alert"> <strong>Error: </strong>' . $exitMsg . '</div>';
								}
								echo '
									<form method="post" accept-charset="utf-8" autocomplete="off" role="form" class="form-horizontal">
										<input name="f[username]" id="username" type="text" placeholder="Accountname"  value="" tabindex="1" />
										<input name="f[password]" id="password" type="password" placeholder="Passphrase"  value="" tabindex="2" />
										<div class="material-switch pull-right login-remember">
											<input id="rememberMe" name="rememberMe" type="checkbox"/>
											<label for="rememberMe" class="label-primary"></label>
											<b style="color: #5d5d5d;">Remember me?</b>
										</div><br>
										<button type="submit" name="log-me-in" id="submit" tabindex="4" class="btn btn-outline-success">Run Login</button>
										<a href="https://public.enigmar.de" name="public" id="public" tabindex="5" class="btn btn-outline-primary">Or visit Public Access</a>
									</form>';
							}
							?>

				</div>

		</div>
	</div>
</body>
</html>