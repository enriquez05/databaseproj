<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project</title>
</head>
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

    <h2>Project Form</h2>

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

    </div>  

</body>

</html>
