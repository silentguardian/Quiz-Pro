<?php

/**
 * @package Quiz
 *
 * @author Selman Eser
 * @copyright 2014 Selman Eser
 * @license BSD 2-clause
 *
 * @version 1.0
 */

if (!defined('CORE'))
	exit();

function template_login_main()
{
	global $user;

	echo '
		<form class="form-signin" role="form" action="', build_url('login'), '" method="post">
			<h2 class="form-signin-heading">Please log in</h2>
			<input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
			<input type="password" name="password" class="form-control" placeholder="Password" required>
			<button class="btn btn-lg btn-info btn-block" type="submit" name="submit" value="Log in">Log in</button>
		</form>';
}