<?php
	require('config/config.php');
	require('config/db.php');

	// Create Query
	$query = 'SELECT * FROM posts ORDER BY created_at DESC';

	// Get Results
	$result = mysqli_query($conn, $query);

	// Fetch Data
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
	//var_dump($posts);

	// Free The Result
	mysqli_free_result($result);

	// Close The Connection
	mysqli_close($conn);
	
?>

<?php
	include ('inc/header.php');
?>
	<h1 style="font-size: 2.5rem; text-transform: uppercase;">Posts</h1>
	<?php foreach($posts as $post) : ?> 
		<div style="border-bottom: 1px solid white; padding-bottom: 0.5em;">
			<h3 style="text-transform: uppercase; color: steelblue"><?php echo $post['title']; ?></h3>
			<small>Created on <?php echo $post['created_at'] ?> by <?php echo $post['author'] ?></small>
			<p><?php echo $post['body'] ?></p>
			<a href="<?php echo ROOT_URL; ?>post.php?id=<?php echo $post['id']; ?>" style="text-decoration: none; color: #000; background: #ddd;">Read more...</a>
		</div>
	<?php endforeach; ?> 
<?php
	include ('inc/footer.php');
?>