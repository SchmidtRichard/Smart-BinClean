<?php
	session_start();//Gets the live sessions
	session_destroy();//Destroy the live sessions
	$url='/';//Sends user back to root
	echo '<META HTTP-EQUIV=REFRESH CONTENT="0; '.$url.'">';//Refresh the page in order to get bak to the root -> index.html
?>
