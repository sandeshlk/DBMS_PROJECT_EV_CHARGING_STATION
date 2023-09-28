<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD NEW STATION</title>
    <!-- Your CSS styles here -->
    
    
    <style>
    
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        font-size: 24px;
        text-align: center;
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="time"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    /* Popup Styles */
    .popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        padding: 20px;
        border-radius: 5px;
        z-index: 1000;
    }

    .popup-content {
        text-align: center;
        font-size: 18px;
    }
</style>

</head>
<body>
    <?php
    // Start or resume the session
    session_start();

    // Check if a user is logged in
    if (!isset($_SESSION['c_id'])) {
        header('Location: companylogin.php'); // Redirect to login page if not logged in
        exit;
    }

    // Initialize database connection
    $db = mysqli_connect('localhost', 'root', '', 'ev');

    // Check if the connection is successful
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Define variables to hold form data
    $c_id = $_SESSION['c_id'];
     $timing_open = $timing_close = $s_name = $address = $city = $state = $link = $cost_per_unit = $no_of_slots = $charger_type = $available_slots = $amenities = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Handle form submission
	
        // Retrieve all form fields
        $s_id = mysqli_real_escape_string($db, $_POST['s_id']);  // Assuming you have a way to set this value
        $timing_open = mysqli_real_escape_string($db, $_POST['timing_open']);
        $timing_close = mysqli_real_escape_string($db, $_POST['timing_close']);
        $s_name = mysqli_real_escape_string($db, $_POST['s_name']);
        $address = mysqli_real_escape_string($db, $_POST['address']);
        $city = mysqli_real_escape_string($db, $_POST['city']);
        $state = mysqli_real_escape_string($db, $_POST['state']);
        $link = mysqli_real_escape_string($db, $_POST['link']);
        $cost_per_unit = mysqli_real_escape_string($db, $_POST['cost_per_unit']);
        $no_of_slots = mysqli_real_escape_string($db, $_POST['no_of_slots']);
        $charger_type = mysqli_real_escape_string($db, $_POST['charger_type']);
        $available_slots = mysqli_real_escape_string($db, $_POST['available_slots']);
        $amenities = mysqli_real_escape_string($db, $_POST['amenities']);

        // Insert data into the 'station' table
     
     $s_id = isset($_POST['s_id']) ? (int)$_POST['s_id'] : null;

// Check if S_ID is a valid integer
if (!is_numeric($s_id)) {
    echo "";
} else {
       $query = "INSERT INTO station (S_ID, TIMING_OPEN, TIMING_CLOSE, S_NAME, C_ID) VALUES ($s_id, '$timing_open', '$timing_close', '$s_name', '$c_id')";
        if (mysqli_query($db, $query)) {
            // Insert data into the 'location' table
            $query = "INSERT INTO location (S_ID, ADDRESS, CITY, STATE, LINK) VALUES ('$s_id', '$address', '$city', '$state', '$link')";
            
            if (mysqli_query($db, $query)) {
                // Insert data into the 'feature' table
                $query = "INSERT INTO features (S_ID, COST_PER_UNIT, NO_OF_SLOTS, CHARGER_TYPE, AVAILABLE_SLOTS, AMENITIES) VALUES ('$s_id', '$cost_per_unit', '$no_of_slots', '$charger_type', '$available_slots', '$amenities')";
                
                if (mysqli_query($db, $query)) {
                    // Display a success message
                    echo '<div class="popup" id="successPopup">
                            <div class="popup-content">
                                Registration Successful!
                            </div>
                        </div>';
                } else {
                    echo "Error: " . $query . "<br>" . mysqli_error($db);
                }
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($db);
            }
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($db);
        }
    }}
    ?>

    <!-- Station, Location, and Feature Information Form -->
    <div class="container">
        <h1>ADD NEW STATION</h1>
        <form method="post" action="">
            <!-- Station Information -->
            <label for="s_id">Station ID:</label>
            <input type="text" id="s_id" name="s_id" required>

            <label for="timing_open">Timing Open:</label>
            <input type="time" id="timing_open" name="timing_open" required>

            <label for="timing_close">Timing Close:</label>
            <input type="time" id="timing_close" name="timing_close" required>

            <label for="s_name">Station Name:</label>
            <input type="text" id="s_name" name="s_name" required>

		
            <!-- Location Information -->
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="city">City:</label>
            <input type="text" id="city" name="city" required>

            <label for="state">State:</label>
            <input type="text" id="state" name="state" required>

            <label for="link">Link:</label>
            <input type="text" id="link" name="link" required>

            <!-- Feature Information -->
            <label for="cost_per_unit">Cost per Unit:</label>
            <input type="text" id="cost_per_unit" name="cost_per_unit" required>

            <label for="no_of_slots">Number of Slots:</label>
            <input type="text" id="no_of_slots" name="no_of_slots" required>

            <label for="charger_type">Charger Type:</label>
            <input type="text" id="charger_type" name="charger_type" required>

            <label for="available_slots">Available Slots:</label>
            <input type="text" id="available_slots" name="available_slots" required>

            <label for="amenities">Amenities:</label>
            <input type="text" id="amenities" name="amenities" required>

            <!-- Submit button to complete the registration -->
            <input type="submit" value="Submit">
        </form>
    </div>

    <!-- JavaScript to show the success popup -->
    <script>
        setTimeout(function() {
            document.getElementById('successPopup').style.display = 'block';
        }, 2000);
    </script>
</body>
</html>

