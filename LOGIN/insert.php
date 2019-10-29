<?php
$UserName = 
$_POST['Firstname'];
$Paswrd =
$_POST['LastName'];

$first_name = $_POST['Firstname'];
$last_name = $_POST['LastName'];
$csuid = $_POST['CSUID'];
$email = $_POST['EMAIL'];



if(!empty($UserName) || !empty ($Paswrd)){
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
        $SELECT = "SELECT Fname from users where Fname = ? Limit 1";
        $INSERT = "INSERT into users (Fname, Lname, CSUID, Email, Password) values (?,?,?,?,?)";
        
        echo "f: $first_name L: $last_name uid: $csuid e: $email p: $Paswrd";
        
        //prepare statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $Fname);
        $stmt->execute();
        $stmt->bind_result($Fname);
        $stmt->store_result();
        $rnum = $stmt->num_rows;
        
        if($rnum==0){
            
            $stmt->close();
            $insert = $conn->prepare($INSERT);
            $insert->bind_param("sssss", $first_name, $last_name, $csuid, $email, $Paswrd);
        
            $insert->execute();
            //echo "new record inserted successfully";
            header('Location: /onlinequiz/login.html');
        }else{
            echo "someone already registered using these credentials";
        }
        $insert->close();
        $conn->close();
    }
        
} else {
    
    echo "All fields are required!";
    die();
}
?>
