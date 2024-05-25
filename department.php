<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department</title>
</head>

<body>
    <?php
    require 'config/db.php';

    // Handle deletion
    if (isset($_GET['deleteid'])) {
        $id = intval($_GET['deleteid']);
        $deleteQuery = "DELETE FROM department WHERE DepartmentID = '$id'";
        if (mysqli_query($conn, $deleteQuery)) {
            echo '<script>alert("department deleted successfully!");</script>';
        } else {
            echo '<script>alert("Error: ' . $deleteQuery . '<br>' . mysqli_error($conn) . '");</script>';
        }
        header('Location: department.php');
        exit();
    }
    ?>

<table>
        <thead>
            <tr>
                <th>DepartmentID</th>
                <th>DepartmentName</th>
                <th>ManagerID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $departmentQuery = "SELECT * FROM department";
            $result = mysqli_query($conn, $departmentQuery) or die('error');

            while ($row = mysqli_fetch_array($result)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['DepartmentID']) . '</td>';
                echo '<td>' . htmlspecialchars($row['DepartmentName']) . '</td>';
                echo '<td>' . htmlspecialchars($row['ManagerID']) . '</td>';
                echo '<td><a href="department.php?deleteid=' . urlencode($row['DepartmentID']) . '">Delete</a></td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

    <h2>department Form</h2>
    <form action="insert.php" method="post">
        <label for="DepartmentID">Department ID:</label>
        <input type="text" id="DepartmentID" name="DepartmentID" required><br><br>
        <label for="LastName">Department Name:</label>
        <input type="text" id="DepartmentName" name="DepartmentName" required><br><br>
        <label for="FirstName">Manager ID:</label>
        <input type="text" id="ManagerID" name="ManagerID" required><br><br>
        <input type="submit" name="submit_department" value="Submit">
    </form>

</body>

</html>
