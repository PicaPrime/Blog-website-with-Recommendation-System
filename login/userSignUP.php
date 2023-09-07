<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate user_name using regex (letters and numbers only)
    $user_name = $_POST["user_name"];
    if (!preg_match("/^[a-zA-Z0-9]{1,50}$/", $user_name)) {
        die("Invalid user name. It should contain letters and numbers only (up to 50 characters).");
    }

    // Validate user_password (minimum 6 characters)
    $user_password = $_POST["user_password"];

    // Define the regex pattern for password validation
    $pattern = '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/';

    if (!preg_match($pattern, $user_password)) {
        die("Password must be at least 6 characters long and contain at least one uppercase letter, one lowercase letter, one digit, and one special character (@$!%*#?&).");
    }


    // Validate email using regex
    $email = $_POST["email"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Validate date of birth (optional)
    $dob = $_POST["dob"];
    if (!empty($dob) && !preg_match("/^\d{4}-\d{2}-\d{2}$/", $dob)) {
        die("Invalid date of birth format. Use YYYY-MM-DD.");
    }

    $age = 0;

    // Calculate age based on the DOB

    $today = new DateTime();
    $birthdate = new DateTime($dob);
    $age = $today->diff($birthdate)->y; // Calculate the difference in years

    // Validate ageRestriction (0 or 1)
    $ageRestriction = 1;
    if ($age > 18) {
        $ageRestriction = 0;
    }

    $selectedCountry = $_POST['country'];

    $country = $selectedCountry;

    require_once('dbConnection.php');

    // Insert user registration data into the 'user' table
    $sql = "INSERT INTO user (user_name, user_password, email, dob, age, ageRestriction, country)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing the SQL statement.");
    }

    // Bind the parameters
    $stmt->bind_param("ssssiis", $user_name, $user_password, $email, $dob, $age, $ageRestriction, $country);

    // Execute the statement
    if ($stmt->execute()) {
        $cookie_name = "user_id";
        $cookie_value = $user_id;
        $cookie_expiration = time() + (86400 * 30); 
        // $cookie_path = "/";

        setcookie($cookie_name, $cookie_value, $cookie_expiration);
        header("Location: selectTags.php");
        exit(); // Make sure to exit to prevent further script execution
    } else {
        echo "Error during registration: " . $stmt->error;
    }


    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
