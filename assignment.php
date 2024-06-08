<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>assignment</title>
    <link rel="stylesheet" href="styles.css">
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
                        <li><a href="#">Assignment</a></li>
                        <li><a href="project.php">Project</a></li>
                    </ul>
                </nav>
                <div class="search-profile">
                    <div class="profile-pic"></div>
                </div>
            </header>
        <?php
        require 'config/db.php';

        // Handle deletion
        if (isset($_GET['deleteid'])) {
            $id = mysqli_real_escape_string($conn, $_GET['deleteid']);
            $deleteQuery = "DELETE FROM assignment WHERE AssignmentID = '$id'";
            if (mysqli_query($conn, $deleteQuery)) {
                echo '<script>alert("Assignment deleted successfully!");</script>';
            } else {
                echo '<script>alert("Error: ' . $deleteQuery . '<br>' . mysqli_error($conn) . '");</script>';
            }
            // header('Location:assignment.php');
            // exit();
        }
        ?>

        <h2>assignment Form</h2>

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
                    echo '<td><a class="action-link" href="assignment.php?deleteid=' . urlencode($row['AssignmentID']) . '">Delete</a></td>';
                    // echo '<td><a class="action-link" href="assignment.php?updateid=' . urlencode($row['AssignmentID']) . '">Update</a></td>';
                    echo '<td><a class="action-link"  onclick="update_form(' . htmlspecialchars(json_encode($row)) . ')">Update</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>

        

        
        <!-- INSERT assignment -->
        <form action="insert.php" method="post">
            <h1>INSERT FORM</h1>
            <label for="AssignmentID">assignment ID:</label>
            <input type="text" id="AssignmentID" name="AssignmentID" required>
            <label for="EmployeeID">Employee ID:</label>
            <input type="text" id="EmployeeID" name="EmployeeID" required>
            <label for="ProjectID">Project ID:</label>
            <input type="text" id="ProjectID" name="ProjectID" required>
            <label for="HoursWorked">Hours Worked:</label>
            <input type="text" id="HoursWorked" name="HoursWorked" required>
            <input type="submit" name="submit_assignment" value="Submit">
        </form>
        <script>
            var modal = document.getElementById("myModal");
            var span = document.getElementsByClassName("close")[0];

            function editassignment(AssignmentID, LasttName, ProjectID, HoursWorked) {
                document.getElementById('AssignmentID').value = AssignmentID;
                document.getElementById('EmployeeID').value = EmployeeID;
                document.getElementById('ProjectID').value = ProjectID;
                document.getElementById('HoursWorked').value = HoursWorked;
                modal.style.display = "block";
            }

            span.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
    </div>

    <!-- Modal for Update -->
    <div id="update_form_modal" class="update-form-modal">
        <form id="assignmentForm" action="update.php" method="post">
            <span class="close">&times;</span>
            <h1>UPDATE FORM</h1> 
            <label for="update_AssignmentID">AssignmentID</label>
            <input autocomplete="off" type="text" id="update_AssignmentID" name="update_AssignmentID" readonly style="background-color: rgba(0,0,0,0.2)">
            <label for="update_EmployeeID">EmployeeID</label>
            <select id="update_EmployeeID" name="update_EmployeeID" required>
                <?php
                // Assuming Department table has HoursWorked and DepartmentName
                $departmentQuery = "SELECT EmployeeID, LastName FROM employee"; 
                $departmentResult = mysqli_query($conn, $departmentQuery) or die('error fetching departments');
                while ($row = mysqli_fetch_assoc($departmentResult)) {
                    echo '<option value="' . htmlspecialchars($row['EmployeeID']) . '">' . htmlspecialchars($row['EmployeeID']) . ' - ' . htmlspecialchars($row['LastName']) . '</option>';
                }
                ?>
            </select>
            <label for="update_ProjectID">ProjectID</label>
            <select id="update_ProjectID" name="update_ProjectID" required>
                <?php
                // Assuming Department table has HoursWorked and DepartmentName
                $departmentQuery = "SELECT ProjectID, ProjectName FROM project"; 
                $departmentResult = mysqli_query($conn, $departmentQuery) or die('error fetching departments');
                while ($row = mysqli_fetch_assoc($departmentResult)) {
                    echo '<option value="' . htmlspecialchars($row['ProjectID']) . '">' . htmlspecialchars($row['ProjectID']) . ' - ' . htmlspecialchars($row['ProjectName']) . '</option>';
                }
                ?>
            </select>
            <label for="update_HoursWorked">HoursWorked</label>
            <input autocomplete="off" type="text" id="update_HoursWorked" name="update_HoursWorked" required>
            <br>
            <input type="submit" name="update_assignment" value="Submit">
        </form>
    </div>
    <script>
        function update_form(assignment) {
            console.log("assignment: ", assignment);
            document.getElementById("update_AssignmentID").value = assignment.AssignmentID;
            document.getElementById("update_EmployeeID").value = assignment.EmployeeID;
            document.getElementById("update_ProjectID").value = assignment.ProjectID;
            document.getElementById("update_HoursWorked").value = assignment.HoursWorked;
            document.getElementById("update_form_modal").style.display = "block";
        }

        window.onload = function() {
            var span = document.getElementsByClassName("close")[0];

            span.onclick = function() {
                document.getElementById("update_form_modal").style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == document.getElementById("update_form_modal")) {
                    document.getElementById("update_form_modal").style.display = "none";
                }
            }
        }
    </script>


</body>

</html>
