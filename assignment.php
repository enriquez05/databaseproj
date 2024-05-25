<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment</title>
</head>

<body>
    <?php
    require 'config/db.php';

    // Handle deletion
    if (isset($_GET['deleteid'])) {
        $id = intval($_GET['deleteid']);
        $deleteQuery = "DELETE FROM assignment WHERE AssignmentID = '$id'";
        if (mysqli_query($conn, $deleteQuery)) {
            echo '<script>alert("Assignment deleted successfully!");</script>';
        } else {
            echo '<script>alert("Error: ' . $deleteQuery . '<br>' . mysqli_error($conn) . '");</script>';
        }
        header('Location: assignment.php');
        exit();
    }
    ?>

<table>
        <thead>
            <tr>
                <th>AssignmentID</th>
                <th>EmployeeID</th>
                <th>ProjectID</th>
                <th>HoursWorked</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $assignmentQuery = "SELECT * FROM assignment";
            $result = mysqli_query($conn, $assignmentQuery) or die('error');

            while ($row = mysqli_fetch_array($result)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['AssignmentID']) . '</td>';
                echo '<td>' . htmlspecialchars($row['EmployeeID']) . '</td>';
                echo '<td>' . htmlspecialchars($row['ProjectID']) . '</td>';
                echo '<td>' . htmlspecialchars($row['HoursWorked']) . '</td>';
                echo '<td><a href="assignment.php?deleteid=' . urlencode($row['AssignmentID']) . '">Delete</a></td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

    <h2>Assignment Form</h2>
    <form action="insert.php" method="post">
        <label for="AssignmentID">Assignment ID:</label>
        <input type="text" id="AssignmentID" name="AssignmentID" required><br><br>
        <label for="EmployeeID">Employee ID:</label>
        <input type="text" id="EmployeeID" name="EmployeeID" required><br><br>
        <label for="ProjectID">Project ID:</label>
        <input type="text" id="ProjectID" name="ProjectID" required><br><br>
        <label for="HoursWorked">Hours Worked:</label>
        <input type="text" id="HoursWorked" name="HoursWorked" required><br><br>
        <input type="submit" name="submit_assignment" value="Submit">
    </form>

</body>

</html>
