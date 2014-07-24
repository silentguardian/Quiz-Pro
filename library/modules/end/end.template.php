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

function template_end_main()
{
	echo '
		<div class="jumbotron alert-info">
			<p class="text-center">This is the end of the quiz!</p>
		</div>';
}