<!--  
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
function doLogin($userId, $rememberMe) {
	session_start ();
	$userData = getUserData ( $userId, $rememberMe );
	$_SESSION = array (
			"login",
			"userprofil" => $userData 
	);
	
	if ($userData ["rememberMe"]) {
		$expire = time () + 3600 * 24 * 60;
		
		setcookie ( "rememberMe", base64_encode ( $userData ["id"] ), $expire );
		
		$salt = "gjhg/%4565GUUZTu&772";
		$hash = md5 ( $salt . "|" . $userData ["timestamp"] . "|" . substr ( $userData ["password"], 0, 5 ) . "|" . $userData ["id"] );
		
		setcookie ( "rememberMeToken", $hash, $expire );
	}
}
function checkLogin($requireLogin) {
	session_start ();
	include_once $_SERVER ['DOCUMENT_ROOT'] . '/ecf/core/class/loginProcess.php';
	if (! isLoggedin ( false )) {
		if (! doAutoLogin ()) {
			if ($requireLogin) {
				header ( 'Location: http://' . $_SERVER ['HTTP_HOST'] . '/login.php' );
				exit ();
			}
		}
	}
}
function isLoggedin($newSession) {
	if ($newSession) {
		session_start ();
	}
	if (isset ( $_SESSION ['login'] )) {
		return true;
	} else {
		return false;
	}
}
function doAutoLogin() {
	$userId = base64_decode ( $_COOKIE ["rememberMe"] );
	
	$userData = getUserData ( $userId, false );
	$salt = "gjhg/%4565GUUZTu&772";
	$hash = md5 ( $salt . "|" . $userData ["timestamp"] . "|" . substr ( $userData ["password"], 0, 5 ) . "|" . $userData ["id"] );
	
	if ($hash == $_COOKIE ["rememberMeToken"]) {
		
		$_SESSION = array (
				"login" => true,
				"userprofil" => $userData 
		);
		return true;
	}
	return false;
}
function getUserData($userId, $rememberMe) {
	include $_SERVER ['DOCUMENT_ROOT'] . '/inc/settings.php';
	$data = array (
			"id",
			"timestamp",
			"username",
			"password",
			"background",
			"theme",
			"rememberMe" 
	);
	$mysqlCon = @new mysqli ( $hostname, $user, $password, $database );
	if ($mysqlCon->connect_error) {
	} else {
		$queryCon = sprintf ( "SELECT * FROM users WHERE id = '%s'", $mysqlCon->real_escape_string ( $userId ) );
		$result = $mysqlCon->query ( $queryCon );
		if ($row = $result->fetch_array ( MYSQLI_ASSOC )) {
			$data ["id"] = $row ["id"];
			$data ["timestamp"] = $row ["timestamp"];
			$data ["username"] = $row ["username"];
			$data ["password"] = $row ["password"];
			$data ["background"] = $row ["background"];
			$data ["theme"] = $row ["theme"];
			$data ["rememberMe"] = $rememberMe;
		}
		$mysqlCon->close ();
	}
	return $data;
}
?>