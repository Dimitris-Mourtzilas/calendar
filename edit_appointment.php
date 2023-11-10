<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information Edit | Calendar App</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        table {
            width: 80%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 5px;
            box-sizing: border-box;
        }

        a {
            text-align: center;
            color: #4CAF50;
            text-decoration: none;
            margin-top: 20px;
        }

        a:hover {
            color: #45a049;
        }
    </style>
    <script>
        // Function to make AJAX request and update the table
        $(document).ready(function() {
            // Get the app_id from the session

            // Function to make AJAX request and update the table
            function updateTable() {
                $.ajax({
                    url: 'appointment_info_handler.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Update the input fields with the received data
                        $('#descriptionInput').val(response.description);
                        $('#dateInput').val(response.date);
                        $('#guestInput').val(response.email);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }

            // Call the updateTable function when the page is ready
            updateTable();
        });
    </script>
</head>
<body>
<table class="table">
    <thead>
    <tr>
        <th>Description</th>
        <th>Date</th>
        <th>Guest</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><input type="text" id="descriptionInput" readonly></td>
        <td><input type="text" id="dateInput" readonly></td>
        <td><input type="text" id="guestInput" readonly></td>
    </tr>
    </tbody>
</table>
<a href="appointments.html">Back</a>
</body>
</html>
