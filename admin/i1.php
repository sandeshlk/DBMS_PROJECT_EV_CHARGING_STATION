<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            color: #3498db;
        }

        form {
            margin-top: 20px;
            text-align: left;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="tel"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        /* Popup styles */
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1;
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background-color: #3498db;
            padding: 20px;
            border-radius: 10px;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Company Registration</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Handle form submission
            $c_id = $_POST['c_id'];
            $phone = $_POST['phone'];
            $c_name = $_POST['c_name'];
            $c_email = $_POST['c_email'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Create a connection to your database
            $conn = mysqli_connect('localhost', 'root', '', 'ev');

            // Check if the connection is successful
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Insert data into your database table
            $sql = "INSERT INTO company (C_ID, C_CONTACT, C_NAME, C_EMAIL, username, password) VALUES ('$c_id', '$phone', '$c_name', '$c_email', '$username', '$password')";

            if (mysqli_query($conn, $sql)) {
                // Display a success message and show the popup
                echo '<div class="popup" id="successPopup">
                        <div class="popup-content">
                            Registration Successful!
                        </div>
                    </div>';
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            // Close the database connection
            mysqli_close($conn);
        }
        ?>
        <form method="post" action="">
            <label for="c_id">Company ID:</label>
            <input type="text" id="c_id" name="c_id" required>

            <label for="phone">Company Phone:</label>
            <input type="tel" id="phone" name="phone" required>

            <label for="c_name">Company Name:</label>
            <input type="text" id="c_name" name="c_name" required>

            <label for="c_email">Company Email:</label>
            <input type="email" id="c_email" name="c_email" required>

            <label for="username">Company User Name:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password for company:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Register">
        </form>
    </div>

    <script>
        // Show the success popup after a delay
        setTimeout(function() {
            document.getElementById('successPopup').style.display = 'block';
        }, 2000); // Adjust the time (in milliseconds) as needed
    </script>
</body>
</html>

