<?php
	include(__DIR__ . "/../auth/check-auth.php");
	if (!CheckRight('book', 'delete')) {
		die('Ви не маєте права на виконання цієї операції!');
	}

	unlink(__DIR__ . "/../data/" . $_GET['author'] . "/" . $_GET['file']); 
	header('Location: ../index.php?author=' . $_GET['author']);
?>