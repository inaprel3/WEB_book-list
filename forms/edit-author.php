<?php
	include(__DIR__ . "/../auth/check-auth.php");
	if (!CheckRight('author', 'edit')) {
		die('Ви не маєте права на виконання цієї операції!');
	}
	
	if ($_POST) {
		$f = fopen('../data/' . $_GET['author'] . '/author.txt','w');
		$authArr = array($_POST['authorName'], $_POST['authorYear'], $_POST['authorCountry']);
		$authStr = implode(';', $authArr); 
		fwrite($f, $authStr);
		fclose($f);
		header('Location: ../index.php?author=' . $_GET['author']);
	}
	$authorFolder = $_GET['author'];
	require('../data/declare-author.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Редагування автора</title>
	<link rel="stylesheet" href="../css/edit-author-form-style.css">
</head>
<body>
	<a href="../index.php">На головну</a>
	<form name='edit-author' method='post'>

		<div>
			<label for='authorName'>ПІБ: </label><input type="text" name="authorName" value="
				<?php echo $data['author']['authorName']; ?>">
		</div>

		<div>
			<label for='authorYear'>Рік народження: </label><input type="text" name="authorYear" value="
				<?php echo $data['author']['authorYear']; ?>">
		</div>

		<div>
			<label for='authorCountry'>Країна: </label><input type="text" name="authorCountry" value="
				<?php echo $data['author']['authorCountry']; ?>">
			</div>

		<div><input type="submit" name="ok" style="margin-top: 20%; height:50px; width:150px" value="Змінити"></div>
	</form>
</body>
</html>