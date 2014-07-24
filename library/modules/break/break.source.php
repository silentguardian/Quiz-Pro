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

function break_main()
{
	global $core, $template;

	$template['page_title'] = 'Break';
	$core['current_template'] = 'break_main';
}