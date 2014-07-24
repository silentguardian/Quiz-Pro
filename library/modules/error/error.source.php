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

function error_main()
{
	global $core, $template;

	$template['page_title'] = 'Error';
	$core['current_template'] = 'error_main';
}