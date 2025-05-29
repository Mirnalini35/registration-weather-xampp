<?php
    $fullname=$_POST['fullname'];
    $dob=$_POST['dob'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $gender=$_POST['gender'];
    $address=$_POST ['address'];
    $password=$_POST['password'];
    $location=$_POST['location'];
    $weather = $_POST["weather"];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $conn= new mysqli('localhost','root','','googleform');
    if ($conn->connect_error) {
        die("connection failed :". $conn->connect_error);
    }else{
        $stmt= $conn->prepare("insert into details(fullname, dob, email, phone, gender, address,password,location, weather)values(?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisssss", $fullname, $dob, $email, $phone, $gender, $address, $password, $location, $weather);
        $stmt->execute();
        echo  "Thank you for registering";
        $stmt->close();
        $conn->close();
   }