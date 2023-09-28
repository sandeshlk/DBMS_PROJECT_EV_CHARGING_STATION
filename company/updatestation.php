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

// Initialize station data variables
$s_id = "";
$s_name = "";
$timing_open = "";
$timing_close = "";
$address="";
$state="";
$city="";
$link="";
$cost_per_unit="";
$no_of_slots="";
$charger_type="";
$available_slots="";
$amenities="";

// Check if an update is requested
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['station_id'])) {
    // Retrieve station ID from the form
    $s_id = mysqli_real_escape_string($db, $_POST['station_id']);
    
    // Fetch existing station data for pre-filling the form
    $query = "SELECT * FROM station WHERE S_ID = '$s_id' AND C_ID = '$c_id'";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Retrieve updated form fields
        $s_id = $row['S_ID'];
        $s_name = $row['S_NAME'];
        $timing_open = $row['TIMING_OPEN'];
        $timing_close = $row['TIMING_CLOSE'];
    } else {
        // Handle the case where the station with the given ID doesn't exist
        // You can redirect or display an error message
        echo "Station with ID $s_id does not exist or does not belong to your company.";
    }
}

// Handle the form submission for station update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Retrieve updated form fields
    $s_id = mysqli_real_escape_string($db, $_POST['s_id']);
    $s_name = mysqli_real_escape_string($db, $_POST['s_name']);
    $timing_open = mysqli_real_escape_string($db, $_POST['timing_open']);
    $timing_close = mysqli_real_escape_string($db, $_POST['timing_close']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
        $city = mysqli_real_escape_string($db, $_POST['city']);
        $state = mysqli_real_escape_string($db, $_POST['state']);
        $link = mysqli_real_escape_string($db, $_POST['link']);
        $cost_per_unit = mysqli_real_escape_string($db, $_POST['cost_per_unit']);
        $no_of_slots = mysqli_real_escape_string($db, $_POST['no_of_slots']);
        $charger_type = mysqli_real_escape_string($db, $_POST['charger_type']);
        $available_slots = mysqli_real_escape_string($db, $_POST['available_slots']);
        $amenities = mysqli_real_escape_string($db, $_POST['amenities']);
    
    // Construct the UPDATE query
    $update_query = "UPDATE station 
                     SET S_NAME='$s_name', TIMING_OPEN='$timing_open', TIMING_CLOSE='$timing_close'
                     WHERE S_ID='$s_id' AND C_ID='$c_id'";

   if (mysqli_query($db, $update_query)) {
            // Insert data into the 'location' table
            $query = "UPDATE location 
                         SET ADDRESS='$address', CITY='$city', STATE='$state', LINK='$link'
                         WHERE S_ID='$s_id'";
            
            if (mysqli_query($db, $query)) {
                // Insert data into the 'feature' table
                $query =  "UPDATE features 
                         SET COST_PER_UNIT='$cost_per_unit', NO_OF_SLOTS='$no_of_slots', CHARGER_TYPE='$charger_type', AVAILABLE_SLOTS='$available_slots', AMENITIES='$amenities'
                         WHERE S_ID='$s_id'";
                
                if (mysqli_query($db, $query)) {
                    // Display a success message
                    echo '<div class="popup" id="successPopup">
                            <div class="popup-content">
                                Updation Successful!
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
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Station</title>
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
    <h1>UPDATE STATION</h1>
      <div class="container">
    <form method="post" action="">
        <!-- Station Information -->
        <label for="s_id">Station ID:</label>
        <input type="text" id="s_id" name="s_id" value="<?php echo $s_id; ?>" readonly>

        <label for="s_name">Station Name:</label>
        <input type="text" id="s_name" name="s_name" value="<?php echo $s_name; ?>" required>

        <label for="timing_open">Timing Open:</label>
        <input type="time" id="timing_open" name="timing_open" value="<?php echo $timing_open; ?>" required>

        <label for="timing_close">Timing Close:</label>
        <input type="time" id="timing_close" name="timing_close" value="<?php echo $timing_close; ?>" required>
        
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


        <!-- ... Add other form fields here ... -->
        

        <!-- Submit button to complete the update -->
        <input type="submit" name="update" value="Update">
    </form>
    </div>
    <div class="popup" id="successPopup">
        <div class="popup-content">
            Successfully Updated!
        </div>
    </div>

    <!-- Add this updated JavaScript code just before the closing </body> tag -->
<script>
    // JavaScript to show the success popup after 0.5 seconds
    document.addEventListener("DOMContentLoaded", function() {
        setTimeout(function() {
            document.getElementById('successPopup').style.display = 'block';
        }, 500); // Show the popup after 0.5 seconds

        // JavaScript to hide the success popup after 2 seconds
        setTimeout(function() {
            document.getElementById('successPopup').style.display = 'none';
        }, 2500); // Hide the popup after 2 seconds
    });
</script>

</body>
</html>

