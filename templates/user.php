<?= form_start(array('action'=>'/user.php','method' => 'post'))?>
	<?php if (isset($p['user_errors'])) var_dump($p['user_errors']); ?>
	<input type="text" name="username" placeholder="username" value=""/>
	<input type="password" name="password" placeholder="password" value=""/>
	<input type="submit" value="register!"/>
</form>
