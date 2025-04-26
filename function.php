<?php
date_default_timezone_set('Africa/Dar_es_Salaam');
$date = date('Y-m-d') . "\n"; // Current date
// echo $day = date('l') . "\n"; // Current day of the week
// echo $dayNum = date('d') . "\n"; // Current day of the month
// echo $month = date('F') . "\n"; // Current month
$time = date('H:i:s A');// Current time in 12-hour format
// echo $time24 = date('H:i:s');// Current time in 24-hour format

require "database.php";

$db = new Database(); // Create a new instance of the Database class


if(isset($_POST['action']) && $_POST['action'] != ''){ // Check if the action is set and not empty
    
    // Function to handle save action start here

    if($_POST['action'] == 'save_staff'){
      $output = "";
      $first_name = $db->conn->real_escape_string($_POST['first_name']);
      $middle_name = $db->conn->real_escape_string($_POST['middle_name']);
      $last_name = $db->conn->real_escape_string($_POST['last_name']);
      $location = $db->conn->real_escape_string($_POST['location']);
      $email = $db->conn->real_escape_string($_POST['email']);
      $phone_number = $db->conn->real_escape_string($_POST['phone_number']);
      $gender = $db->conn->real_escape_string($_POST['gender']);
      $position = $db->conn->real_escape_string($_POST['position']);
      $dob = $db->conn->real_escape_string($_POST['dob']);
      $today = date('Y-m-d');
      $diff = date_diff(date_create($dob), date_create($today));
      $age = $diff->format('%Y');
      if(empty($first_name) || empty($middle_name) || empty($last_name) || empty($location) || empty($email) || empty($phone_number) || empty($gender) || empty($position) || empty($dob)){
        $output = 'Empty';
      }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $output = 'Invalid email';
      }else if($age < 18){
        $output = 'Under age';
      }else{
        $db->alldata('staff',"WHERE email='$email'");
      }

    }
    // Function to handle save action end here

    // Function to handle update action start here

    // Function to handle update action end here

    // Function to handle view action start here

    // Function to handle view action end here

    // Function to handle delete action start here

    // Function to handle delete action end here
}