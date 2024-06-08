<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f4f4f9;
            color: #333;
            line-height: 1.6;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        header {
            background: #333;
            color: #fff;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .logo {
            font-size: 1.5em;
            margin-left: 20px;
        }

        header nav {
            margin-right: 20px;
        }

        header nav ul {
            list-style: none;
            display: flex;
        }

        header nav ul li {
            margin-left: 20px;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        .search-profile {
            display: flex;
            align-items: center;
        }

        .profile-pic {
            width: 40px;
            height: 40px;
            background: url('profile-pic.jpg') no-repeat center center/cover;
            border-radius: 50%;
        }

        h2 {
            text-align: center;
            margin: 20px 0;
            color: #3498db;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        table thead {
            background: #3498db;
            color: #fff;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
        }

        table tr:nth-child(even) {
            background: #f4f4f9;
        }

        table tr:nth-child(odd) {
            background: #eaf2f8;
        }

        table tr:hover {
            background: #d1e7f0;
        }

        .action-link {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            color: #fff;
            font-weight: bold;
        }

        .action-link.delete {
            background-color: #e74c3c;
        }

        .action-link.update {
            background-color: #3498db;
        }

        form {
            background: #fff;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        form h1 {
            margin-bottom: 20px;
            color: #3498db;
        }

        form label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }

        form input[type="text"], form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #eaf2f8;
        }

        form input[type="submit"] {
            background: #2ecc71;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
        }

        form input[type="submit"]:hover {
            background: #27ae60;
        }

        .update-form-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .update-form-modal form {
            width: 500px;
            background: #fff;
            padding: 20px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .update-form-modal .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
        }

        .update-form-modal .close:hover {
            color: #e74c3c;
        }

        </style>

</head>


<body>
    <div class="container">
        <header>
            <div class="logo">SME</div>
            <nav>
                <ul>
                    <li><a href="admin_dashboard.php">Dashboard</a></li>
                    <li><a href="">Employees</a></li>
                    <li><a href="department.php">Department</a></li>
                    <li><a href="assignment.php">Assignment</a></li>
                    <li><a href="#">Project</a></li>
                </ul>
            </nav>
            <div class="search-profile">
                <div class="profile-pic"></div>
            </div>
        </header>

        <h2>Employee Form</h2>

        <table>
            <thead>
                <tr>
                    <th>EmployeeID</th>
                    <th>LastName</th>
                    <th>FirstName</th>
                    <th>DepartmentID</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require 'config/db.php';
                if (isset($_GET['deleteid'])) {
                    $id = mysqli_real_escape_string($conn, $_GET['deleteid']);
                    $deleteQuery = "DELETE FROM employee WHERE EmployeeID = '$id'";
                    if (mysqli_query($conn, $deleteQuery)) {
                        echo '<script>alert("Employee deleted successfully!");</script>';
                    } else {
                        echo '<script>alert("Error: ' . mysqli_error($conn) . '<br>' . mysqli_error($conn) . '");</script>';
                    }
                }
                $employeeQuery = "SELECT * FROM employee";
                $result = mysqli_query($conn, $employeeQuery) or die('error');
                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['EmployeeID']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['LastName']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['FirstName']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['DepartmentID']) . '</td>';
                    // echo '<td><a class="action-link" href="employee.php?deleteid=' . urlencode($row['EmployeeID']) . '">Delete</a></td>';
                    // echo '<td><a class="action-link" onclick="update_form(' . htmlspecialchars(json_encode($row)) . ')">Update</a></td>';
                    echo '</tr>';
                     }
                     ?>
             </tbody>
         </table>
<!-- 
    //     <form action="insert.php" method="post">
    //         <h1>INSERT FORM</h1>
    //         <label for="e_insert_EmployeeID">Employee ID:</label>
    //         <input type="text" id="e_insert_EmployeeID" name="e_insert_EmployeeID" required>
    //         <label for="insert_LastName">Last Name:</label>
    //         <input type="text" id="insert_LastName" name="insert_LastName" required>
    //         <label for="insert_FirstName">First Name:</label>
    //         <input type="text" id="insert_FirstName" name="insert_FirstName" required>
    //         <label for="e_insert_DepartmentID">Department ID:</label>
    //         <input type="text" id="e_insert_DepartmentID" name="e_insert_DepartmentID" required>
    //         <input type="submit" name="submit_employee" value="Submit">
    //     </form>
    // </div>

    // <div id="update_form_modal" class="update-form-modal">
    //     <form id="EmployeeForm" action="update.php" method="post">
    //         <span class="close">&times;</span>
    //         <h1>UPDATE FORM</h1>
    //         <label for="update_EmployeeID">EmployeeID</label>
    //         <input type="text" id="update_EmployeeID" name="update_EmployeeID" readonly>
    //         <label for="update_LastName">LastName</label>
    //         <input type="text" id="update_LastName" name="update_LastName" required>
    //         <label for="update_FirstName">FirstName</label>
    //         <input type="text" id="update_FirstName" name="update_FirstName" required>
    //         <label for="update_DepartmentID">DepartmentID</label>
    //         <select id="update_DepartmentID" name="update_DepartmentID" required>
    //             <?php
    //             $departmentQuery = "SELECT DepartmentID, DepartmentName FROM department";
    //             $departmentResult = mysqli_query($conn, $departmentQuery) or die('error fetching departments');
    //             while ($row = mysqli_fetch_assoc($departmentResult)) {
    //                 echo '<option value="' . htmlspecialchars($row['DepartmentID']) . '">' . htmlspecialchars($row['DepartmentID']) . ' - ' . htmlspecialchars($row['DepartmentName']) . '</option>';
    //             }
    //             ?>
    //         </select>
    //         <input type="submit" name="update_employee" value="Submit">
    //     </form>
    // </div>

    // <script>
    //     function update_form(employee) {
    //         document.getElementById("update_EmployeeID").value = employee.EmployeeID;
    //         document.getElementById("update_LastName").value = employee.LastName;
    //         document.getElementById("update_FirstName").value = employee.FirstName;
    //         document.getElementById("update_DepartmentID").value = employee.DepartmentID;
    //         document.getElementById("update_form_modal").style.display = "block";
    //     }

    //     window.onload = function () {
    //         var span = document.getElementsByClassName("close")[0];
    //         span.onclick = function () {
    //             document.getElementById("update_form_modal").style.display = "none";
    //         }
    //         window.onclick = function (event) {
    //             if (event.target == document.getElementById("update_form_modal")) {
    //                 document.getElementById("update_form_modal").style.display = "none";
    //             }
    //         }
    //     }
    // </script> -->
</body>

</html>
