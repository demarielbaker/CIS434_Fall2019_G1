<?php
$UserName = $_post['UserName'];
$Paswrd = $_post['Paswrd'];

if(!empty($UserName) || !empty ($Paswrd)){
    $host = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbname = 'OnlineQuizDB';
    
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    
    if (mysli_connect_error()){
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
        
    }else {
        //every user has uniique username
        //$SELECT = "SELECT UserName from users where UserName = ? Limit 1";
    }
        
} else {
    
    echo "All fields are required!";
    die();
}
?>
