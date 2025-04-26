<?php  
session_start(); // Start the session

// PHPMYADMIN CONFIGURATION

use PHPMailer\PHPMailer\PHPMailer; // Import the PHPMailer class
use PHPMailer\PHPMailer\Exception; // Import the Exception class
use PHPMailer\PHPMailer\SMTP; // Import the SMTP class

require 'vendor/autoload.php'; // Load the PHPMailer library

define('USERNAME','khamiskaka199848@gmail.com'); // Define the username for SMTP authentication
define('PASSWORD','khamis1998'); // Define the password for SMTP authentication
define('EMAILFROM','khamiskaka199848@gmail.com'); // Define the email address to send from
define('EMAILFROMNAME','Khamis Kaka'); // Define the name to send from
define('HOST','smtp.gmail.com'); // Define the SMTP host
define('PORT',587); // Define the SMTP port
define('SECURE','tls'); // Define the SMTP security type
define('SMTPAUTH',true); // Define whether to use SMTP authentication
define('SMTPDEBUG',0); // Define the SMTP debug level

// Connection Class

class Database { // Database class
    public $conn; // Database connection variable
// Database connection parameters
    public $host = 'localhost'; // Database host
    public $user = 'root'; // Database user
    public $password = ''; // Database password 
    public $dbname = 'test'; // Database name

    public function __construct() { // Constructor function
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname); // Create a new database connection

        if ($this->conn->connect_error) { // Check for connection error
            die("Connection failed: " . $this->conn->connect_error); // Display error message
        }else{
            return $this->conn; // Return the connection object
        }
    }

    public function insert($table, $data) { // Function to insert a record into a table
        $columns = implode(", ", array_keys($data)); // Get the column names from the data array
        $values = implode("', '", array_values($data)); // Get the values from the data array

        foreach ($data as $key => $value) { // Loop through the data array
            $k[] = $key; // Store the keys in an array
            $v[] = "'$value'"; // Store the values in an array
        }
        $keys = implode(", ", $k); // Convert the keys array to a string
            $values = implode(", ", $v); // Convert the values array to a string

            $sql = "INSERT INTO $table ($keys) VALUES ($values)"; // Create the SQL insert query

            $query = $this->conn->query($sql); // Execute the query
            if ($query) { // Check if the query was successful
                echo json_encode('Successful'); // Set a session message for successful insert
                // return true; // Return true on success
            } else {
                echo json_encode('Failed'); // Set a session message for failed insert
                // echo "Error: " . $sql . "<br>" . $this->conn->error; // Display error message
                // return false; // Return false on failure
            }
       
    }

    public function update($table, $data, $where) { // Function to update a record in a table
        foreach ($data as $key => $value) { // Loop through the data array
            $value = "'$value'"; // Add quotes around the value
            $dat[] = $key . "=" . $value; // Create the key-value pair

        }
        $update = implode(", ", $dat); // Convert the array to a string
        $sql = "UPDATE $table SET $update WHERE $where"; // Create the SQL update query
        $query = $this->conn->query($sql); // Execute the query
        if ($query) { // Check if the query was successful
            // return true; // Return true on success
            echo json_encode('Successful'); // Set a session message for successful update
        } else {
            // return false; // Return false on failure
            echo json_encode('Failed'); // Set a session message for failed update
        }
    }

    public function delete($table, $where) { // Function to delete a record from a table
        $sql = "DELETE FROM $table WHERE $where"; // Create the SQL delete query
        $query = $this->conn->query($sql); // Execute the query
        if ($query) { // Check if the query was successful
            // return true; // Return true on success
            echo json_encode('Successful'); // Set a session message for successful delete
        } else {
            // return false; // Return false on failure
            echo json_encode('Failed'); // Set a session message for failed delete
        }
    }
        
    public function alldata($table, $where) { // Function to get all data from a table
        $sql = "SELECT * FROM $table $where"; // Create the SQL select query
        $query = $this->conn->query($sql); // Execute the query
        if($query->num_rows > 0) { // Check if there are results
            return $query; // Return the query result
        } else {
            return []; // Return an empty array if no results found
        }
    }
    public function send_email($to,$from,$fromname,$subject,$message) { // Function to send email
        $headers = "From: $from\r\n"; // Set the email headers
        $headers .= "Reply-To: $from\r\n"; // Set the reply-to header

        $mail = new PHPMailer(); // Create a new PHPMailer instance
        try {
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = HOST; // Set the SMTP host
            $mail->SMTPAuth = SMTPAUTH; // Enable SMTP authentication
            $mail->Username = USERNAME; // SMTP username
            $mail->Password = PASSWORD; // SMTP password
            $mail->SMTPSecure = SECURE; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = PORT; // TCP port to connect to
            $mail->SMTPDebug = SMTPDEBUG; // Set the SMTP debug level
            $mail->setFrom($from, $fromname); // Set the sender's email address and name
            $mail->addAddress($to); // Add a recipient

            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $subject; // Set the email subject
            $mail->Body    = $message; // Set the email body
            $mail->SMTPOptions = array( // Set SMTP options
                'tls' => array(
                    'verify_peer' => false, // Disable peer verification
                    'verify_peer_name' => false, // Disable peer name verification
                    'allow_self_signed' => false // Allow self-signed certificates
                )
            );
            if ($mail->send()) { // Send the email and check for success
                return $mail; // Return true on success
            } else {
                // return false; // Return false on failure
                echo json_encode('Mailer Error: ' . $mail->ErrorInfo); // Display error message
            }
        } catch (Exception $e) {
            echo json_encode('Error : '. $e->getMessage()); // Display error message
            // return false; // Return false on exception
        }
    } 

    public function make_avatar($name){ // Function to create an avatar image
        $path = 'avaratar/'.time().'.png'; // Set the path for the avatar images
        $image = imagecreate(200, 200); // Create a new image with specified dimensions
        $red = rand(0, 255); // Generate a random red value
        $green = rand(0, 255); // Generate a random green value
        $blue = rand(0, 255); // Generate a random blue value
        $color = imagecolorallocate($image, $red, $green, $blue); // Allocate a color for the image
        $text_color = imagecolorallocate($image, 255, 255, 255); // Allocate a text color for the image
        imagettftext($image, 20, 0, 50, 100, $text_color, 'fonts/arial.ttf', $name); // Add text to the image
        imagepng($image, $path); // Save the image as a PNG file

        header('Content-Type: image/png'); // Set the content type header for PNG images
        imagedestroy($image); // Destroy the image resource to free up memory
        return $path; // Return the path to the saved image
    }

    public function verify($table, $token, $email) { // Verify function
        $sql = "SELECT * FROM $table WHERE token='$token' AND email='$email'"; // Create the SQL select query
        $query = $this->conn->query($sql); // Execute the query
        if ($query->num_rows > 0) { // Check if there are results
            $row = $query->fetch_assoc(); // Fetch the result as an associative array
            $staff_id = $row['staff_id']; // Get the staff ID from the result
            if($row['email'] == $email AND $row['token'] == $token AND $row['is_verified'] == 0) { // Check if the email matches and the token is valid and not verified
                $data = [
                    'token' => '', // Set the token to an empty string
                    'is_verified' => 1 // Set the is_verified flag to 1
                ];
                $this->update($table, $data, "WHERE staff_id='$staff_id'"); // Update the record in the database
                echo json_encode('Successfully'); // Set a session message for successful verification
                
            } elseif($row['email'] == $email AND $row['token'] == $token AND $row['is_verified'] == 1) { // Check if the email matches and the token is valid and already verified
                echo json_encode('Email already verified'); // Set a session message for already verified email
            }
        } else {
            echo json_encode('Invalid token'); // Set a session message for invalid token
        }
    }

    public function login($table, $username, $password) { // Login function
        $sql = "SELECT * FROM $table INNER JOIN position WHERE email='$username' OR username='$username' AND password='$password' AND status=1"; // Create the SQL select query
        $query = $this->conn->query($sql); // Execute the query
        if ($query->num_rows > 0) { // Check if there are results
            $row = $query->fetch_assoc(); // Fetch the result as an associative array
            $pass = base64_decode($password); // Decode the password
            $name = $row['staff_name']; // Get the staff name from the result
            $single_name = explode(' ', $name); // Split the name into an array

            if($row['password'] == $password){ // Check if the password matches
                if($single_name[2] == $pass){
                    $_SESSION['recipe_first_password'] = 1; // Set a session variable for first password
                    $_SESSION['recipe_name'] = $row['staff_name']; // Set the staff name in the session
                    $_SESSION['recipe_id'] = $row['staff_id']; // Set the staff ID in the session
                    $id = $row['staff_id']; // Get the staff ID from the result
                    $data = [
                        'is_login' => 1 // Set the is_login flag to 1
                    ];
                    $this->update('staff', $data, "WHERE staff_id='$id'"); // Update the record in the database
                    echo json_encode('Recipe First Password'); // Set a session message for first password
                }elseif($row['status']==0){
                    echo json_encode('Account not activated'); // Set a session message for account not activated
                }elseif($row['status']==2){
                    echo json_encode('Account suspended'); // Set a session message for account suspended
                }elseif($row['status']==3){
                    echo json_encode('Account Deleted'); // Set a session message for account deleted    
                }elseif($row['status']==1){
                    if($row['is_verified'] == 0) { // Check if the account is not verified
                        echo json_encode('Account not verified'); // Set a session message for account not verified
                    }elseif(($row['is_verified'] == 1) && ($row['password'] == $password)) { // Check if the account is verified and the password matches
                        if(!empty($_POST['remember'])) { // Check if the remember me checkbox is checked
                            $cookie_time = time() + (86400 * 30); // Set the cookie expiration time to 30 days
                            $cookie_time_onset = $cookie_time + time(); // Set the cookie time on set
                            $escpassword = $this->conn->real_escape_string($_POST['password']); // Escape the password for security
                            setcookie('recipe_username', $username, $cookie_time_onset); // Set a cookie for the username
                            setcookie('recipe_password', $escpassword, $cookie_time_onset); // Set a cookie for the password
                        } else {
                            if(isset($_COOKIE['recipe_username'])) { // Check if the cookie for username is set
                                unset($_COOKIE['recipe_username']); // Unset the cookie for username
                            }
                            if(isset($_COOKIE['recipe_password'])) { // Check if the cookie for password is set
                                unset($_COOKIE['recipe_password']); // Unset the cookie for password
                            }
                        }
                        $name = explode(' ', $row['staff_name']); // Split the name into an array
                        $_SESSION['recipe_login'] = 1; // Set a session variable for login
                        $_SESSION['recipe_name'] = $name[0].' '.$name[2]; // Set the staff name in the session
                        $_SESSION['recipe_id'] = $row['staff_id']; // Set the staff ID in the session
                        $id = $row['staff_id']; // Get the staff ID from the result
                        $data = [
                            'is_login' => 1 // Set the is_login flag to 1
                        ];
                        $this->update('staff', $data, "WHERE staff_id='$id'"); // Update the record in the database
                        echo json_encode('Login successful'); // Set a session message for successful login
                }
            }
            
        } else {
            echo json_encode('Invalid Password'); // Set a session message for invalid password
        }
    }else{
        echo json_encode('Invalid username or password'); // Set a session message for invalid username or password
    }
}
    public function logout() { // Logout function
        session_destroy(); // Destroy the session
        session_unset(); // Unset all session variables
        header('Location: login.php'); // Redirect to the login page
    }

    public function close() {// Close the database connection
        $this->conn->close(); // Close the database connection
    }
}

