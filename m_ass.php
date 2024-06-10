<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Management</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <header>
            <div class="logo">SME</div>
            <nav>
                <ul>
                    <li><a href="manager_dashboard.php">Manager Dashboard</a></li>
                    <li><a href="m_emp.php">Employees</a></li>
                    <li><a href="m_dept.php">Department</a></li>
                    <li><a href="m_ass.php">Assignment</a></li>
                    <li><a href="m_proj.php">Project</a></li>
                </ul>
            </nav>
            <div class="profile-pic">
                <button id="logout_btn">LOGOUT</button>
            </div>
        </header>

        <main>

        <h2>Assignment Form</h2>

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
                require 'config/db.php';
                if (isset($_GET['deleteid'])) {
                    $id = mysqli_real_escape_string($conn, $_GET['deleteid']);
                    $deleteQuery = "DELETE FROM assignment WHERE AssignmentID = '$id'";
                    if (mysqli_query($conn, $deleteQuery)) {
                        echo '<script>alert("assignment deleted successfully!");</script>';
                    } else {
                        echo '<div class="error-message">';
                        echo '<p>Error: ' . htmlspecialchars(mysqli_error($conn)) . '</p>';
                        echo '<button onclick="window.location.href=\'assignment.php\';">Go Back</button>';
                        echo '</div>';
                    }
                }
                $assignmentQuery = "SELECT * FROM assignment";
                $result = mysqli_query($conn, $assignmentQuery) or die('error');
                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['AssignmentID']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['EmployeeID']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['ProjectID']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['HoursWorked']) . '</td>';
                    // echo '<td><a class="action-link delete" href="assignment.php?deleteid=' . urlencode($row['AssignmentID']) . '">Delete</a></td>';
                    echo '<td><a class="action-link update" onclick="update_form(' . htmlspecialchars(json_encode($row)) . ')">Update</a></td>';
                    echo '</tr>';
                }

                if (isset($_POST['submit_assignment'])) {
                    $AssignmentID = mysqli_real_escape_string($conn, $_POST['e_insert_AssignmentID']);
                    $EmployeeID = mysqli_real_escape_string($conn, $_POST['insert_EmployeeID']);
                    $ProjectID = mysqli_real_escape_string($conn, $_POST['insert_ProjectID']);
                    $HoursWorked = mysqli_real_escape_string($conn, $_POST['e_insert_HoursWorked']);
                    
                    $insertQuery = "INSERT INTO assignment (AssignmentID, EmployeeID, ProjectID, HoursWorked) VALUES ('$AssignmentID', '$EmployeeID', '$ProjectID', '$HoursWorked')";
                    
                    if (mysqli_query($conn, $insertQuery)) {
                        echo '<script>alert("assignment inserted successfully!");</script>';
                    } else {
                        echo '<div class="error-message">';
                        echo '<p>Error: ' . htmlspecialchars(mysqli_error($conn)) . '</p>';
                        echo '<button onclick="window.location.href=\'assignment.php\';">Go Back</button>';
                        echo '</div>';
                    }
                }
                ?>
            </tbody>
        </table>

        <!-- <button id="openInsertFormBtn">Insert New assignment</button> -->

        <!-- <div id="insert_form_modal" class="insert-form-modal">
            <form action="assignment.php" method="post">
                <span class="close">&times;</span>
                <h1>INSERT FORM</h1>
                <label for="e_insert_AssignmentID">assignment ID:</label>
                <input type="text" id="e_insert_AssignmentID" name="e_insert_AssignmentID" required>
                <label for="insert_EmployeeID">Last Name:</label>
                <input type="text" id="insert_EmployeeID" name="insert_EmployeeID" required>
                <label for="insert_ProjectID">First Name:</label>
                <input type="text" id="insert_ProjectID" name="insert_ProjectID" required>
                <label for="e_insert_HoursWorked">Department ID:</label>
                <input type="text" id="e_insert_HoursWorked" name="e_insert_HoursWorked" required>
                <input type="submit" name="submit_assignment" value="Submit">
            </form>
        </div> -->

        <div id="update_form_modal" class="update-form-modal">
            <form id="assignmentForm" action="update.php" method="post">
                <span class="close">&times;</span>
                <h1>UPDATE FORM</h1>
                <label for="update_AssignmentID">AssignmentID</label>
                <input type="text" id="update_AssignmentID" name="update_AssignmentID" readonly>
                <label for="update_EmployeeID">EmployeeID</label>
                <input type="text" id="update_EmployeeID" name="update_EmployeeID" required>
                <label for="update_ProjectID">ProjectID</label>
                <input type="text" id="update_ProjectID" name="update_ProjectID" required>
                <label for="update_HoursWorked">HoursWorked</label>
                <select id="update_HoursWorked" name="update_HoursWorked" required>
                    <?php
                    $departmentQuery = "SELECT AssignmentID, HoursWorked FROM assignment";
                    $departmentResult = mysqli_query($conn, $departmentQuery) or die('error fetching departments');
                    while ($row = mysqli_fetch_assoc($departmentResult)) {
                        echo '<option value="' . htmlspecialchars($row['HoursWorked']) . '">' . htmlspecialchars($row['HoursWorked']) . ' - ' . htmlspecialchars($row['DepartmentName']) . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" name="update_assignment" value="Submit">
            </form>
        </div> 
    </div>
    </main>

    <script>
            // Logout functionality
            document.getElementById('logout_btn').addEventListener("click", function() {
            window.location.href = 'guest_dashboard.php';
            });

    </script>

    <script>
        function update_form(assignment) {
            document.getElementById("update_AssignmentID").value = assignment.AssignmentID;
            document.getElementById("update_EmployeeID").value = assignment.EmployeeID;
            document.getElementById("update_ProjectID").value = assignment.ProjectID;
            document.getElementById("update_HoursWorked").value = assignment.HoursWorked;
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
    </script>
</body>

</html>
