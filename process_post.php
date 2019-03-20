
<?php
    include('connect.php');
    $message = false;

    if($_POST['command'] == "Create")
    {
        $date = $_POST['date'];
        $fullname = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $section = filter_input(INPUT_POST, 'section', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $comments = filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        

        $insertQuery = "INSERT INTO reservation (date,fullname,phone,email,section,comments) values (:date,:fullname,:phone,:email,:section,:comments)";
        $statement = $db->prepare($insertQuery);
        
        $statement->bindValue(':date', $date);  
        $statement->bindValue(':fullname', $fullname);  
        $statement->bindValue(':phone', $phone);  
        $statement->bindValue(':email', $email);  
        $statement->bindValue(':section', $section); 
        $statement->bindValue(':comments', $comments); 
        $statement->execute(); 
            

        header('Location: index.html');
        exit();
        
    }
    if($_POST['command']=='Update')
    {
        $date = $_POST['date'];
        $fullname = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $section = filter_input(INPUT_POST, 'section', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $comments = filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        
        
        $updateQuery = "UPDATE reservation SET date = :date, fullname = :fullname,phone = :phone,email = :email,section = :section,comments = :comments WHERE id = :id";
        $statement = $db->prepare($updateQuery);
        $statement->bindValue(':date', $date);  
        $statement->bindValue(':fullname', $fullname);  
        $statement->bindValue(':phone', $phone);  
        $statement->bindValue(':email', $email);  
        $statement->bindValue(':section', $section); 
        $statement->bindValue(':comments', $comments); 
        $statement->bindValue(':id',$id, PDO::PARAM_INT);
        $statement->execute(); 
        header('Location: viewreservation.php');
        exit();
    }
    if($_POST['command'] =='Delete')
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $query = "DELETE FROM reservation WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        header('Location: viewreservation.php');
        exit();
    }

    if($_POST['command'] =='Register')
    {
        

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $repassword = filter_input(INPUT_POST, 'repassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if($password == $repassword)
        {
            $hashed_password = password_hash($password,PASSWORD_DEFAULT);


            $insertQuery = "INSERT INTO users (email,password) values (:email,:hashed_password)";
            $statement = $db->prepare($insertQuery);
            $statement->bindValue(':email', $email);  
            $statement->bindValue(':hashed_password', $hashed_password);  
            $statement->execute(); 

            $message = "Account Created Successfully";
        }
        else
        {
            $message = "Your passwords dont match, please <a href='jonesysregister.php'>try again</a>";
        }
    }

    if($_POST['command'] =='login')
    {
        if(isset($_POST['email']) and isset($_POST['password']))
        {
            $userEmail = $_POST['email'];
            $userPassword = $_POST['password'];

            $query = "SELECT email,password FROM users WHERE email = :email LIMIT 1";
            $statement = $db->prepare($query);
            $statement->bindValue(':email', $userEmail);
            $statement->execute();
            $users = $statement->fetchall();

            if(password_verify($userPassword,$users[0]['password']))
            {  
                $message = "You have logged in successfully";
            }
            else
            {
                $message = "Incorrect Email or Password";
            }
        }

    }
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
    <?php if($message): ?>
    <div>
        <h3><?=$message?></h3>
    </div>
    <?php endif ?>
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
