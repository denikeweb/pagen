<?php
	/**
	 * @version Pagen 1.1
	 */
	header("HTTP/1.0 404 Not Found"); ?>
<div style="
	font-size: 32px;
	font-weight: bold;
	color: #35526c;
	border-bottom: 1px solid #ccc;
	margin-bottom: 10px;
	padding-bottom: 10px;
">404 / Page Not Found</div>
<div style="
	font-size:16px;
	color: #555;
">The requested URL <?php echo $_SERVER ['REQUEST_URI']; ?> was not found on this server.</div>