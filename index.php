<?php
	require('auth/check-auth.php');
	require('data/declare-authors.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Автор</title>
	<link rel="stylesheet" href='css/main-style.css'>
	<link rel="stylesheet" href='css/genre-style.css'>
	<link rel="stylesheet" href='css/author-choose-style.css'>
</head>
<body>
	<header>
		<div class="user-info">
			<span>Hello <?php echo $_SESSION['user']; ?> !</span>
			<?php if(CheckRight('user','admin')): ?>
				<a href="admin/index.php">Адміністрування</a>
				<?php endif; ?>
			<a href="auth/logout.php">Logout</a>
		</div>
		<?php if(CheckRight('author', 'view')):?>
		<form name='author-form' method='get'>

			<label for="author">Автор</label>
			<select name="author">
				<option value=""></option>
				<?php
				foreach ($data['authors'] as $curauthor) {
					echo "<option " . (($curauthor['file'] == $_GET['author'])?"selected":"") . 
					"value ='" . $curauthor['file'] . "''>" . $curauthor['authorName'] . "</option>";
				}
				?>
			</select>
			<input type="submit" value="Перейти">

			<?php if(CheckRight('author', 'create')):?>
				<a href="forms/create-author.php">Додати автора</a>
			<?php endif; ?>
		</form>

		<?php if($_GET['author']): ?>
		<?php
			$authorFolder = $_GET['author'];
			require('data/declare-data.php');
		?>

		<h3><span class='text-author-name'>ПІБ: <span class='author-name'>
			<?php echo $data['author']['authorName']; ?></span>
		</h3>
		<h3><span class='text-author-year'>Рік народження: <span class='author-year'>
			<?php echo $data['author']['authorYear']; ?></span>
		</h3>
		<h3><span class='text-author-country'>Країна: <span class='author-country'>
			<?php echo $data['author']['authorCountry']; ?></span>
		</h3>
		<div class="control" style="margin-top: 3%">
		<?php if(CheckRight('author', 'edit')):?>
			<a href="forms/edit-author.php?author=
				<?php echo $_GET['author']; ?>">Редагувати автора</a>
			<?php endif; ?>
			<?php if(CheckRight('author', 'delete')):?>
			<a href="forms/delete-author.php?author=
				<?php echo $_GET['author']; ?>">Видалити автора</a>
			<?php endif; ?>
		</div>

		<?php endif; ?>
		<?php endif; ?>
	</header>
	
	<?php if(CheckRight('book', 'view')):?>
	<section>
		<?php if($_GET['author']): ?>
		<?php if(CheckRight('book', 'create')):?>
		<div class="control" style="margin-top: 3%">
			<a href="forms/create-book.php?author=
				<?php echo $_GET['author']; ?>">Додати книгу</a>
		</div>
		<?php endif; ?>

		<form name='books-filter' method='post' style="margin-top: 3%">
			Фільтрувати за назвою <input type="text" name="bookTitleFilter" value='
				<?php echo $_POST['bookTitleFilter']; ?>'>
			<input type="submit" value="Фільтрувати">
		</form>

		<table>
			<thead>
				<tr>Книги:
					<th>№</th>
					<th>Назва:</th>
					<th>Дата публікації:</th>
					<th>Жанр:</th>
					<th></th>
				</tr>
			</thead>

			<tbody>
				<?php foreach ($data['books'] as $key => $book): ?>
				<?php if(!$_POST['bookTitleFilter'] || stristr($book['bookTitle'], $_POST['bookTitleFilter'])): ?>
				<?php $row_class = 'row';
					if ($book['genre'] == 'кіберпанк') {
						$row_class = 'cyberpunk';
					}
					if ($book['genre'] == 'фантастика') {
						$row_class = 'fantasy';
					}
				?>

				<tr class = '<?php echo $row_class; ?>'>
					<td><?php echo ($key + 1); ?></td>
					<td><?php echo $book['bookTitle']; ?></td>

					<td>
					<?php $date_publish = new Datetime($book['date_publish']);
						echo date_format($date_publish, 'd.m.Y');
					?>
					</td>

					<td><?php echo $book['genre']; ?></td>
					<td>
						<?php if(CheckRight('book', 'edit')):?>
						<a href='forms/edit-book.php?author=<?php echo $_GET['author']; ?>&file=
							<?php echo $book['file'];?>'>Редагувати</a>
						<?php endif; ?>
						|
						<?php if(CheckRight('book', 'delete')):?>
						<a href='forms/delete-book.php?author=<?php echo $_GET['author'] ?>&file=
							<?php echo $book['file'];?>'>Видалити</a>
						<?php endif; ?>
					</td>
				</tr>

				<?php endif; ?>
				<?php endforeach; ?>
			</tbody>
		</table>

		<?php endif; ?>
	</section>
	<?php endif; ?>
</body>
</html>