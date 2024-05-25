<?php
include('config/db.php');

if (isset($_POST['submit_employee'])) {
    // Validate and sanitize the input data
    $EmployeeID = mysqli_real_escape_string($conn, $_POST['EmployeeID']);
    $LastName = mysqli_real_escape_string($conn, $_POST['LastName']);
    $FirstName = mysqli_real_escape_string($conn, $_POST['FirstName']);
    $DepartmentID = mysqli_real_escape_string($conn, $_POST['DepartmentID']);

    // Insert into database
    $setQuery = "INSERT INTO employee (EmployeeID, LastName, FirstName, DepartmentID) VALUES ('$EmployeeID', '$LastName', '$FirstName', '$DepartmentID')";
    if (mysqli_query($conn, $setQuery)) {
        echo '<script>alert("Employee added successfully!");</script>';
        header('Location: employee.php');
        exit();
    } else {
        echo '<script>alert("Error: ' . $setQuery . '<br>' . mysqli_error($conn) . '");</script>';
    }
}
if (isset($_POST['submit_department'])) {
    // Validate and sanitize the input data
    $DepartmentID = mysqli_real_escape_string($conn, $_POST['DepartmentID']);
    $DepartmentName = mysqli_real_escape_string($conn, $_POST['DepartmentName']);
    $ManagerID = mysqli_real_escape_string($conn, $_POST['ManagerID']);

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
