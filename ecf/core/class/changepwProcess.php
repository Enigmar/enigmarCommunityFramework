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
include $_SERVER ['DOCUMENT_ROOT'] . '/inc/settings.php';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/ecf/core/api/enigmarAPI.php';
$exitCode = - 1;
$exitMsg = "";
if (! empty ( $_POST )) {
	if (empty ( $_POST ['f'] ['passOld'] ) || empty ( $_POST ['f'] ['passNew'] ) || empty ( $_POST ['f'] ['passNew_again'] )) {
		$exitMsg = 'Not all fields are filled';
		$exitCode = 1;
	} else if ($_POST ['f'] ['passNew'] != $_POST ['f'] ['passNew_again']) {
		$exitMsg = 'Two passwords do not match!';
		$exitCode = 1;
	} else {
		$mysqli = @new mysqli ( $hostname, $user, $password, $database );
		if ($mysqli->connect_error) {
			$exitCode = 1;
			$exitMsg = "Database connection error!";
		} else {
			$query = sprintf ( "SELECT id, password FROM users WHERE id = '%s'", $mysqli->real_escape_string ( $_SESSION ['userprofil'] ['id'] ) );
			$result = $mysqli->query ( $query );
			if ($row = $result->fetch_array ( MYSQLI_ASSOC )) {
				if (crypt ( $_POST ['f'] ['passOld'], $row ['password'] ) == $row ['password']) {
					$salt = '';
					for($i = 0; $i < 22; $i ++) {
						$salt .= substr ( './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', mt_rand ( 0, 63 ), 1 );
					}
					$cryptNewPw = crypt ( $_POST ['f'] ['passNew'], '$2a$10$' . $salt );
					$query = sprintf ( "UPDATE users SET password = '%s' WHERE id = '%s'", $mysqli->real_escape_string ( $cryptNewPw ), $mysqli->real_escape_string ( $row ['id'] ) );
					if ($mysqli->query ( $query ) === TRUE) {
						$exitCode = 0;
						$exitMsg = "PW changed";
					}
				} else {
					$exitCode = 1;
					$exitMsg = "Wrong password";
				}
			} else {
				$exitCode = 1;
				$exitMsg = "Wrong password";
			}
			$mysqli->close ();
		}
	}
}
?>