<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
        }
        .button-container {
            margin-top: 20px;
            text-align: center;
        }
        .button-container button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 30px;
            margin: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }
        .button-container button:hover {
            background-color: #45a049;
        }
        .container {
            width: 80%;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e2e2e2;
        }
        form {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-top: 10px;
            color: #555;
        }
        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #45a049;
        }
        a {
            color: #ff0000;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="button-container">
        <button onclick="window.location.href='index_employee.php'">Employee Form</button>
        <button onclick="window.location.href='index_department.php'">Department Form</button>
    </div>
    <div class="container">
        <h2>Employee Form</h2>
        <?php
        require 'config/db.php';

        if (isset($_GET['delete_employee_id'])) {
            $id = $_GET['delete_employee_id'];
            $delete = mysqli_query($conn, "DELETE FROM employee WHERE EmployeeID = '$id'");

            if ($delete) {
                echo '<div class="message success">Employee deleted successfully.</div>';
            } else {
                echo '<div class="message error">Error deleting employee.</div>';
            }
        }
        ?>

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
                $result = mysqli_query($conn, $employeeQuery) or die('Error querying the database.');

                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>
                            <td>' . $row['EmployeeID'] . '</td>
                            <td>' . $row['LastName'] . '</td>
                            <td>' . $row['FirstName'] . '</td>
                            <td>' . $row['DepartmentID'] . '</td>
                            <td><a href="employee_form.php?delete_employee_id=' . $row['EmployeeID'] . '">Delete</a></td>
                          </tr>';
                }
                ?>
            </tbody>
        </table>

        <form action="insert_employee.php" method="post">
            <label for="employeeID">Employee ID:</label>
            <input type="text" id="employeeID" name="EmployeeID" required>
            
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="LastName" required>
            
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="FirstName" required>
            
            <label for="departmentID">Department ID:</label>
            <input type="text" id="departmentID" name="DepartmentID" required>
            
            <button type="submit" name="submit" value="Submit">Submit</button>
        </form>
    </div>
</body>
</html>
