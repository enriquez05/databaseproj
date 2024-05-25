<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0; /* Light Gray */
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .navbar {
            display: flex;
            justify-content: center;
            width: 100%;
            padding: 20px 0;
        }

        .navbar a {
            margin: 0 15px;
            padding: 14px 20px;
            text-decoration: none;
            font-weight: bold;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .navbar a:nth-child(1) {
            background-color: #FF6F61; /* Coral */
        }

        .navbar a:nth-child(2) {
            background-color: #6B5B95; /* Amethyst */
        }

        .navbar a:nth-child(3) {
            background-color: #88B04B; /* Moss Green */
        }

        .navbar a:nth-child(4) {
            background-color: #DE3163; /* Peach Pink */
        }

        .navbar a:hover {
            transform: translateY(-2px);
            opacity: 0.8;
        }

        .container {
            padding: 40px;
            max-width: 1200px;
            margin: auto;
            width: 100%;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
            color: #333;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #fafafa;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        table tr td a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }

        table tr td a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        h2 {
            margin-top: 10px;
            color: #333;
        }

        form {
            background-color: #f9f9f9; /* Light Gray */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            max-width: 100%;
            width: 100%;
        }

        form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        form input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        form input[type="submit"] {
            background-color: #6B5B95; /* Amethyst */
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        form input[type="submit"]:hover {
            background-color: #554478; /* Darker Amethyst */
        }
    </style>
</head>

<body>

    <div class="navbar">
        <a href="employee.php">Employee</a>
        <a href="department.php">Department</a>
        <a href="assignment.php">Assignment</a>
        <a href="project.php">Project</a>
    </div>

    <div class="container">
        <?php
        require 'config/db.php';

        // Handle deletion
        if (isset($_GET['deleteid'])) {
            $id = intval($_GET['deleteid']);
            $deleteQuery = "DELETE FROM employee WHERE EmployeeID = '$id'";
            if (mysqli_query($conn, $deleteQuery)) {
                echo '<script>alert("Employee deleted successfully!");</script>';
            } else {
                echo '<script>alert("Error: ' . $deleteQuery . '<br>' . mysqli_error($conn) . '");</script>';
            }
            // header('Location:employee.php');
            // exit();
        }
        ?>

        <h2>Employee Form</h2>

        <table>
            <thead>
                <tr>
                    <th>EmployeeID</th>
                    <th>LastName</th>
                    <th>FirstName</th>
                    <th>DepartmentID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $employeeQuery = "SELECT * FROM employee";
                $result = mysqli_query($conn, $employeeQuery) or die('error');

                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['EmployeeID']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['LastName']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['FirstName']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['DepartmentID']) . '</td>';
                    echo '<td><a class="action-link" href="employee.php?deleteid=' . urlencode($row['EmployeeID']) . '">Delete</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <form action="insert.php" method="post">
            <label for="EmployeeID">Employee ID:</label>
            <input type="text" id="EmployeeID" name="EmployeeID" required>
            <label for="LastName">Last Name:</label>
            <input type="text" id="LastName" name="LastName" required>
            <label for="FirstName">First Name:</label>
            <input type="text" id="FirstName" name="FirstName" required>
            <label for="DepartmentID">Department ID:</label>
            <input type="text" id="DepartmentID" name="DepartmentID" required>
            <input type="submit" name="submit_employee" value="Submit">
        </form>
    </div>

</body>

</html>
