<?php
	include(__DIR__ . "/../auth/check-auth.php");
	if (!CheckRight('author', 'create')) {
		die('Ви не маєте права на виконання цієї операції!');
	}

	//визначимо останню папку автора
	$nameTpl = '/^author-\d\d\z/';
	$path = __DIR__ . "/../data" ;
	$counts = scandir($path);
	$i = 0;
	foreach ($counts as $node) {
		if (preg_match($nameTpl, $node)) {
			$last_author = $node;
		}
	}
	//отримуємо індекс останньої папки та збільшуємо на 1
	$author_index = (String)(((int)substr($last_author, -1, 2)) + 1);
	if (strlen($author_index) == 1) {
		$author_index = "0" . $author_index;
	}
	//формуємо ім'я нової папки
	$newAuthorName = "author-" . $author_index;
	mkdir(__DIR__ . "/../data/" . $newAuthorName);
	$f = fopen(__DIR__ . '/../data/' . $newAuthorName . '/author.txt' , "w");
	fwrite($f, 'New; ; ');
	fclose($f);
	header('Location: ../index.php?author=' . $newAuthorName);
?>