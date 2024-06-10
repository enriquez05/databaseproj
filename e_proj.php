<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management</title>
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

        <h2>Project Form</h2>

        <table>
            <thead>
                <tr>
                    <th>ProjectID</th>
                    <th>StartDate</th>
                    <th>EndDate</th>
                    <th>ProjectName</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require 'config/db.php';
                if (isset($_GET['deleteid'])) {
                    $id = mysqli_real_escape_string($conn, $_GET['deleteid']);
                    $deleteQuery = "DELETE FROM project WHERE ProjectID = '$id'";
                    if (mysqli_query($conn, $deleteQuery)) {
                        echo '<script>alert("project deleted successfully!");</script>';
                    } else {
                        echo '<div class="error-message">';
                        echo '<p>Error: ' . htmlspecialchars(mysqli_error($conn)) . '</p>';
                        echo '<button onclick="window.location.href=\'project.php\';">Go Back</button>';
                        echo '</div>';
                    }
                }
                $projectQuery = "SELECT * FROM project";
                $result = mysqli_query($conn, $projectQuery) or die('error');
                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['ProjectID']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['StartDate']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['EndDate']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['ProjectName']) . '</td>';
                    // echo '<td><a class="action-link delete" href="project.php?deleteid=' . urlencode($row['ProjectID']) . '">Delete</a></td>';
                    // echo '<td><a class="action-link update" onclick="update_form(' . htmlspecialchars(json_encode($row)) . ')">Update</a></td>';
                    echo '</tr>';
                }

                if (isset($_POST['submit_project'])) {
                    $ProjectID = mysqli_real_escape_string($conn, $_POST['e_insert_ProjectID']);
                    $StartDate = mysqli_real_escape_string($conn, $_POST['insert_StartDate']);
                    $EndDate = mysqli_real_escape_string($conn, $_POST['insert_EndDate']);
                    $ProjectName = mysqli_real_escape_string($conn, $_POST['e_insert_ProjectName']);
                    
                    $insertQuery = "INSERT INTO project (ProjectID, StartDate, EndDate, ProjectName) VALUES ('$ProjectID', '$StartDate', '$EndDate', '$ProjectName')";
                    
                    if (mysqli_query($conn, $insertQuery)) {
                        echo '<script>alert("project inserted successfully!");</script>';
                    } else {
                        echo '<div class="error-message">';
                        echo '<p>Error: ' . htmlspecialchars(mysqli_error($conn)) . '</p>';
                        echo '<button onclick="window.location.href=\'project.php\';">Go Back</button>';
                        echo '</div>';
                    }
                }
                ?>
            </tbody>
        </table>

        <!-- <button id="openInsertFormBtn">Insert New project</button>

        <div id="insert_form_modal" class="insert-form-modal">
            <form action="project.php" method="post">
                <span class="close">&times;</span>
                <h1>INSERT FORM</h1>
                <label for="e_insert_ProjectID">Project ID:</label>
                <input type="text" id="e_insert_ProjectID" name="e_insert_ProjectID" required>
                <label for="insert_StartDate">Start Date:</label>
                <input type="date" id="insert_StartDate" name="insert_StartDate" required>
                <label for="insert_EndDate">End Date:</label>
                <input type="date" id="insert_EndDate" name="insert_EndDate" required>
                <label for="e_insert_ProjectName">Project Name:</label>
                <input type="text" id="e_insert_ProjectName" name="e_insert_ProjectName" required>
                <input type="submit" name="submit_project" value="Submit">
            </form>
        </div>

        <div id="update_form_modal" class="update-form-modal">
            <form id="projectForm" action="update.php" method="post">
                <span class="close">&times;</span>
                <h1>UPDATE FORM</h1>
                <label for="update_ProjectID">ProjectID</label>
                <input type="text" id="update_ProjectID" name="update_ProjectID" readonly>
                <label for="update_StartDate">StartDate</label>
                <input type="text" id="update_StartDate" name="update_StartDate" required>
                <label for="update_EndDate">EndDate</label>
                <input type="text" id="update_EndDate" name="update_EndDate" required>
                <label for="update_ProjectName">ProjectName</label>
                <select id="update_ProjectName" name="update_ProjectName" required>
                    <?php
                    $departmentQuery = "SELECT ProjectID, ProjectName FROM project";
                    $departmentResult = mysqli_query($conn, $departmentQuery) or die('error fetching departments');
                    while ($row = mysqli_fetch_assoc($departmentResult)) {
                        echo '<option value="' . htmlspecialchars($row['ProjectName']) . '">' . htmlspecialchars($row['ProjectName']) . ' - ' . htmlspecialchars($row['DepartmentName']) . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" name="update_project" value="Submit">
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

    // <!-- <script>
    //     function update_form(project) {
    //         document.getElementById("update_ProjectID").value = project.ProjectID;
    //         document.getElementById("update_StartDate").value = project.StartDate;
    //         document.getElementById("update_EndDate").value = project.EndDate;
    //         document.getElementById("update_ProjectName").value = project.ProjectName;
    //         document.getElementById("update_form_modal").style.display = "block";
    //     }

    //     window.onload = function () {
    //         var spanUpdate = document.getElementsByClassName("close")[0];
    //         spanUpdate.onclick = function () {
    //             document.getElementById("update_form_modal").style.display = "none";
    //         }
    //         window.onclick = function (event) {
    //             if (event.target == document.getElementById("update_form_modal")) {
    //                 document.getElementById("update_form_modal").style.display = "none";
    //             }
    //         }

    //         var insertFormBtn = document.getElementById("openInsertFormBtn");
    //         var insertFormModal = document.getElementById("insert_form_modal");
    //         var spanInsert = insertFormModal.getElementsByClassName("close")[0];

    //         insertFormBtn.onclick = function() {
    //             insertFormModal.style.display = "block";
    //         }
    //         spanInsert.onclick = function() {
    //             insertFormModal.style.display = "none";
    //         }
    //         window.onclick = function(event) {
    //             if (event.target == insertFormModal) {
    //                 insertFormModal.style.display = "none";
    //             }
    //         }
    //     }
    // </script> -->
</body>

</html>
