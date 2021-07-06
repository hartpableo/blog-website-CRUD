<?php
	require('config/config.php');
	require('config/db.php');

	// Check For Submit
	if (isset($_POST['submit'])) {
		// Get Form Data
		$update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$author = mysqli_real_escape_string($conn, $_POST['author']);
		$body = mysqli_real_escape_string($conn, $_POST['body']);

		$query = "UPDATE posts SET
				title='$title',
				author='$author',
				body='$body'
		WHERE id = {$update_id}";

		if (mysqli_query($conn, $query)) {
			header('Location: '.ROOT_URL.'');
		} else {
			echo 'Error: '.mysqli_error($conn);
		}
	}

	// Get ID
	$id = mysqli_real_escape_string($conn, $_GET['id']);

	// Create Query
	$query = 'SELECT * FROM posts WHERE id='.$id;

	// Get Results
	$result = mysqli_query($conn, $query);

	// Fetch Data
	$post = mysqli_fetch_assoc($result);
	//var_dump($posts);

	// Free The Result
	mysqli_free_result($result);

	// Close The Connection
	mysqli_close($conn);
?>

<?php
	include ('inc/header.php');
?>
	<h1 style="font-size: 2.5rem; text-transform: uppercase; color: steelblue;">Add Post</h1>
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" style="display: flex; flex-direction: column; width: 500px;">
			<label>Title</label>
			<input type="text" name="title" value="<?php echo $post['title']; ?>">
			<label>Author</label>
			<input type="text" name="author" value="<?php echo $post['author']; ?>">
			<label>Body</label>
			<textarea name="body" value="<?php echo $post['body']; ?>"></textarea>
			<input type="submit" name="submit" value="submit">
			<input type="hidden" name="update_id" value="<?php echo $post['id']; ?>">
		</form>
<?php
	include ('inc/footer.php');
?>