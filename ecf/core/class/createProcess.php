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
$message = array ();
if (! empty ( $_POST )) {
	if (empty ( $_POST ['f'] ['accountname'] ) || empty ( $_POST ['f'] ['pass'] ) || empty ( $_POST ['f'] ['pass_again'] )) {
		$message ['error'] = 'Es wurden nicht alle Felder ausgefüllt.';
	} else if ($_POST ['f'] ['pass'] != $_POST ['f'] ['pass_again']) {
		$message ['error'] = 'Die eingegebenen Passwörter stimmen nicht überein.';
	} else {
		unset ( $_POST ['f'] ['pass_again'] );
		$salt = '';
		for($i = 0; $i < 22; $i ++) {
			$salt .= substr ( './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', mt_rand ( 0, 63 ), 1 );
		}
		$_POST ['f'] ['pass'] = crypt ( $_POST ['f'] ['pass'], '$2a$10$' . $salt );
		
		$mysqli = @new mysqli ( $hostname, $user, $password, $database );
		if ($mysqli->connect_error) {
			$message ['error'] = 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
		}
		
		$query = sprintf ( "SELECT username from users where username='%s' LIMIT 1", $mysqli->real_escape_string ( $_POST ['f'] ['accountname'] ) );
		$result = $mysqli->query ( $query );
		
		if (mysqli_num_rows ( $result ) == 1) {
			$message ['error'] = 'Der Benutzername ist bereits vergeben.';
		} else {
			$query = sprintf ( "INSERT INTO users (username, password) VALUES ('%s', '%s')", $mysqli->real_escape_string ( $_POST ['f'] ['accountname'] ), $mysqli->real_escape_string ( $_POST ['f'] ['pass'] ) );
			if ($mysqli->query ( $query ) === TRUE) {
				$message ['success'] = 'Neuer Benutzer (' . htmlspecialchars ( $_POST ['f'] ['accountname'] ) . ') wurde angelegt.';
			}
		}
		$mysqli->close ();
	}
}
?>