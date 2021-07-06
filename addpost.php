<?php
	require('config/config.php');
	require('config/db.php');

	// Check For Submit
	if (isset($_POST['submit'])) {
		// Get Form Data
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$author = mysqli_real_escape_string($conn, $_POST['author']);
		$body = mysqli_real_escape_string($conn, $_POST['body']);

		$query = "INSERT INTO posts(title, author, body) VALUES('$title', '$author', '$body')";

		if (mysqli_query($conn, $query)) {
			header('Location: '.ROOT_URL.'');
		} else {
			echo 'Error: '.mysqli_error($conn);
		}
	}
?>

<?php
	include ('inc/header.php');
?>
	<h1 style="font-size: 2.5rem; text-transform: uppercase; color: steelblue;">Add Post</h1>
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" style="display: flex; flex-direction: column; width: 500px;">
			<label>Title</label>
			<input type="text" name="title">
			<label>Author</label>
			<input type="text" name="author">
			<label>Body</label>
			<textarea name="body"></textarea>
			<input type="submit" name="submit" value="submit">
		</form>
<?php
	include ('inc/footer.php');
?>