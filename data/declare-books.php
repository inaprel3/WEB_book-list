<?php
	$nameTpl = '/^book-\d\d.txt\z/'; 
	$path = __DIR__ . "/" . $authorFolder;
	$counts = scandir($path); 

	$i = 0;
	foreach ($counts as $node) {
		if (preg_match($nameTpl, $node)) { 
			$data['books'][$i] = require __DIR__ . '/declare-one-book.php';
			$i++;
		}
	}
?>