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

function score_main()
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

	$request = db_query("
		SELECT id, username
		FROM user
		WHERE id > 1");
	$template['users'] = array();
	while ($row = db_fetch_assoc($request))
		$template['users'][$row['id']] = $row['username'];
	db_free_result($request);

	$request = db_query("
		SELECT user, question, option_s
		FROM answers");
	$choices = array();
	while ($row = db_fetch_assoc($request))
		$choices[$row['question']][$row['user']] = $row['option_s'];
	db_free_result($request);

	$request = db_query("
		SELECT answer, points
		FROM questions");
	$questions = array();
	while ($row = db_fetch_assoc($request))
		$questions[] = array($row['answer'], $row['points']);
	db_free_result($request);

	$template['points'] = array();

	foreach ($template['users'] as $id => $name)
		$template['points'][$id] = 0;

	foreach ($choices as $question => $groups)
	{
		foreach ($groups as $group => $choice)
		{
			if ($choice == $questions[$question - 1][0])
				$template['points'][$group] += $questions[$question - 1][1];
		}
	}

	arsort($template['points']);

	$template['page_title'] = 'Scores';
	$core['current_template'] = 'score_main';
}