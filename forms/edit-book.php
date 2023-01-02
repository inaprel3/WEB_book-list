<?php
  include(__DIR__ . "/../auth/check-auth.php");
	if (!CheckRight('book', 'edit')) {
		die('Ви не маєте права на виконання цієї операції!');
	}

  if ($_POST) {
    $f = fopen('../data/' . $_GET['author'] . "/" . $_GET['file'],'w');
    $read = 0;
    if ($_POST['read'] == 1) {
      $read =  1;
    }
    $authArr = array($_POST['bookTitle'], $_POST['date_publish'], $_POST['genre'], $read);
    $authStr = implode(';', $authArr);
    fwrite($f, $authStr);
    fclose($f);
    header('Location: ../index.php?author=' . $_GET['author']);
  }
  $path = __DIR__ . "/../data/" . $_GET['author'];
  $node = $_GET['file'];
  $book = require __DIR__ . '/../data/declare-one-book.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Редагування книги</title>
  <link rel="stylesheet" href='../css/edit-book-form-style.css'>
</head>

<body>
  <a href="../index.php">На головну</a>
  <form name='edit-book' method='post'> 

    <div>
      <label for='bookTitle'>Назва книги: </label>
      <input type="text" name="bookTitle" value="
        <?php echo $book['bookTitle']; ?>">
    </div>

    <div>
      <label for='date_publish'>Дата публікації: </label>
      <input type="date" name="date_publish" value="
        <?php echo $book['date_publish']; ?>">
    </div>

    <div>
      <label for='genre'>Жанр: </label>
      <select name="genre">
        <option disabled>Жанр</option>
        <option <?php echo ("кіберпанк" == $book['genre'])?"selected":""; ?> 
          value="кіберпанк">кіберпанк</option>
        <option <?php echo ("фантастика" == $book['genre'])?"selected":""; ?> 
          value="фантастика">фантастика</option>
        <option <?php echo ("інше" == $book['genre'])?"selected":""; ?> 
          value="інше">інше</option>
      </select>
    </div>

    <div>
      <input type="checkbox" <?php echo ("1" == $book['read'])?"checked":""; ?> 
        name="read" value=1> Прочитана
    </div>

    <div><input type="submit" name="ok" style="margin-top: 20%; height:50px; width:150px" value="Змінити"></div>
  </form>
</body>
</html>