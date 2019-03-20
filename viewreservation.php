

<?php
    require('authenticate.php');
    include('connect.php');
    $query = "SELECT * FROM reservation";
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll();
    //var_dump($results[0]['fullname']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Jonesy's Resturaunt + Lounge | Reservation</title>
	<link rel="stylesheet" type="text/css" href="jonesysreservation.css">
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
    
    <table style = "color:white;">
        <tr>
            <th>Date</th>
            <th>Full Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Section</th>
            <th>Comments</th>
            <th>Option</th>
        </tr>
        <?php foreach($results as $result): ?>
            <tr>
                <td><?=$result['date']?></td>
                <td><?=$result['fullname']?></td>
                <td><?=$result['phone']?></td>
                <td><?=$result['email']?></td>
                <td><?=$result['section']?></td>
                <td><?=$result['comments']?></td>
                <td><a href="editreservation.php?id=<?=$result['id'] ?>">edit</a></td>
            </tr>
        <?php endforeach ?>
    </table>

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

</html>