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

function pause_main()
{
	global $core, $template;

	$request = db_query("
		SELECT name, value
		FROM variables");
	while ($row = db_fetch_assoc($request))
		$template[$row['name']] = $row['value'];
	db_free_result($request);

	if (empty($template['current_question']))
		$template['current_question'] = 0;
	elseif ($template['current_question'] > ($template['total_questions'] - 1))
		redirect(build_url('end'));

	db_query("
		REPLACE INTO variables
			(name, value)
		VALUES
			('current_question', '" . ($template['current_question'] + 1) . "')");

	$request = db_query("
		SELECT subject, points
		FROM questions
		LIMIT " . $template['current_question'] . ", 1");
	$template['question'] = array();
	while ($row = db_fetch_assoc($request))
	{
		$template['question'] = array(
			's' => $row['subject'],
			'p' => $row['points'],
		);
	}
	db_free_result($request);

	$template['page_title'] = 'Pause';
	$core['current_template'] = 'pause_main';
}