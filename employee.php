<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>
</head>

<body>
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
        header('Location: employee.php');
        exit();
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
            $result = mysqli_query($conn, $employeeQuery) or die('error');

            while ($row = mysqli_fetch_array($result)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['EmployeeID']) . '</td>';
                echo '<td>' . htmlspecialchars($row['LastName']) . '</td>';
                echo '<td>' . htmlspecialchars($row['FirstName']) . '</td>';
                echo '<td>' . htmlspecialchars($row['DepartmentID']) . '</td>';
                echo '<td><a href="employee.php?deleteid=' . urlencode($row['EmployeeID']) . '">Delete</a></td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

    <h2>Employee Form</h2>
    <form action="insert.php" method="post">
        <label for="EmployeeID">Employee ID:</label>
        <input type="text" id="EmployeeID" name="EmployeeID" required><br><br>
        <label for="LastName">Last Name:</label>
        <input type="text" id="LastName" name="LastName" required><br><br>
        <label for="FirstName">First Name:</label>
        <input type="text" id="FirstName" name="FirstName" required><br><br>
        <label for="DepartmentID">Department ID:</label>
        <input type="text" id="DepartmentID" name="DepartmentID" required><br><br>
        <input type="submit" name="submit_employee" value="Submit">
    </form>

</body>

</html>
