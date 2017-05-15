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
 
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/ecf/core/class/changepwProcess.php'; ?>
<link href="/ecf/themes/default/login.css" rel="stylesheet"
	type="text/css">
<div id="loginField" class="logo-field">
							<?php
							if ($exitCode == 0) {
								echo '<div class="alert alert-success" role="alert"> <strong>Success: </strong>' . $exitMsg . '</div>';
								$_SESSION ['login'] = true;
							} else if ($exitCode == 1) {
								echo '<div class="alert alert-warning" role="alert"> <strong>Error: </strong>' . $exitMsg . '</div>';
							}
							?>
<form method="post" accept-charset="utf-8" autocomplete="off"
		role="form" class="form-horizontal">
		<fieldset>
			<legend>Change Passphrase</legend>

			<input type="password" name="f[passOld]" id="passOld"
				placeholder="Passphrase old" value="" tabindex="1" /> <input
				type="password" name="f[passNew]" id="passNew]"
				placeholder="Passphrase new" value="" tabindex="2" /> <input
				type="password" name="f[passNew_again]" id="passNew_again"
				placeholder="Passphrase new again" value="" tabindex="3" />
		</fieldset>
		<fieldset>
			<button type="submit" name="change" id="change" tabindex="4"
				class="btn btn-outline-success">Change Passphrase</button>
		</fieldset>
	</form>
</div>
