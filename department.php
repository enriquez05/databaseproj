<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>department</title>
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
                        <li><a href="assignment.php">Assignment</a></li>
                        <li><a href="#">Project</a></li>
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
            $deleteQuery = "DELETE FROM department WHERE DepartmentID = '$id'";
            if (mysqli_query($conn, $deleteQuery)) {
                echo '<script>alert("department deleted successfully!");</script>';
            } else {
                echo '<script>alert("Error: ' . $deleteQuery . '<br>' . mysqli_error($conn) . '");</script>';
            }
            // header('Location:department.php');
            // exit();
        }
        ?>

        <h2>department Form</h2>

        <table>
            <thead>
                <tr>
                    <th>DepartmentID</th>
                    <th>DepartmentName</th>
                    <th>ManagerID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $departmentQuery = "SELECT * FROM department";
                $result = mysqli_query($conn, $departmentQuery) or die('error');

                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['DepartmentID']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['DepartmentName']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['ManagerID']) . '</td>';    
                    echo '<td><a class="action-link" href="department.php?deleteid=' . urlencode($row['DepartmentID']) . '">Delete</a></td>';
                    // echo '<td><a class="action-link" href="department.php?updateid=' . urlencode($row['DepartmentID']) . '">Update</a></td>';
                    echo '<td><a class="action-link"  onclick="update_form(' . htmlspecialchars(json_encode($row)) . ')">Update</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>

        
        <!-- INSERT department -->
        <form action="insert.php" method="post">
            <h1>INSERT FORM</h1>
            <label for="d_insert_DepartmentID">department ID:</label>
            <input type="text" id="d_insert_DepartmentID" name="d_insert_DepartmentID" required>
            <label for="d_insert_DepartmentName">Department Name:</label>
            <input type="text" id="d_insert_DepartmentName" name="d_insert_DepartmentName" required>
            <label for="d_insert_ManagerID">Manager ID:</label>
            <input type="text" id="d_insert_ManagerID" name="d_insert_ManagerID" required>
            <input type="submit" name="submit_department" value="Submit">
        </form>
        <script>
            var modal = document.getElementById("myModal");
            var span = document.getElementsByClassName("close")[0];

            function editdepartment(DepartmentID, DepartmentName, ManagerID) {
                document.getElementById('DepartmentID').value = DepartmentID;
                document.getElementById('DepartmentName').value = DepartmentName;
                document.getElementById('ManagerID').value = ManagerID;
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
        <form id="departmentForm" action="update.php" method="post">
            <span class="close">&times;</span>
            <h1>UPDATE FORM</h1> 
            <label for="update_DepartmentID">DepartmentID</label>
            <input autocomplete="off" type="text" id="update_DepartmentID" name="update_DepartmentID" readonly style="background-color: rgba(0,0,0,0.2)">
            <label for="update_DepartmentName">DepartmentName</label>
            <input autocomplete="off" type="text" id="update_DepartmentName" name="update_DepartmentName" required>
            <label for="update_ManagerID">ManagerID</label>
            <select id="update_ManagerID" name="update_ManagerID" required>
                <?php
                // Assuming Department table has DepartmentID and DepartmentName
                $departmentQuery = "SELECT EmployeeID, LastName FROM employee"; 
                $departmentResult = mysqli_query($conn, $departmentQuery) or die('error fetching departments');
                while ($row = mysqli_fetch_assoc($departmentResult)) {
                    echo '<option value="' . htmlspecialchars($row['EmployeeID']) . '">' . htmlspecialchars($row['EmployeeID']) . ' - ' . htmlspecialchars($row['LastName']) . '</option>';
                }
                ?>
            </select>
            <br>
            <input type="submit" name="update_department" value="Submit">
        </form>
    </div>
    <script>
        function update_form(department) {
            console.log("department: ", department);
            document.getElementById("update_DepartmentID").value = department.DepartmentID;
            document.getElementById("update_DepartmentName").value = department.DepartmentName;
            document.getElementById("update_ManagerID").value = department.ManagerID;
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
