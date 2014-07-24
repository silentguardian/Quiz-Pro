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

function template_do_main()
{
	global $template;

	echo '
	<div class="alert alert-info">
		<div class="pull-right">
			<h3 onclick="do_view_scores();">
				<span class="label label-primary">', $template['question']['s'], '</span>
				<span class="label label-', ($template['question']['p'] > 6 ? 'danger' : ($template['question']['p'] > 4 ? 'warning' : 'success')), '">', $template['question']['p'], ' points</span>
			</h3>
		</div>
		<h3 onclick="do_short_break();">Question ', $template['current_question'], ' of ', $template['total_questions'], '</h3>
	</div>
	<div class="jumbotron">
		<p><strong>', $template['question']['q'], '</strong></p>
		<p class="options">';

	foreach (array('a', 'b', 'c', 'd') as $o)
	{
		echo '
			<span class="label label-default">', strtoupper($o), '</span> <span', ($template['question']['t'] == $o ? ' id="do_correct"' : ''),'>', $template['question'][$o], '</span><br />';
	}

	echo '
		</p>
	</div>
	<div class="row" id="do_results" style="display: none;">';

	foreach ($template['users'] as $id => $name)
	{
		$answer = !empty($template['responses'][$id]) ? strtoupper($template['responses'][$id]) : '?';
		$class = $answer == strtoupper($template['question']['t']) ? 'success' : ($answer == '?' ? 'warning' : 'danger');

		echo '
		<div class="col-sm-4 text-center">
			<div class="alert alert-', $class, '" style="padding: 0.7em; font-size: 1.3em;">
				', $name, ': ', $answer, '
			</div>
		</div>';
	}

	echo '
	</div>
	<div>
		<div style="width: 32%; float: left;">
			<button type="button" class="btn btn-warning btn-lg btn-block" onclick="do_show_responses();">Show Responses</button>
		</div>
		<div style="width: 32%; float: right;">';

	if ($template['total_questions'] == $template['current_question'])
		echo '
			<button type="button" class="btn btn-danger btn-lg btn-block" onclick="do_next_question();">End Quiz</button>';
	else
		echo '
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="do_next_question();">Next Question</button>';

	echo '
		</div>
		<div style="width: 32%; margin: 0 auto;">
			<button type="button" class="btn btn-success btn-lg btn-block" onclick="do_show_answer();">Show Answer</button>
		</div>
	</div>
	<script language="Javascript" type="text/javascript"><!-- // --><![CDATA[
		function do_show_answer()
		{
			document.getElementById("do_correct").className = "label label-success";
		}
		function do_show_responses()
		{
			document.getElementById("do_results").style.display = "";
		}
		function do_next_question()
		{
			document.location.href = "', build_url('pause'), '";
		}
		function do_short_break()
		{
			document.location.href = "', build_url('break'), '";
		}
		function do_view_scores()
		{
			document.location.href = "', build_url('score'), '";
		}
	// ]]></script>';
}