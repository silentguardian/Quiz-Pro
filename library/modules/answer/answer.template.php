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

function template_answer_main()
{
	global $template;

	echo '
	<div class="alert alert-info">
		<div class="pull-right">
			<h3>
				<span class="label label-primary">', $template['question']['s'], '</span>
				<span class="label label-', ($template['question']['p'] > 6 ? 'danger' : ($template['question']['p'] > 4 ? 'warning' : 'success')), '">', $template['question']['p'], ' points</span>
			</h3>
		</div>
		<h3>Question ', $template['current_question'], ' of ', $template['total_questions'], '</h3>
	</div>
	<form role="form" action="', build_url('answer'), '" method="post" id="answer_form" name="answer_form">
	<div class="jumbotron">
		<p><strong>', $template['question']['q'], '</strong></p>
		<p class="options">';

	foreach (array('a', 'b', 'c', 'd') as $o)
	{
		echo '
			<label><input type="radio" name="answer" value="', $o, '"> <span class="label label-default">', strtoupper($o), '</span> ', $template['question'][$o], '</label><br />';
	}

	echo '
		</p>
	</div>
	<div>
		<div style="width: 32%; float: right;">
			<button type="button" class="btn btn-warning btn-lg btn-block" onclick="answer_submit();">Submit Answer</button>
		</div>
		<div style="width: 64%; float: left;">
			<div class="progress progresss">
				<div id="progress_bar" class="progress-bar progresss-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
					10 seconds
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" name="send" value="1" />
	</form>
	<script language="Javascript" type="text/javascript"><!-- // --><![CDATA[
		var time_left = 10, time_interval;
		time_interval = setInterval("answer_timer()", 1000);
		function answer_timer()
		{
			time_left = time_left - 1;

			if (time_left < 0)
			{
				clearInterval(time_interval);

				document.getElementById("progress_bar").innerHTML = "Time is up!";
				document.getElementById("progress_bar").style.width = "100%";

				answer_submit();
			}
			else
			{
				document.getElementById("progress_bar").innerHTML = time_left + " seconds";
				document.getElementById("progress_bar").style.width = (time_left * 10) + "%";

				if (time_left < 4)
					document.getElementById("progress_bar").className = "progress-bar progresss-bar progress-bar-danger";
				else if (time_left < 7)
					document.getElementById("progress_bar").className = "progress-bar progresss-bar progress-bar-warning";
			}
		}
		function answer_submit()
		{
			document.getElementById("answer_form").submit();
		}
	// ]]></script>';
}

function template_answer_wait()
{
	echo '
	<div class="jumbotron alert-warning">
		<p class="text-center">Preparing your question...</p>
	</div>
	<script language="Javascript" type="text/javascript"><!-- // --><![CDATA[
		setInterval("answer_refresh()", 1000);
		function answer_refresh()
		{
			document.location.href = "', build_url('answer'), '";
		}
	// ]]></script>';
}