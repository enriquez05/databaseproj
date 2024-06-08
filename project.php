<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>project</title>
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

        if (isset($_GET['deleteid'])) {
            $id = mysqli_real_escape_string($conn, $_GET['deleteid']);
            $deleteQuery = "DELETE FROM project WHERE ProjectID = '$id'";
            if (mysqli_query($conn, $deleteQuery)) {
                echo '<script>alert("project deleted successfully!");</script>';
            } else {
                echo '<script>alert("Error: ' . $deleteQuery . '<br>' . mysqli_error($conn) . '");</script>';
            }
        }
        ?>

        <h2>project Form</h2>

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
                $projectQuery = "SELECT * FROM project";
                $result = mysqli_query($conn, $projectQuery) or die('error');

                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['ProjectID']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['StartDate']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['EndDate']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['ProjectName']) . '</td>';
                    echo '<td><a class="action-link" href="project.php?deleteid=' . urlencode($row['ProjectID']) . '" onclick="return confirm(\'Are you sure you want to delete this project?\');">Delete</a></td>';
                    echo '<td><a class="action-link" onclick="update_form(' . htmlspecialchars(json_encode($row)) . ')">Update</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>

        <!-- INSERT project -->
        <form id="insertForm" action="insert.php" method="post" onsubmit="return validateInsertForm()">
            <h1>INSERT FORM</h1>
            <label for="ProjectID">Project ID:</label>
            <input type="text" id="ProjectID" name="ProjectID" required>
            <label for="StartDate">Start Date:</label>
            <input type="date" id="StartDate" name="StartDate" required>
            <label for="EndDate">End Date:</label>
            <input type="date" id="EndDate" name="EndDate" required>
            <label for="ProjectName">Project Name:</label>
            <input type="text" id="ProjectName" name="ProjectName" required>
            <input type="submit" name="submit_project" value="Submit">
        </form>
    </div>

    <!-- Modal for Update -->
    <div id="update_form_modal" class="update-form-modal">
        <form id="updateForm" action="update.php" method="post" onsubmit="return validateUpdateForm()">
            <span class="close">&times;</span>
            <h1>UPDATE FORM</h1>
            <label for="update_ProjectID">ProjectID</label>
            <input autocomplete="off" type="text" id="update_ProjectID" name="update_ProjectID" readonly style="background-color: rgba(0,0,0,0.2)">
            <label for="update_StartDate">StartDate</label>
            <input autocomplete="off" type="date" id="update_StartDate" name="update_StartDate" required>
            <label for="update_EndDate">EndDate</label>
            <input autocomplete="off" type="date" id="update_EndDate" name="update_EndDate" required>
            <label for="update_ProjectName">ProjectName</label>
            <input autocomplete="off" type="text" id="update_ProjectName" name="update_ProjectName" required>
            <br>
            <input type="submit" name="update_project" value="Submit">
        </form>
    </div>

    <script>
        function validateInsertForm() {
            const startDate = new Date(document.getElementById("StartDate").value);
            const endDate = new Date(document.getElementById("EndDate").value);

            if (endDate <= startDate) {
                alert("End date must be after the start date and cannot be the same day.");
                return false;
            }
            return true;
        }

        function validateUpdateForm() {
            const startDate = new Date(document.getElementById("update_StartDate").value);
            const endDate = new Date(document.getElementById("update_EndDate").value);

            if (endDate <= startDate) {
                alert("End date must be after the start date and cannot be the same day.");
                return false;
            }
            return true;
        }

        function update_form(project) {
            document.getElementById("update_ProjectID").value = project.ProjectID;
            document.getElementById("update_StartDate").value = project.StartDate;
            document.getElementById("update_EndDate").value = project.EndDate;
            document.getElementById("update_ProjectName").value = project.ProjectName;
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
