
<?php
    require('connect.php');
	$query = "SELECT * FROM reviews ORDER BY date DESC";
	$selectstatement = $db->prepare($query);
	$selectstatement->execute();
	$reviews = $selectstatement->fetchAll();
	

	//Insert for reviews
    if($_POST)
    {
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		
        $insertQuery = "INSERT INTO reviews (title,comment) values (:title,:comment)";
        $statement = $db->prepare($insertQuery);
        
        $statement->bindValue(':title', $title);  
        $statement->bindValue(':comment', $comment);  
        
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

	<div class = "review">
		<?php foreach($reviews as $review) :?>
			<h1>Title: <?=$review['title']?></h1>
			<p>Comment:<?=$review['comment']?> </p>
		<?php endforeach ?>
		
	</div>
	
	<h3>Make a review<a href="viewreview.php">view reviews</a></h3>
    <div id = 'comment'>
        <form action="jonesysreviews.php" method ='POST'>
            <label for="title">Title:</label>
            <input type="text" name="title" required>
            
            <p>Comment:</p>
            <textarea name="comment" id="" cols="25" rows="5"></textarea>

            <button type="submit" id="submit" name ='command' value ='submit_review'>Submit Review</button>
            

        </form>
    </div>
		
    
</body>
</html>