<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Form</title>
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
        <button onclick="window.location.href='index_assignment.php'">Assignment Form</button>
        <button onclick="window.location.href='index_project.php'">Project Form</button>
    </div>
    <div class="container">
        <h2>Project Form</h2>
        <?php
        require 'config/db.php';

        if (isset($_GET['deleteid'])) {
            $id = $_GET['deleteid'];
            $delete = mysqli_query($conn, "DELETE FROM project WHERE ProjectID = '$id'");

            if ($delete) {
                echo '<div class="message success">Project deleted successfully.</div>';
            } else {
                echo '<div class="message error">Error deleting project.</div>';
            }
        }
        ?>

        <table>
            <thead>
                <tr>
                    <th>ProjectID</th>
                    <th>ProjectName</th>
                    <th>StartDate</th>
                    <th>EndDate</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $projectQuery = "SELECT * FROM project";
                $result = mysqli_query($conn, $projectQuery) or die('Error querying the database.');

                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>
                            <td>' . $row['ProjectID'] . '</td>
                            <td>' . $row['ProjectName'] . '</td>
                            <td>' . $row['StartDate'] . '</td>
                            <td>' . $row['EndDate'] . '</td>
                            <td><a href="project_form.php?deleteid=' . $row['ProjectID'] . '">Delete</a></td>
                          </tr>';
                }
                ?>
            </tbody>
        </table>

        <form action="insert_project.php" method="post">
            <label for="ProjectID">Project ID:</label>
            <input type="text" id="ProjectID" name="ProjectID" required>
            
            <label for="ProjectName">Project Name:</label>
            <input type="text" id="ProjectName" name="ProjectName" required>
            
            <label for="StartDate">Start Date:</label>
            <input type="text" id="StartDate" name="StartDate" required>
            
            <label for="EndDate">End Date:</label>
            <input type="text" id="EndDate" name="EndDate" required>
            
            <button type="submit" name="submit_project" value="Submit">Submit</button>
        </form>

