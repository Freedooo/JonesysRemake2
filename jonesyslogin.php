







<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Jonesy's Resturaunt + Lounge | Login</title>
	<link rel="stylesheet" type="text/css" href="reservation_register_login_users.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<script src="jonesys.js" type="text/javascript"></script>
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
    
    <h3>Sign in</h3>
    <div id = 'login'>
        <form action="process_post.php" method ='POST'>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit" id="submit" name ='command' value ='login'>Login</button>
            

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