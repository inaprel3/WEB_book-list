<?php
	$nameTpl = '/^author-\d\d\z/';
	$path = __DIR__ ;
	$counts = scandir($path);

	$i = 0;
	foreach ($counts as $node) {
		if (preg_match($nameTpl, $node)) {
			$authorFolder = $node;
			require(__DIR__ . '/declare-author.php');

			$data['authors'][$i]['authorName'] = $data['author']['authorName'];
			$data['authors'][$i]['file'] = $authorFolder;
			$i++;
		}
	}
?>