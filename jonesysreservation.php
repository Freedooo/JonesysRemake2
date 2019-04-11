
<?php
	include('connect.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Jonesy's Resturaunt + Lounge | Reservation</title>
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

	<section>
		<form id="reservationform" action="process_post.php" method ="POST">
			<fieldset>
				<h3>Make a reservation!<a href="viewreservation.php">view reservation</a></h3>
				
				<div id="reservation">
					<ol>
						<li>
							<label for="date">Date:</label>
							<input type="date" name="date" id="date">
							<p class="dateError error" id="date_error">* Select a Date</p>
						</li>

						<li>
							<label for="name">Full Name:</label>
							<input type="text" name="name" id="name" placeholder="ex) Glen Smith">
							<p class="name error" id="name_error">* Required</p>
						</li>

						<li>
							<label for="phone">Phone number:</label>
							<input type="text" name="phone" id="phone" placeholder="ex) 1-204-999-9999">
							<p class="phone error" id="phone_error">* Required</p>
							<p class="phone error" id="phoneNumber_error">* Invalid Phone number</p>
						</li>

						<li>
							<label for="email">Email:</label>
							<input type="text" name="email" id="email" placeholder="ex) example@domain.ca">
							<p class="email error" id="email_error">* Invalid Email</p>
						</li>

						<li>
							<label for="section">Section?</label>
							<select id="section" name = "section">
								<option value = 'dining_room'>Dining Room</option>
								<option value = 'lounge'>Lounge</option>
								
							</select>
						</li>

						<li>
							<label for="comments">Extra comments</label>
							<textarea name = 'comments' id ="comments" rows="4" cols="50"></textarea>
						</li>
						<li>
							<img src="captcha.php" alt = "Captcha Img"/><input type="text" name="captcha">
						</li>
					</ol>
					<button type="submit" id="submit" name ='command' value ='Create'>Reserve a table</button>
					<button type="reset" id="clear">Reset</button>
				</div>
			</fieldset>
			
		</form>
	</section>
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
</body>

</html>