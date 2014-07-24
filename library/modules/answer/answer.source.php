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

function answer_main()
{
	global $core, $template, $user;

	$request = db_query("
		SELECT name, value
		FROM variables");
	while ($row = db_fetch_assoc($request))
		$template[$row['name']] = $row['value'];
	db_free_result($request);

	if (empty($template['current_question']))
		$template['current_question'] = 0;
	elseif ($template['current_question'] > $template['total_questions'])
		redirect(build_url('end'));

	if (!empty($_POST['send']))
	{
		$answer = '';
		if (!empty($_POST['answer']) && in_array($_POST['answer'], array('a', 'b', 'c', 'd')))
			$answer = $_POST['answer'];

		db_query("
			UPDATE answers
			SET option_s = '$answer'
			WHERE user = $user[id]
				AND question = $template[current_question]
			LIMIT 1");
	}

	$request = db_query("
		SELECT id
		FROM answers
		WHERE user = $user[id]
			AND question = $template[current_question]
		LIMIT 1");
	list ($done) = db_fetch_row($request);
	db_free_result($request);

	if (!empty($done) || empty($template['current_question']))
	{
		$template['page_title'] = 'Wait';
		$core['current_template'] = 'answer_wait';

		return;
	}

	db_query("
		REPLACE INTO answers
			(user, question)
		VALUES
			('$user[id]', '" . $template['current_question'] . "')");

	$request = db_query("
		SELECT
			body, option_a, option_b, option_c,
			option_d, subject, points
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
			's' => $row['subject'],
			'p' => $row['points'],
		);
	}
	db_free_result($request);

	$template['page_title'] = 'Answer';
	$core['current_template'] = 'answer_main';
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