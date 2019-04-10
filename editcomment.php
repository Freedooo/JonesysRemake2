
<?php
    require("connect.php");
    $getID = filter_input(INPUT_GET, 'id',FILTER_VALIDATE_INT);
    
    if(!$getID and !is_int($getID))
    {
      header('Location: index.html');
    }

    $query = "SELECT * FROM reviews WHERE id = $getID ORDER BY date DESC LIMIT 1";
	$selectstatement = $db->prepare($query);
	$selectstatement->execute();
    $review = $selectstatement->fetchAll();

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


    <div id = 'comment'>
		<h3>Editing Current Review</h3>
		<form action="process_post.php" method ='POST'>
			<p>
				<label for="title">Title:</label>
				<input type="text" name="title" value ="<?=$review[0]['title'] ?>" >
			</p>
			<p>Comment:</p>
			<p><textarea name="comment" id="" cols="25" rows="5"><?=$review[0]['comment'] ?></textarea></p>
            <input type="hidden" name="id" value=<?= $review[0]['id']?> />
            <button type = 'submit' name = 'command' value = 'delete_comment'>Delete</button>
		</form>
		
    </div>

		
</body>
</html> 