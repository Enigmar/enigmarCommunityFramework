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
$page = $_GET ["p"];
if (! isset ( $page )) {
	$page = "dashboard";
}

if (! is_file ( $_SERVER ['DOCUMENT_ROOT'] . '/views/public/' . $page . '.php' )) {
	$page = '404';
}

$theme = "blue";

$globalCSS = "/ecf/themes/default/global.css";
$bodyCSS = "/ecf/themes/default/body.css";

if (is_file ( $_SERVER ['DOCUMENT_ROOT'] . '/ecf/themes/' . $theme . '/global.css' )) {
	$globalCSS = '/ecf/themes/' . $theme . '/global.css';
}

if (is_file ( $_SERVER ['DOCUMENT_ROOT'] . '/ecf/themes/' . $theme . '/body.css' )) {
	$bodyCSS = '/ecf/themes/' . $theme . '/body.css';
}
$background = "default";
$backgroundClass = "";
if ($background == "default") {
	$background = "/ecf/themes/" . $theme . "/img/background.jpg";
	$isDefaultBG = true;
} else {
	$backgroundClass = "body-background";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="../content/favicon.ico">
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo "Enigmar.de Public | " . ucfirst($page); ?></title>

<link href="/ecf/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo $globalCSS; ?>" rel="stylesheet" type="text/css">
<link href="<?php echo $bodyCSS; ?>" rel="stylesheet" type="text/css">
<script>window.jQuery || document.write('<script src="/ecf/js/jquery.min.js"><\/script>')</script>
<script src="/ecf/js/bootstrap.min.js"></script>



</head>

<body class="<?php echo $backgroundClass; ?>" style="background-image: url(<?php echo $background; ?>);">
	<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
		<button class="navbar-toggler navbar-toggler-right" type="button"
			data-toggle="collapse" data-target="#navbarNavDropdown"
			aria-controls="navbarNavDropdown" aria-expanded="false"
			aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<a class="navbar-brand" href="./index.php"> <img
			src="../content/images/enigmar-logo.svg" width="30" height="30"
			class="d-inline-block align-top" alt=""> Enigmar Public
		</a>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active"><a class="nav-link" href="/public/">Dashboard
						<span class="sr-only">(current)</span>
				</a></li>
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
					href="" id="navbarDropdownMenuLink" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false"> Bukkit / Spigot </a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="#">Cubit</a>
					</div></li>
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
					href="" id="navbarDropdownMenuLink" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false"> Bungeecord </a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="#">noItem</a>
					</div></li>
				<li class="nav-item"><a class="nav-link"
					href="https://jenkins.enigmar.de">Buildserver</a></li>
				<li class="nav-item"><a class="nav-link"
					href="https://github.com/LinzN">Source Repository</a></li>
				<li class="nav-item"><a class="nav-link"
					href="https://metrics.enigmar.de">Metrics</a></li>
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
					href="" id="navbarDropdownMenuLink" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false"> More </a>
					<div class="dropdown-menu dropdown-menu-right"
						aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="#">About us</a> <a
							class="dropdown-item" href="/index.php">Restrict Area</a>
					</div></li>
			</ul>
		</div>
	</nav>

	<div class="container container-main">
		<div class="jumbotron">
		<?php include_once ($_SERVER ['DOCUMENT_ROOT'] . '/views/public/'.$page.'.php')?>
      </div>
	</div>

	<footer class="footer">
		<div class="container">
			<span class="text-muted">Powered by <a href="https://www.enigmar.de">Enigmar
					Systems</a></span>
		</div>
	</footer>
</body>

</html>