<?php
	include(__DIR__ . "/../auth/check-auth.php");
	if (!CheckRight('book', 'create')) {
		die('Ви не маєте права на виконання цієї операції!');
	}

	if ($_POST) {
		//визначаємо останній файл актора в групі
		$nameTpl = '/^book-\d\d.txt\z/'; 
		$path = __DIR__ . "/../data/" . $_GET['author'];
		$counts = scandir($path);
		$i = 0;
		foreach ($counts as $node) {
			if (preg_match($nameTpl, $node)) {
				$last_file = $node;
			}
		}
		//отримуємо індекс останнього файлу та збільшуємо на 1
		$file_index = (String)(((int)substr($last_file, -6, 2)) + 1); 
		if (strlen($file_index) == 1) { 
			$file_index = "0" . $file_index;
		}
		//формуємо ім'я нового файлу
		$newFileName = "book-" . $file_index . ".txt";
		//зберігаємо дані у файл
		$f = fopen("../data/" . $_GET['author'] . "/" . $newFileName , "w");
		$read = 0;
		if ($_POST['read'] == 1) {
			$read = 1;
		}
		$authArr = array($_POST['bookName'], $_POST['date_publish'], $_POST['genre'], $read);
		$authStr = implode(";", $authArr); 
		fwrite($f, $authStr); 
		fclose($f);
		header('Location: ../index.php?author=' . $_GET['author']);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Додавання книги</title>
	<link rel="stylesheet" href='../css/edit-book-form-style.css'>
</head>
<body>
	<a href="../index.php">На головну</a>
	<form name='edit-book' method='post'>
		<div>
	      <label for='bookTitle'>Назва книги: </label>
	      <input type="text" name="bookTitle">
	    </div>

	    <div>
	      <label for='date_publish'>Дата публікації: </label>
	      <input type="date" name="date_publish">
	    </div>

	    <div>
	      <label for='genre'>Жанр книги: </label>
	      <select name="genre">
	        <option disabled>Жанр</option>
	        <option value="кіберпанк">кіберпанк</option>
	        <option value="фантастика">фантастика</option>
	        <option value="інше">інше</option>
	      </select>
	    </div>

	    <div>
	      <input type="checkbox" name="read" value=1> Прочитана
	    </div>

	    <div><input type="submit" name="ok" value="Додати"></div>
	</form>
</body>
</html>