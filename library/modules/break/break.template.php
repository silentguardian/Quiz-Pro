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

function template_break_main()
{
	echo '
	<div class="jumbotron alert-warning">
		<p class="text-center">Time for a short break!</p>
	</div>
	<div>
		<div style="width: 48%; float: left;">
			<button type="button" class="btn btn-warning btn-lg btn-block" onclick="do_view_scores();">View Scores</button>
		</div>
		<div style="width: 48%; float: right;">
			<button type="button" class="btn btn-info btn-lg btn-block" onclick="do_next_question();">Next Question</button>
		</div>
	</div>
	<script language="Javascript" type="text/javascript"><!-- // --><![CDATA[
		function do_next_question()
		{
			document.location.href = "', build_url('pause'), '";
		}
		function do_view_scores()
		{
			document.location.href = "', build_url('score'), '";
		}
	// ]]></script>';
}