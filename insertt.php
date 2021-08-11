<?php
$name = $_POST['name'];
$email = $_POST['email'];
$massage = $_POST['massage'];

if (!empty($name) || !empty($email) || !empty($massage)) {
    $host = "http://gachataz.atwebpages.com/"
    $dbUsername = "Admin";
    $dbPassword = "";
    $dbname = "3783642_sql"
    
    //create connection
    $conn = new mysql($host, $deUsername, $dbPassword, $dbname);
    
    if (mysqli_connect_error()) {
        die('Connect Error('. mysqli_connect_error().')'. mysqli_connect_error())
    } else {
        $SELECT = "SELECT email From contact Where email = ? Limit 1";
        $INSERT = "INSERT Into contact (name, email, massage) values(?, ?, ?)";
        
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $stmt->store_result();
     $stmt->fetch();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sss", $name, $email, $massage);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
    echo "All fields are required";
    die();
}
?>
