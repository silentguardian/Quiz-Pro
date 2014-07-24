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

function template_score_main()
{
	global $template;

	echo '
	<div class="alert alert-warning">
		<div class="pull-right">
			<h3 onclick="do_next_question();"><span class="label label-danger">', $template['current_question'], ' / ', $template['total_questions'], ' questions</span></h3>
		</div>
		<h3 onclick="do_short_break();">Scores</h3>
	</div>';

	foreach ($template['points'] as $group => $points)
	{
		echo '
	<div class="resultrow text-right">
		<span class="label label-primary pull-left">', $template['users'][$group], '</span> ', $points, ' <small>points</small>
	</div>';
	}

	echo '
	</div>
	<script language="Javascript" type="text/javascript"><!-- // --><![CDATA[
		function do_next_question()
		{
			document.location.href = "', build_url('pause'), '";
		}
		function do_short_break()
		{
			document.location.href = "', build_url('break'), '";
		}
	// ]]></script>';
}