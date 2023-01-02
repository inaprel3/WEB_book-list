<?php
	$f = fopen(__DIR__ . "/" . $authorFolder ."/author.txt","r"); 
	$authArr = explode(';', $authStr); 
	fclose($f);

	$data['author'] = array(
		'authorName' => $authArr[0],
		'authorYear' => $authArr[1],
		'authorCountry' => $authArr[2],
	);
?>