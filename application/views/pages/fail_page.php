<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo "ERROR: ".$heading ?></title>
<style type="text/css">
	.error-msg
	{
		display: flex;
		justify-content: center;
		align-items:center;
		text-align:center;
		padding-top: 100px;
		padding-bottom: 10px;
		font-size:50px;
		opacity: 0.3;
		filter: Alpha(opacity=30);
		font-family: sans-serif;
		font-weight: bold;
	}
	.message {
		font-size: 30px;
	}
</style>
</head>
<body>
<div class="error-msg">
	<table style="text-align:center;">
		<tr>
			<td class="error-msg">
				ERROR: <?php echo $heading ?>
			</td>
		</tr>
		<tr>
			<td class="message">
				<?php echo $message ?>
			</td>
		</tr>
	</table>
</div>
</body>
</html>