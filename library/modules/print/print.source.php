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

function print_main()
{
	global $core, $template;

	$request = db_query("
		SELECT
			body, option_a, option_b, option_c,
			option_d, answer, subject, points
		FROM questions");
	$template['questions'] = array();
	while ($row = db_fetch_assoc($request))
	{
		$template['questions'][] = array(
			'q' => parse_text($row['body']),
			'a' => $row['option_a'],
			'b' => $row['option_b'],
			'c' => $row['option_c'],
			'd' => $row['option_d'],
			't' => $row['answer'],
			's' => $row['subject'],
			'p' => $row['points'],
		);
	}
	db_free_result($request);

	$template['page_title'] = 'Print';
	$core['current_template'] = 'print_main';
}

function parse_text($text)
{
	$search = array(
		'[l]',
		'[i]',
		'[/i]',
		'[u]',
		'[/u]',
	);
	$replace = array(
		'<br />',
		'<em>',
		'</em>',
		'<span style="text-decoration: underline;">',
		'</span>',
	);

	return str_replace($search, $replace, $text);
}