<?php



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user inputs (as shown in the previous answer)


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate user_name using regex (letters and numbers only)
        $user_name = $_POST["user_name"];
        if (!preg_match("/^[a-zA-Z0-9]{1,50}$/", $user_name)) {
            die("Invalid user name. It should contain letters and numbers only (up to 50 characters).");
        }

        // Validate user_password (minimum 6 characters)
        $user_password = $_POST["user_password"];
        if (strlen($user_password) < 6) {
            die("Password must be at least 6 characters long.");
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
        $ageRestriction = 0;
        if($age > 18){
            $ageRestriction = 1;
        }
        

        // Validate country (optional, letters and spaces only)
        $country = $_POST["country"];
        if (!empty($country) && !preg_match("/^[a-zA-Z\s]{1,20}$/", $country)) {
            die("Invalid country name. It should contain letters and spaces only (up to 20 characters).");
        }

        // If all data is valid, you can insert it into the database or perform other actions here.
        // Replace this section with your database insertion code.

        echo "provided data is valid". "<br>";
    }




    // Database connection information (modify as needed)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blog";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert user registration data into the 'user' table
    $sql = "INSERT INTO user (user_name, user_password, email, dob, age, ageRestriction, country)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing the SQL statement.");
    }

    // Bind the parameters
    $stmt->bind_param("ssssiii", $user_name, $user_password, $email, $dob, $age, $ageRestriction, $country);

    // Execute the statement
    if ($stmt->execute()) {
        // Registration successful, set a cookie and then redirect to a success page
        setcookie("user_info", json_encode($_POST), time() + 86000); // Store user info in a cookie
        header("Location: signUpContent.php");
        exit(); // Make sure to exit to prevent further script execution
    } else {
        echo "Error during registration: " . $stmt->error;
    }
    

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}

?>
