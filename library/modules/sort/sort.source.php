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

function sort_main()
{
	global $core, $template;

	db_query("
		UPDATE questions
		SET random = FLOOR(10 + (RAND() * 90))");

	db_query("
		ALTER TABLE questions
		ORDER BY random");

	$template['page_title'] = 'Sort';
	$core['current_template'] = 'sort_main';
}