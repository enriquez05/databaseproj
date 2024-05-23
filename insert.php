    <!-- to Add Book -->
    <?php
        include('config/db.php');
        if (isset($_POST['submit_employee'])) {
            // Get form data
            $EmployeeID= $_POST['EmployeeID'];
            $LastName= $_POST['LastName'];
            $FirstName= $_POST['FirstName'];
            $DepartmentID= $_POST['DepartmentID'];

            // Validate and sanitize the input data as necessary
            $EmployeeID = mysqli_real_escape_string($conn, $EmployeeID);
            $LastName = mysqli_real_escape_string($conn, $LastName);
            $FirstName = mysqli_real_escape_string($conn, $FirstName);
            $DepartmentID= mysqli_real_escape_string($conn, $DepartmentID);

            // Insert into database
            $setQuery = "INSERT INTO employee(EmployeeID, LastName, FirstName, DepartmentID) VALUES ('$EmployeeID', '$LastName', '$FirstName', '$DepartmentID');";
            if (mysqli_query($conn, $setQuery)) {
                header('Location: index_employee.php'); 
                exit();

            } else {
                echo '<script>alert("Error: ' . $setQuery . '<br>' . mysqli_error($conn) . '");</script>';
            }
        }
    ?>