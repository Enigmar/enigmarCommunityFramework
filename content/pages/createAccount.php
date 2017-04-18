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
