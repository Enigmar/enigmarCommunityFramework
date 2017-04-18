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
session_start ();
$_SESSION = array ();
if (ini_get ( 'session.use_cookies' )) {
	$params = session_get_cookie_params ();
	setcookie ( session_name (), '', time () - 42000, $params ['path'], $params ['domain'], $params ['httponly'] );
	
	setcookie ( "rememberMe", '', time () - 42000, $params ['path'], $params ['domain'], $params ['httponly'] );
	
	setcookie ( "rememberMeToken", '', time () - 42000, $params ['path'], $params ['domain'], $params ['httponly'] );
}
session_destroy ();
?>