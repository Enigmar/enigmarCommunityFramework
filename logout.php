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
require_once $_SERVER ['DOCUMENT_ROOT'] . '/ecf/core/class/logoutProcess.php';
header ( 'Location: http://' . $_SERVER ['HTTP_HOST'] . '/login.php' );

?>

