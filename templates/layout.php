<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
		<link rel="stylesheet" type="text/css" href="/style.css"/>
		<title></title>
	</head>
	<body>
		<div id="wrapper">
			<?php if (is_authenticated()) { ?>
				<div>
					Du är inloggad som <?=user_current()?>
					|
					<?= form_start(array('action' => '/session.php', 'method' => 'delete'))?>
						<input type="submit" value="logout" />
					</form>
					
			<?php } else { ?>
				<div>
					<a href="/session.php">Logga in</a>
					|
					<a href="/user.php">registrera</a>
				</div>
			<?php } ?>
			<?php if (isset($p['flash_notice'])) { ?>
				<div class="msg notice"><?=h($p['flash_notice'])?></div>
			<?php } else if (isset($p['flash_error'])) { ?>
				<div class="msg error"><?=h($p['flash_error'])?></div>
			<?php } ?>
			<?= $p['_content']?>
			<?= template('_webcam.php')?>
			<address>copyleft! <?php unset($p['_content']); //var_dump($p)?></address>
		</div>

	</body>
</html>
