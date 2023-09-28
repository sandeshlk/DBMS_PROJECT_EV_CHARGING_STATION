<!DOCTYPE html>
<html>

<head>
    <title>Update Reservation</title>
    <style>
    
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 20px auto;
            max-width: 400px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        label {
            width: 150px; /* Adjusted label width */
            margin-right: 10px;
            text-align: right;
        }

        input[type="text"] {
            width: 100%;
            height: 30px;
            padding: 5px 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="button"],
        input[type="submit"] {
            width: 100%;
            height: 40px;
            margin: 10px 0;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="button"]:hover,
        input[type="submit"]:hover {
            background-color: #46a049;
        }
    </style>
</head>

<body>
    <?php
    // ... PHP code remains the same ...
    ?>

    <form method="post">
        <label for="res_id" style="text-align: center;">Reservation ID</label>
        <input type="text" name="res_id" id="res_id" required>

        <label for="st_id" style="text-align: center;">Station ID</label>
        <input type="text" name="st_id" id="st_id" required>

        <label for="comp_id" style="text-align: center;">Company ID</label>
        <input type="text" name="comp_id" id="comp_id" required>

        <label for="user_id" style="text-align: center;">User ID</label>
        <input type="text" name="user_id" id="user_id" required>

        <label for="units_consumed" style="text-align: center;">Units Consumed</label>
        <input type="text" name="units_consumed" id="units_consumed" required>

        <label for="cost_per_unit" style="text-align: center;">Cost per Unit</label>
        <input type="text" name="cost_per_unit" id="cost_per_unit" required>

        <label for="total_cost" style="text-align: center;">Total Cost</label>
        <input type="text" name="total_cost" id="total_cost" disabled>

        <input type="button" value="Calculate" style="background-color: #3498db; border: none; color: white; padding: 8px 20px; cursor: pointer; border-radius: 20px; text-decoration: none; transition: background-color 0.3s ease;" name="calculate" onClick="calculateTotal()">

       <label for="payment" style="text-align: center;">Payment</label>
        <input type="text" name="payment" id="payment" required>

        <input type="submit" value="Update" style="background-color: #3498db; border: none; color: white; padding: 8px 20px; cursor: pointer; border-radius: 20px; text-decoration: none; transition: background-color 0.3s ease;" name="update">

    </form>

    <script>
        function calculateTotal() {
            const unitsConsumed = parseFloat(document.getElementById("units_consumed").value);
            const costPerUnit = parseFloat(document.getElementById("cost_per_unit").value);

            if (!isNaN(unitsConsumed) && !isNaN(costPerUnit)) {
                const totalCost = unitsConsumed * costPerUnit;
                document.getElementById("total_cost").value = totalCost.toFixed(2);
            }
        }
    </script>
</body>

</html>

