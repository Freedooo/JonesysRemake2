
<?php
    require('connect.php');

    $getID = filter_input(INPUT_GET, 'id',FILTER_VALIDATE_INT);
    
    if(!$getID and !is_int($getID))
    {
      header('Location: index.html');
    }

	$query = "SELECT * FROM reviews WHERE id = $getID ORDER BY date DESC LIMIT 1";
	$selectstatement = $db->prepare($query);
	$selectstatement->execute();
    $review = $selectstatement->fetchAll();
    
    $querySubcomment = "SELECT * FROM subcomment WHERE commentIDFK = $getID ";
	$selectSubcomment = $db->prepare($querySubcomment);
	$selectSubcomment->execute();
	$subcomments= $selectSubcomment->fetchAll();
    
    if($_POST)
    {
        
        $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $insertquery = "INSERT INTO subcomment (commentIDFK,comment) values (:commentIDFK,:comment)";
        $statement = $db->prepare($insertquery);
        
        $statement->bindValue(':commentIDFK', $getID);  
        $statement->bindValue(':comment', $comment); 

        $statement->execute();
        header("Location: fullcomment.php?id=$getID");
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="main.js"></script>
	<title>Jonesy's Resturaunt + Lounge | Full Comment</title>
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
    <section id = 'full_comment'>
				<h1>Title: <?=$review[0]['title']?></h1>
				<p>Comment:<?=$review[0]['comment']?> </p>
				<?php if(strlen($review[0]['image']) > 0) : ?>
				<img src="uploads\<?=$review[0]['image']?>" alt="<?=$review[0]['image']?>">
				<?php endif ?>
    </section>

    <div class = 'sub_comment'>
    <?php foreach($subcomments as $subcomment): ?>
        <p><?=$subcomment['comment']?></p>
        
    <?php endforeach ?>
    </div>
    <form action="fullcomment.php?id=<?=$review[0]['id'] ?>" method ='POST'>
		<p>Comment:</p>
		<p><textarea name="comment" id="" cols="25" rows="5"></textarea></p>
		<button type="submit" id="submit" name ='command' value ='submit_comment'>Comment</button>
	</form>
	

</body>
</html>