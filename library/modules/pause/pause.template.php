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

function template_pause_main()
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
		<h3>Question ', ($template['current_question'] + 1), ' of ', $template['total_questions'], '</h3>
	</div>
	<div class="progress">
		<div id="progress_bar" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
			10 seconds
		</div>
	</div>
	<script language="Javascript" type="text/javascript"><!-- // --><![CDATA[
		var time_left = 10, time_interval;
		time_interval = setInterval("do_timer()", 1000);
		function do_timer()
		{
			time_left = time_left - 1;

			if (time_left < 0)
			{
				clearInterval(time_interval);

				document.getElementById("progress_bar").innerHTML = "<span class=\"label label-info\" onclick=\"do_show_question();\">Show Question</span>";
				document.getElementById("progress_bar").style.width = "100%";
			}
			else
			{
				document.getElementById("progress_bar").innerHTML = time_left + " seconds";
				document.getElementById("progress_bar").style.width = (time_left * 10) + "%";

				if (time_left < 4)
					document.getElementById("progress_bar").className = "progress-bar progress-bar-danger";
				else if (time_left < 7)
					document.getElementById("progress_bar").className = "progress-bar progress-bar-warning";
			}
		}
		function do_show_question()
		{
			document.location.href = "', build_url('do'), '";
		}
	// ]]></script>';
}