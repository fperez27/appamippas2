<?php
session_start();
session_destroy();
echo " <script>
	alert(' Hasta Pronto');
	window.location='login.html';
</script>";
exit(0);
?>
