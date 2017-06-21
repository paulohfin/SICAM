<?php
	
	if(!array_key_exists('nv', $_SESSION))
		echo '<script>location.href="index.php?f1=' . $_GET['f1'] .'&f2=' . $_GET['f2'] .'"</script>';
?>