

<?php
    require('connect.php');
    $getID = filter_input(INPUT_GET, 'id',FILTER_VALIDATE_INT);
    if(!$getID and !is_int($getID))
    {
      header('Location: index.php');
    }
    $query = "SELECT * FROM reservation WHERE id = $getID";
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll();
?>

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

	<section>
		<form id="reservationform" action="process_post.php" method ="POST">
			<fieldset>
				<h3>Editing Current Reservation<a href="viewreservation.php">view reservation</a></h3>
				
				<div id="reservation">
					<ol>
						<li>
							<label for="date">Date:</label>
							<input type="date" name="date" id="date" value = <?=$results[0]['date']?>>
							<p class="dateError error" id="date_error">* Select a Date</p>
						</li>

						<li>
							<label for="name">Full Name:</label>
							<input type="text" name="name" id="name" value = <?=$results[0]['fullname']?> >
							<p class="name error" id="name_error">* Required</p>
						</li>

						<li>
							<label for="phone">Phone number:</label>
							<input type="text" name="phone" id="phone" value = <?=$results[0]['phone']?> >
							<p class="phone error" id="phone_error">* Required</p>
							<p class="phone error" id="phoneNumber_error">* Invalid Phone number</p>
						</li>

						<li>
							<label for="email">Email:</label>
							<input type="text" name="email" id="email" value = <?=$results[0]['email']?> >
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
							<textarea name = 'comments' id ="comments" rows="4" cols="50" ><?=$results[0]['comments']?></textarea>
						</li>
					</ol>
					<input type="hidden" name="id" value=<?= $results[0]['id']?> />
                    <input type="submit" name="command" value="Update" />
                    <input type="submit" name="command" value="Delete" onclick="return confirm('Are you sure you wish to delete this post?')" />    
				</div>
			</fieldset>
			
		</form>
	</section>
	<footer>
		<nav id = "footerNav">
			<ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="jonesysmenu.html">Menu</a></li>
				<li><a href="jonesysreservation.html">Reservation</a></li>
			</ul>
		</nav>
	</footer>
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