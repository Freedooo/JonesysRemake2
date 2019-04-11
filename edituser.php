
<?php
    require("connect.php");
    $getID = filter_input(INPUT_GET, 'id',FILTER_VALIDATE_INT);
    
    if(!$getID and !is_int($getID))
    {
      header('Location: index.html');
    }

    $query = "SELECT * FROM users WHERE id = $getID LIMIT 1";
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
    <title>Jonesy's Resturaunt + Lounge | Edit User</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="menu_review_comment.css">
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
			<li><a href="jonesysregister.php">Register</a></li>
			<li><a href="jonesyslogin.php">Log in</a></li>
			<li><a href="jonesyslogout.php">Log out</a></li>
		</ul>
	</nav>


    <div id = 'comment'>
		<h3>Editing User</h3>
		<form action="process_post.php" method ='POST'>
			<p>
				<label for="title">User Email:</label>
				<input type="text" name="email" value ="<?=$review[0]['email'] ?>" >
                <input type="hidden" name="id" value=<?= $review[0]['id']?> />
                <button type = 'submit' name = 'command' value = 'delete_user'>Delete User</button>
                <button type = 'submit' name = 'command' value = 'update_user'>Update User</button>

			</p>
		</form>
		
    </div>

		
</body>
<footer>
		<nav id = "footerNav">
		<ul>
			<li><a href="index.html">Home</a></li>
			<li><a href="jonesysmenu.php">Menu</a></li>
			<li><a href="jonesysreservation.php">Reservation</a></li>
			<li><a href="jonesysreviews.php">Reviews</a></li>
			<li><a href="jonesysregister.php">Register</a></li>
			<li><a href="jonesyslogin.php">Log in</a></li>
			<li><a href="jonesyslogout.php">Log out</a></li>
		</ul>
		</nav>
	</footer>
</html> 