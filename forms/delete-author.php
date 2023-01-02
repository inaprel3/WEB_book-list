<?php
	include(__DIR__ . "/../auth/check-auth.php");
	if (!CheckRight('author', 'delete')) {
		die('Ви не маєте права на виконання цієї операції!');
	}

	$dirName = "../data/" . $_GET['author'];
	$counts = scandir($dirName);
	$i = 0;
	foreach ($counts as $node) {
		@unlink($dirName . '/' . $node);
	}
	@rmdir($dirName);
	header('Location: ../index.php');
?>