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

function read_main()
{
	global $core, $template;

	$data = file_get_contents('data.txt');
	$lines = explode("\n", $data);

	$questions = array();
	$subject = '';
	$question = 0;

	foreach ($lines as $line)
	{
		$line = preg_replace('~\s+~', ' ', trim($line));

		if (empty($line))
			continue;
		elseif (in_array($line, array('Misc')))
			$subject = $line;
		elseif (preg_match('~^(\d+). ([abcd])(.+)~', $line, $match))
		{
			$question = $match[1];
			$points = $question > 12 ? 7 : ($question > 6 ? 5 : 3);

			$questions[$subject][$question] = array(
				'q' => $match[3],
				't' => $match[2],
				'p' => $points,
			);
		}
		elseif (preg_match('~^([abcd])\) (.+)~', $line, $match))
			$questions[$subject][$question][$match[1]] = $match[2];
	}

	foreach ($questions as $subject => $group)
	{
		foreach ($group as $question)
		{
			$insert = array(
				'body' => "'" . htmlspecialchars($question['q'], ENT_QUOTES) . "'",
				'option_a' => "'" . htmlspecialchars($question['a'], ENT_QUOTES) . "'",
				'option_b' => "'" . htmlspecialchars($question['b'], ENT_QUOTES) . "'",
				'option_c' => "'" . htmlspecialchars($question['c'], ENT_QUOTES) . "'",
				'option_d' => "'" . htmlspecialchars($question['d'], ENT_QUOTES) . "'",
				'answer' => "'" . $question['t'] . "'",
				'subject' => "'" . $subject . "'",
				'points' => "'" . $question['p'] . "'",
			);

			db_query("
				INSERT INTO questions
					(" . implode(', ', array_keys($insert)) . ")
				VALUES
					(" . implode(', ', $insert) . ")");
		}
	}

	$request = db_query("
		SELECT COUNT(id)
		FROM questions
		LIMIT 1");
	list ($total_questions) = db_fetch_row($request);
	db_free_result($request);

	db_query("
		REPLACE INTO variables
			(name, value)
		VALUES
			('total_questions', '" . $total_questions . "')");

	$template['page_title'] = 'Read';
	$core['current_template'] = 'read_main';
}