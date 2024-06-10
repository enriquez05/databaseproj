<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <header>
            <div class="logo">SME</div>
            <nav>
                <ul>
                    <li><a href="employee_dashboard.php">Employee Dashboard</a></li>
                    <li><a href="e_emp.php">Employees</a></li>
                    <li><a href="e_dept.php">Department</a></li>
                    <li><a href="e_ass.php">Assignment</a></li>
                    <li><a href="e_proj.php">Project</a></li>
                </ul>
            </nav>
            <div class="profile-pic">
                <button id="logout_btn">LOGOUT</button>
            </div>
        </header>

        <main>

        <h2>Employee Form</h2>

        <table>
            <thead>
                <tr>
                    <th>EmployeeID</th>
                    <th>LastName</th>
                    <th>FirstName</th>
                    <th>DepartmentID</th>
                    <th>user_id</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require 'config/db.php';
                if (isset($_GET['deleteid'])) {
                    $id = mysqli_real_escape_string($conn, $_GET['deleteid']);
                    $deleteQuery_a = "DELETE FROM employee WHERE user_id = '$id'";
                    if (mysqli_query($conn, $deleteQuery_a)) {
                        $deleteQuery_b = "DELETE FROM users WHERE user_id = '$id'"; 
                        if (mysqli_query($conn, $deleteQuery_b)) {
                            echo '<script>alert("Employee deleted successfully!");</script>';
                        } else {
                            echo '<div class="error-message">';
                            echo '<p>Error: ' . htmlspecialchars(mysqli_error($conn)) . '</p>';
                            echo '<button onclick="window.location.href=\'employee.php\';">Go Back</button>';
                            echo '</div>';
                        }
                        
                    } else {
                        echo '<div class="error-message">';
                        echo '<p>Error: ' . htmlspecialchars(mysqli_error($conn)) . '</p>';
                        echo '<button onclick="window.location.href=\'employee.php\';">Go Back</button>';
                        echo '</div>';
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
                    echo '<td>' . htmlspecialchars($row['user_id']) . '</td>';
                    // echo '<td><a class="action-link delete" href="employee.php?deleteid=' . urlencode($row['user_id']) . '">Delete</a></td>';
                    // echo '<td><a class="action-link update" onclick="update_form(' . htmlspecialchars(json_encode($row)) . ')">Update</a></td>';
                     echo '</tr>';
                }
                ?>
            </tbody>
        </table>

        <!-- <button id="openInsertFormBtn">Insert New Employee</button>

        <div id="insert_form_modal" class="insert-form-modal">
            <form action="insert.php" method="post">
                <span class="close">&times;</span>
                <h1>INSERT FORM</h1>
                <label for="e_insert_EmployeeID">Employee ID:</label>
                <input type="text" id="e_insert_EmployeeID" name="e_insert_EmployeeID" required>
                <label for="insert_LastName">Last Name:</label>
                <input type="text" id="insert_LastName" name="insert_LastName" required>
                <label for="insert_FirstName">First Name:</label>
                <input type="text" id="insert_FirstName" name="insert_FirstName" required>
                <label for="e_insert_DepartmentID">Department ID:</label>
                <input type="text" id="e_insert_DepartmentID" name="e_insert_DepartmentID" required>
                <label for="e_insert_username">Username:</label>
                <input type="text" id="e_insert_username" name="e_insert_username" required>
                <label for="e_insert_password">Password:</label>
                <input type="text" id="e_insert_password" name="e_insert_password" required>
                <input type="submit" name="submit_employee" value="Submit">
            </form>
        </div> -->

        <!-- <div id="update_form_modal" class="update-form-modal">
            <form id="EmployeeForm" action="update.php" method="post">
                <span class="close">&times;</span>
                <h1>UPDATE FORM</h1>
                <label for="update_EmployeeID">EmployeeID</label>
                <input type="text" id="update_EmployeeID" name="update_EmployeeID" readonly>
                <label for="update_LastName">LastName</label>
                <input type="text" id="update_LastName" name="update_LastName" required>
                <label for="update_FirstName">FirstName</label>
                <input type="text" id="update_FirstName" name="update_FirstName" required>
                <label for="update_DepartmentID">DepartmentID</label>
                <select id="update_DepartmentID" name="update_DepartmentID" required>
                    <?php
                    $departmentQuery = "SELECT DepartmentID, DepartmentName FROM department";
                    $departmentResult = mysqli_query($conn, $departmentQuery) or die('error fetching departments');
                    while ($row = mysqli_fetch_assoc($departmentResult)) {
                        echo '<option value="' . htmlspecialchars($row['DepartmentID']) . '">' . htmlspecialchars($row['DepartmentID']) . ' - ' . htmlspecialchars($row['DepartmentName']) . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" name="update_employee" value="Submit">
            </form>
        </div> -->
    </div>
    </main>

    <script>
            // Logout functionality
            document.getElementById('logout_btn').addEventListener("click", function() {
            window.location.href = 'guest_dashboard.php';
            });

    </script>

    <!-- <script>
        function update_form(employee) {
            document.getElementById("update_EmployeeID").value = employee.EmployeeID;
            document.getElementById("update_LastName").value = employee.LastName;
            document.getElementById("update_FirstName").value = employee.FirstName;
            document.getElementById("update_DepartmentID").value = employee.DepartmentID;
            document.getElementById("update_form_modal").style.display = "block";
        }

        window.onload = function () {
            var spanUpdate = document.getElementsByClassName("close")[0];
            spanUpdate.onclick = function () {
                document.getElementById("update_form_modal").style.display = "none";
            }
            window.onclick = function (event) {
                if (event.target == document.getElementById("update_form_modal")) {
                    document.getElementById("update_form_modal").style.display = "none";
                }
            }

            var insertFormBtn = document.getElementById("openInsertFormBtn");
            var insertFormModal = document.getElementById("insert_form_modal");
            var spanInsert = insertFormModal.getElementsByClassName("close")[0];

            insertFormBtn.onclick = function() {
                insertFormModal.style.display = "block";
            }
            spanInsert.onclick = function() {
                insertFormModal.style.display = "none";
            }
            window.onclick = function(event) {
                if (event.target == insertFormModal) {
                    insertFormModal.style.display = "none";
                }
            }
        }
    </script> -->
</body>

</html>
