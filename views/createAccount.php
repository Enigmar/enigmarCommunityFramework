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
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/ecf/core/class/createProcess.php'; ?>
<link href="/ecf/themes/default/login.css" rel="stylesheet"
	type="text/css">
<div id="loginField" class="logo-field">

	<form method="post" accept-charset="utf-8" autocomplete="off"
		role="form" class="form-horizontal">
<?php if (isset($message['error'])): ?>
			<div class="alert alert-warning" role="alert">
			<strong>Error:</strong> <?php echo $message['error'] ?></div>
<?php endif;

if (isset ( $message ['success'] )) :
	?>
			<div class="alert alert-success" role="alert">
			<strong>Success:</strong> <?php echo $message['success'] ?></div>
<?php endif; ?>
			<fieldset>
			<legend>Create Account</legend>

			<input type="text" name="f[accountname]" id="accountname"
				placeholder="Accountname" value="" tabindex="1" /> <input
				type="password" name="f[pass]" id="pass" placeholder="Passphrase"
				value="" tabindex="2" /> <input type="password" name="f[pass_again]"
				id="pass_again" placeholder="Passphrase again" value="" tabindex="3" />
		</fieldset>
		<fieldset>
			<button type="submit" name="create" id="create" tabindex="4"
				class="btn btn-outline-success">Create Account</button>
		</fieldset>
	</form>
</div>
