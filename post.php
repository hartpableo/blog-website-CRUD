<?php
	require('config/config.php');
	require('config/db.php');

	// Check For Delete
	if (isset($_POST['delete'])) {
		// Get Form Data
		$delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

		$query = "DELETE FROM posts WHERE id = {$delete_id}";

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
	<a href="<?php echo ROOT_URL; ?>" style="text-decoration: none; color: #000; background: #ddd;">Back</a>
	<h1 style="font-size: 2.5rem; text-transform: uppercase; color: steelblue;"><?php echo $post['title']; ?></h1>
		<div style="border-bottom: 1px solid white;">
			<small>Created on <?php echo $post['created_at'] ?> by <?php echo $post['author'] ?></small>
			<p><?php echo $post['body'] ?></p>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input type="hidden" name="delete_id" value="<?php echo $post['id']; ?>">
				<input type="submit" name="delete" value="Delete" style="margin-bottom: 1em;">
			</form>
			<a href="<?php echo ROOT_URL; ?>editpost.php?id=<?php echo $post['id']; ?>" style="text-decoration: none; color: #000; background: #ddd;">Edit</a>
		</div>
<?php
	include ('inc/footer.php');
?>