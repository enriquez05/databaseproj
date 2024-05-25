<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project</title>
</head>

<body>
    <?php
    require 'config/db.php';

    // Handle deletion
    if (isset($_GET['deleteid'])) {
        $id = intval($_GET['deleteid']);
        $deleteQuery = "DELETE FROM Project WHERE ProjectID = '$id'";
        if (mysqli_query($conn, $deleteQuery)) {
            echo '<script>alert("Project deleted successfully!");</script>';
        } else {
            echo '<script>alert("Error: ' . $deleteQuery . '<br>' . mysqli_error($conn) . '");</script>';
        }
        header('Location: project.php');
        exit();
    }
    ?>

<table>
        <thead>
            <tr>
                <th>ProjectID</th>
                <th>StartDate</th>
                <th>EndDate</th>
                <th>ProjectName</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $ProjectQuery = "SELECT * FROM project";
            $result = mysqli_query($conn, $ProjectQuery) or die('error');

            while ($row = mysqli_fetch_array($result)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['ProjectID']) . '</td>';
                echo '<td>' . htmlspecialchars($row['StartDate']) . '</td>';
                echo '<td>' . htmlspecialchars($row['EndDate']) . '</td>';
                echo '<td>' . htmlspecialchars($row['ProjectName']) . '</td>';
                echo '<td><a href="project.php?deleteid=' . urlencode($row['ProjectID']) . '">Delete</a></td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

    <h2>Project Form</h2>
    <form action="insert.php" method="post">
        <label for="ProjectID">Project ID:</label>
        <input type="text" id="ProjectID" name="ProjectID" required><br><br>
        <label for="StartDate">Start Date (yyyy-mm-dd):</label>
        <input type="text" id="StartDate" name="StartDate" required><br><br>
        <label for="EndDate">End Date (yyyy-mm-dd):</label>
        <input type="text" id="EndDate" name="EndDate" required><br><br>
        <label for="ProjectName">Project Name:</label>
        <input type="text" id="ProjectName" name="ProjectName" required><br><br>
        <input type="submit" name="submit_project" value="Submit">
    </form>

</body>

</html>
