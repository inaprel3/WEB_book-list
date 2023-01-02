<?php
	$f = fopen($path . "/" . $node, "r");
	$rowStr = fgets($f); 
	$rowArr = explode(";", $rowStr); 
	$book["file"] = $node;
	$book["bookTitle"] = $rowArr[0];
	$book["date_publish"] = $rowArr[1];
	$book["genre"] = $rowArr[2];
	$book["read"] = $rowArr[3];
	fclose($f);

	return $book;
?>