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

function do_main()
{
	global $core, $template;

	$request = db_query("
		SELECT name, value
		FROM variables");
	while ($row = db_fetch_assoc($request))
		$template[$row['name']] = $row['value'];
	db_free_result($request);

	if (empty($template['current_question']))
		$template['current_question'] = 1;
	elseif ($template['current_question'] > $template['total_questions'])
		redirect(build_url('end'));

	$request = db_query("
		SELECT id, username
		FROM user
		WHERE id > 1");
	$template['users'] = array();
	while ($row = db_fetch_assoc($request))
		$template['users'][$row['id']] = $row['username'];
	db_free_result($request);

	$request = db_query("
		SELECT user, option_s
		FROM answers
		WHERE question = " . $template['current_question']);
	$template['responses'] = array();
	while ($row = db_fetch_assoc($request))
		$template['responses'][$row['user']] = $row['option_s'];
	db_free_result($request);

	$request = db_query("
		SELECT
			body, option_a, option_b, option_c,
			option_d, answer, subject, points
		FROM questions
		LIMIT " . ($template['current_question'] - 1) . ", 1");
	$template['question'] = array();
	while ($row = db_fetch_assoc($request))
	{
		$template['question'] = array(
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

	$template['page_title'] = 'Do';
	$core['current_template'] = 'do_main';
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