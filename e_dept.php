<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>department Management</title>
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

        <h2>Department Form</h2>

        <table>
            <thead>
                <tr>
                    <th>DepartmentID</th>
                    <th>DepartmentName</th>
                    <th>ManagerID</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require 'config/db.php';
                if (isset($_GET['deleteid'])) {
                    $id = mysqli_real_escape_string($conn, $_GET['deleteid']);
                    $deleteQuery = "DELETE FROM department WHERE DepartmentID = '$id'";
                    if (mysqli_query($conn, $deleteQuery)) {
                        echo '<script>alert("department deleted successfully!");</script>';
                    } else {
                        echo '<div class="error-message">';
                        echo '<p>Error: ' . htmlspecialchars(mysqli_error($conn)) . '</p>';
                        echo '<button onclick="window.location.href=\'department.php\';">Go Back</button>';
                        echo '</div>';
                    }
                }
                $departmentQuery = "SELECT * FROM department";
                $result = mysqli_query($conn, $departmentQuery) or die('error');
                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['DepartmentID']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['DepartmentName']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['ManagerID']) . '</td>';
                    // echo '<td><a class="action-link delete" href="department.php?deleteid=' . urlencode($row['DepartmentID']) . '">Delete</a></td>';
                    // echo '<td><a class="action-link update" onclick="update_form(' . htmlspecialchars(json_encode($row)) . ')">Update</a></td>';
                     echo '</tr>';
                }

                if (isset($_POST['submit_department'])) {
                    $DepartmentID = mysqli_real_escape_string($conn, $_POST['e_insert_DepartmentID']);
                    $DepartmentName = mysqli_real_escape_string($conn, $_POST['insert_DepartmentName']);
                    $ManagerID = mysqli_real_escape_string($conn, $_POST['e_insert_ManagerID']);
                    
                    $insertQuery = "INSERT INTO department (DepartmentID, DepartmentName, ManagerID) VALUES ('$DepartmentID', '$DepartmentName', '$ManagerID')";
                    
                    if (mysqli_query($conn, $insertQuery)) {
                        echo '<script>alert("department inserted successfully!");</script>';
                    } else {
                        echo '<div class="error-message">';
                        echo '<p>Error: ' . htmlspecialchars(mysqli_error($conn)) . '</p>';
                        echo '<button onclick="window.location.href=\'department.php\';">Go Back</button>';
                        echo '</div>';
                    }
                }
                ?>
            </tbody>
        </table>

        <!-- <button id="openInsertFormBtn">Insert New department</button>

        <div id="insert_form_modal" class="insert-form-modal">
            <form action="department.php" method="post">
                <span class="close">&times;</span>
                <h1>INSERT FORM</h1>
                <label for="e_insert_DepartmentID">Department ID:</label>
                <input type="text" id="e_insert_DepartmentID" name="e_insert_DepartmentID" required>
                <label for="insert_DepartmentName">Department Name:</label>
                <input type="text" id="insert_DepartmentName" name="insert_DepartmentName" required>
                <label for="e_insert_ManagerID">Manager ID:</label>
                <input type="text" id="e_insert_ManagerID" name="e_insert_ManagerID" required>
                <input type="submit" name="submit_department" value="Submit">
            </form>
        </div> -->

        <!-- <div id="update_form_modal" class="update-form-modal">
            <form id="departmentForm" action="update.php" method="post">
                <span class="close">&times;</span>
                <h1>UPDATE FORM</h1>
                <label for="update_DepartmentID">DepartmentID</label>
                <input type="text" id="update_DepartmentID" name="update_DepartmentID" readonly>
                <label for="update_DepartmentName">DepartmentName</label>
                <input type="text" id="update_DepartmentName" name="update_DepartmentName" required>
                <label for="update_ManagerID">ManagerID</label>
                <select id="update_ManagerID" name="update_ManagerID" required>
                    <?php
                    $departmentQuery = "SELECT DepartmentName, ManagerID FROM department";
                    $departmentResult = mysqli_query($conn, $departmentQuery) or die('error fetching departments');
                    while ($row = mysqli_fetch_assoc($departmentResult)) {
                        echo '<option value="' . htmlspecialchars($row['ManagerID']) . '">' . htmlspecialchars($row['ManagerID']) . ' - ' . htmlspecialchars($row['DepartmentName']) . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" name="update_department" value="Submit">
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
        function update_form(department) {
            console.log("department: ", department);
            document.getElementById("update_DepartmentID").value = department.DepartmentID;
            document.getElementById("update_DepartmentName").value = department.DepartmentName;
            document.getElementById("update_ManagerID").value = department.ManagerID;
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
