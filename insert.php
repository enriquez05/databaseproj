<?php
include('config/db.php');

// INSERT FUNCTIONS
if (isset($_POST['submit_employee'])) {
    // Validate and sanitize the input data
    $EmployeeID = mysqli_real_escape_string($conn, $_POST['e_insert_EmployeeID']);
    $LastName = mysqli_real_escape_string($conn, $_POST['insert_LastName']);
    $FirstName = mysqli_real_escape_string($conn, $_POST['insert_FirstName']);
    $DepartmentID = mysqli_real_escape_string($conn, $_POST['e_insert_DepartmentID']);
    $username_e = mysqli_real_escape_string($conn, $_POST['e_insert_username']);
    $password_e = mysqli_real_escape_string($conn, $_POST['e_insert_password']);

    // Insert into database
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt1 = $conn->prepare($sql);
    $stmt1->bind_param("ss", $username_e, $password_e);

    // Execute the first query
    if ($stmt1->execute()) {
        // Execute the second query
        $user_id = $stmt1->insert_id;
        $stmt1->close();

        $sql = "INSERT INTO employee (EmployeeID, LastName, FirstName, DepartmentID, user_id) VALUES (?, ?, ?, ?, ?)";
        $stmt2 = $conn->prepare($sql);
        $stmt2->bind_param("ssssi", $EmployeeID, $LastName, $FirstName, $DepartmentID, $user_id);

        if ($stmt2->execute()) {
            echo '<script>alert("Employee added successfully!");</script>';
            header('Location: employee.php');
            exit();
        } else {
            echo '<script>alert("Error: ' . $stmt2->error . '");</script>';
        }
    } else {
        echo '<script>alert("Error: ' . $stmt1->error . '");</script>';
    }

    // Close the statements
    
    $stmt2->close();
}
if (isset($_POST['submit_department'])) {
    // Validate and sanitize the input data
    $DepartmentID = mysqli_real_escape_string($conn, $_POST['d_insert_DepartmentID']);
    $DepartmentName = mysqli_real_escape_string($conn, $_POST['d_insert_DepartmentName']);
    $ManagerID = mysqli_real_escape_string($conn, $_POST['d_insert_ManagerID']);

    // Insert into database
    $setQuery = "INSERT INTO department (DepartmentID, DepartmentName, ManagerID) VALUES ('$DepartmentID', '$DepartmentName', '$ManagerID')";
    if (mysqli_query($conn, $setQuery)) {
        echo '<script>alert("Department added successfully!");</script>';
        header('Location: department.php');
        exit();
    } else {
        echo '<script>alert("Error: ' . $setQuery . '<br>' . mysqli_error($conn) . '");</script>';
    }
}
if (isset($_POST['submit_assignment'])) {
    // Validate and sanitize the input data
    $AssignmentID = mysqli_real_escape_string($conn, $_POST['AssignmentID']);
    $EmployeeID = mysqli_real_escape_string($conn, $_POST['EmployeeID']);
    $ProjectID = mysqli_real_escape_string($conn, $_POST['ProjectID']);
    $HoursWorked = mysqli_real_escape_string($conn, $_POST['HoursWorked']);

    // Insert into database
    $setQuery = "INSERT INTO assignment (AssignmentID, EmployeeID, ProjectID, HoursWorked) VALUES ('$AssignmentID', '$EmployeeID', '$ProjectID', '$HoursWorked')";
    if (mysqli_query($conn, $setQuery)) {
        echo '<script>alert("Assignment added successfully!");</script>';
        header('Location: assignment.php');
        exit();
    } else {
        echo '<script>alert("Error: ' . $setQuery . '<br>' . mysqli_error($conn) . '");</script>';
    }
}
if (isset($_POST['submit_project'])) {
    // Validate and sanitize the input data
    $ProjectID = mysqli_real_escape_string($conn, $_POST['ProjectID']);
    $StartDate = mysqli_real_escape_string($conn, $_POST['StartDate']);
    $EndDate = mysqli_real_escape_string($conn, $_POST['EndDate']);
    $ProjectName = mysqli_real_escape_string($conn, $_POST['ProjectName']);

    // Insert into database
    $setQuery = "INSERT INTO project (ProjectID, StartDate, EndDate, ProjectName) VALUES ('$ProjectID', '$StartDate', '$EndDate', '$ProjectName')";
    if (mysqli_query($conn, $setQuery)) {
        echo '<script>alert("Project added successfully!");</script>';
        header('Location: project.php');
        exit();
    } else {
        echo '<script>alert("Error: ' . $setQuery . '<br>' . mysqli_error($conn) . '");</script>';
    }
}