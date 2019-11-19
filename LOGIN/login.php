<?php

$user_name = $_POST['UserName'];
$Paswrd = $_POST['paswrd'];

if(!empty($user_name) || !empty ($Paswrd)){
    $host = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbname = 'OnlineQuizDB';
    
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    
    if (mysqli_connect_errno()){
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
        
    }else {
        //every user has uniique username
        $SELECT = "SELECT * from users where username = ? and Password = ? Limit 1";
        
        //prepare statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("ss", $user_name, $Paswrd);
        $stmt->execute();
        //$stmt->bind_result($Fname);
        $stmt->store_result();
        $rnum = $stmt->num_rows;
        
        if($rnum==1){
            
            //echo "new record inserted successfully";
            header('Location: /onlinequiz/homepage.html');
        }else{
            echo "Invalid credentials";
            echo $stmt->error;
            echo $user_name.' - '.$Paswrd;
        }
        $stmt->close();
        $conn->close();
    }
        
} else {
    
    echo "All fields are required!";
    die();
}
?>
