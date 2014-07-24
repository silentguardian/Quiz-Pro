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

function template_print_main()
{
	global $template;

	foreach ($template['questions'] as $key => $question)
	{
		echo '
		<h4>Question ', $key + 1, ' of ', count($template['questions']), ' <small>(', $question['s'], ' - ', $question['p'], ' points)</small></h4>
		<p><strong>', $question['q'], '</strong></p>
		<p>';

		foreach (array('a', 'b', 'c', 'd') as $o)
			echo ($question['t'] == $o ? '<strong>*</strong> ' : ''), $o, ') ', $question[$o], '<br />';

		echo '</p>
		<hr />';
	}
}