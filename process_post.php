
<?php
    include('connect.php');
    
    if($_POST['command'] = "Create")
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
?>