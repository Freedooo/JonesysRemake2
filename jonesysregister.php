<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Jonesy's Resturaunt + Lounge | Reservation</title>
	<link rel="stylesheet" type="text/css" href="jonesysreservation.css">
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
    
    <h3>Register for an account</h3>
    <div id = 'register'>
        <form action="process_post.php" method ='POST'>
            <label for="email">Enter an Email:</label>
            <input type="email" name="email" required>
            
            <label for="password">Enter a Password:</label>
            <input type="password" name="password" required>

            <label for="repassword">Re-enter password:</label>
            <input type="password" name="repassword" required>

            <button type="submit" id="submit" name ='command' value ='Register'>Create Account</button>

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