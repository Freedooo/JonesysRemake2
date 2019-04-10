
<?php
	include 'C:/xampp/htdocs/WebDev2FinalProject/php-image-resize-master/lib/ImageResize.php';
	use \Gumlet\ImageResize;
    require('connect.php');
	$query = "SELECT * FROM reviews ORDER BY date DESC limit 5";
	$selectstatement = $db->prepare($query);
	$selectstatement->execute();
	$reviews = $selectstatement->fetchAll();
	$logged_in = false;
	session_start();
	if($_POST)
	{
		if($_POST['command'] =='search')
	  {
		  	echo "Searched";
	  }
	}
	  
	//Insert for reviews
		if($_POST)
		{
		// file_upload_path() - Safely build a path String that uses slashes appropriate for our OS.
		// Default upload path is an 'uploads' sub-folder in the current folder.
		function file_upload_path($original_filename, $upload_subfolder_name = 'uploads') 
		{
		$current_folder = dirname(__FILE__);
		
		// Build an array of paths segment names to be joins using OS specific slashes.
		$path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];
		
		// The DIRECTORY_SEPARATOR constant is OS specific.
		return join(DIRECTORY_SEPARATOR, $path_segments);
		}

		// isAllowedFile() - Checks the mime-type & extension of the uploaded file for "image-ness".
		function isAllowedFile($temporary_path, $new_path) {
			$allowed_mime_types      = ['image/gif', 'image/jpeg', 'image/png'];
			$allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png'];
			
			$actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);
			//var_dump($actual_file_extension);

			$actual_mime_type        = mime_content_type($temporary_path); // getimagesize($temporary_path)['mime'];
			//var_dump($actual_mime_type);


			$file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
			$mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);
			
			return $file_extension_is_valid && $mime_type_is_valid;
		}
		
		$image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);
		$upload_error_detected = isset($_FILES['image']) && ($_FILES['image']['error'] > 0);

		if ($image_upload_detected) 
		{ 
			$image_filename        = $_FILES['image']['name'];
			$temporary_image_path  = $_FILES['image']['tmp_name'];
			$new_image_path        = file_upload_path($image_filename);

			if (isAllowedFile($temporary_image_path, $new_image_path)) 
			{
				move_uploaded_file($temporary_image_path, $new_image_path);
			}

		}
	
		$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$image = $_FILES['image']['name'];
		$insertQuery = "INSERT INTO reviews (title,comment,image) values (:title,:comment,:image)";
		$statement = $db->prepare($insertQuery);
		
		$statement->bindValue(':title', $title);  
		$statement->bindValue(':comment', $comment);  
		$statement->bindValue(':image', $image); 
		
		$statement->execute(); 
		
		header('Location: jonesysreviews.php');
		exit();
	}
	
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="main.js"></script>
	<title>Jonesy's Resturaunt + Lounge | Menus</title>
	<link rel="stylesheet" type="text/css" href="jonesysmenu.css">
</head>
<body>

    <div id ="heading">
		<img src="friday.png" id="friday" alt="friday">
		<img src="jonesystitle.png" id="titlePic" alt="title">
		<img src="saturday.png" id="saturday" alt="saturday">
	</div>

	<nav id = "headingNav">
		<ul>
			<li><a href="index.html">Home</a></li>
			<li><a href="jonesysmenu.php">Menu</a></li>
			<li><a href="jonesysreservation.php">Reservation</a></li>
			<li><a href="jonesysreviews.php">Reviews</a></li>
		</ul>
	</nav>

	<form action="jonesysreviews.php" method = "POST">
			<label for="search">Seach by Title:</label>
			<input type='text' name='search' id='search'>
			<input type="submit" name = "command" value = "search">
	</form>
	<?php if(isset($_SESSION['LoggedIn'])): ?>
	<div class = "review">
		<?php foreach($reviews as $review) :?>
			<section>
				<div class = "review_content">
					<div class = review_title>
						<h1>Title: <?=$review['title']?></h1>
						<p>
							<small>
								<a href="fullcomment.php?id=<?=$review['id'] ?>">View Comments</a>
								<a href="editcomment.php?id=<?=$review['id'] ?>">Edit Comments</a>
							</small>
						</p>
						
					</div>
					
					<div class = review_comment>
						<p>Comment:<?=$review['comment']?> </p>
						<?php if(strlen($review['image']) > 0) : ?>
						<img src="uploads\<?=$review['image']?>" alt="<?=$review['image']?>">
						<?php endif ?>
					</div>
					
					
				</div>
			</section>
		<?php endforeach ?>
	</div>

    <div id = 'comment'>
		<h3>Make a review</h3>
		<form action="jonesysreviews.php" method ='POST' enctype='multipart/form-data'>
			<p>
				<label for="title">Title:</label>
				<input type="text" name="title" required>
			</p>
			<p>Comment:</p>
			<p><textarea name="comment" id="" cols="25" rows="5"></textarea></p>
			<label for='image'>Image Filename:</label>
			<input type='file' name='image' id='image'>
			<button type="submit" id="submit" name ='command' value ='submit_review'>Submit Review</button>
		</form>
		
    </div>

		<?php elseif(!isset($_SESSION['LoggedIn'])): ?>
		<div id = 'review_login_error'>
			<h3>You must Sign in to make a review <?= phpversion() ?></h3>
		</div>
			
		<?php endif ?>

		
</body>
</html> 