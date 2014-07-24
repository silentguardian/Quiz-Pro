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

function template_home_main()
{
	global $user;

	if ($user['admin'])
		$action = 'pause';
	elseif ($user['logged'])
		$action = 'answer';
	else
		$action = 'login';

	echo '
	<div class="jumbotron alert-info" onclick="do_next_question();">
		<p class="text-center">Welcome to the quiz!</p>
	</div>
	<script language="Javascript" type="text/javascript"><!-- // --><![CDATA[
		function do_next_question()
		{
			document.location.href = "', build_url($action), '";
		}
	// ]]></script>';
}