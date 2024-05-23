<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .button-container {
            margin-bottom: 20px;
        }
        .button-container button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            margin-right: 10px;
        }
        .button-container button:hover {
            background-color: #45a049;
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
</body>
</html>
