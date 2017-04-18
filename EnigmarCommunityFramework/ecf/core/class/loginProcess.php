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
include $_SERVER ['DOCUMENT_ROOT'] . '/inc/settings.php';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/ecf/core/api/enigmarAPI.php';
$exitCode = - 1;
$exitMsg = "";

if (! empty ( $_POST )) {
	if (empty ( $_POST ['f'] ['username'] ) || empty ( $_POST ['f'] ['password'] )) {
		$exitCode = 1;
		$exitMsg = "Not all fields are valid!";
	} else {
		$mysqli = @new mysqli ( $hostname, $user, $password, $database );
		if ($mysqli->connect_error) {
			$exitCode = 1;
			$exitMsg = "Database connection error!";
		} else {
			$query = sprintf ( "SELECT id, password FROM users WHERE username = '%s'", $mysqli->real_escape_string ( $_POST ['f'] ['username'] ) );
			$result = $mysqli->query ( $query );
			if ($row = $result->fetch_array ( MYSQLI_ASSOC )) {
				if (crypt ( $_POST ['f'] ['password'], $row ['password'] ) == $row ['password']) {
					$remember = false;
					if (isset ( $_POST ['rememberMe'] )) {
						$remember = true;
					}
					doLogin ( $row ['id'], $remember );
					$exitCode = 0;
					$exitMsg = "Login successful! Redirect in 3 seconds..<meta http-equiv='refresh' content='3; URL=/index.php'>";
				} else {
					$exitCode = 1;
					$exitMsg = "Wrong logindata!";
				}
			} else {
				$exitCode = 1;
				$exitMsg = "Wrong logindata!";
			}
			$mysqli->close ();
		}
	}
}

?>