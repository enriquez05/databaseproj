<?php
include('config/db.php');


if (isset($_POST['update_employee'])) {
    // Validate and sanitize the input data
    $EmployeeID = mysqli_real_escape_string($conn, $_POST['update_EmployeeID']);
    $LastName = mysqli_real_escape_string($conn, $_POST['update_LastName']);
    $FirstName = mysqli_real_escape_string($conn, $_POST['update_FirstName']);
    $DepartmentID = mysqli_real_escape_string($conn, $_POST['update_DepartmentID']);

    // UPDATE into database
    $updateQuery = "UPDATE employee SET LastName='$LastName', FirstName='$FirstName', DepartmentID='$DepartmentID' WHERE EmployeeID='$EmployeeID'";
    if (mysqli_query($conn, $updateQuery)) {
        echo '<script>alert("Employee updated successfully!");</script>';
        header('Location: employee.php');
        exit();
    } else {
        echo '<script>alert("Error: ' . $updateQuery . '<br>' . mysqli_error($conn) . '");</script>';
    }
}

if (isset($_POST['update_project'])) {
    // Validate and sanitize the input data
    $ProjectID = mysqli_real_escape_string($conn, $_POST['update_ProjectID']);
    $StartDate = mysqli_real_escape_string($conn, $_POST['update_StartDate']);
    $EndDate = mysqli_real_escape_string($conn, $_POST['update_EndDate']);
    $ProjectName = mysqli_real_escape_string($conn, $_POST['update_ProjectName']);

    // UPDATE into database
    $updateQuery = "UPDATE project SET StartDate='$StartDate', EndDate='$EndDate', ProjectName='$ProjectName' WHERE ProjectID='$ProjectID'";
    if (mysqli_query($conn, $updateQuery)) {
        echo '<script>alert("Project updated successfully!");</script>';
        header('Location: project.php');
        exit();
    } else {
        echo '<script>alert("Error: ' . $updateQuery . '<br>' . mysqli_error($conn) . '");</script>';
    }
}

if (isset($_POST['update_department'])) {
    // Validate and sanitize the input data
    $DepartmentID = mysqli_real_escape_string($conn, $_POST['update_DepartmentID']);
    $DepartmentName = mysqli_real_escape_string($conn, $_POST['update_DepartmentName']);
    $ManagerID = mysqli_real_escape_string($conn, $_POST['update_ManagerID']);

    // UPDATE into database
    $updateQuery = "UPDATE department SET DepartmentName='$DepartmentName', ManagerID='$ManagerID' WHERE DepartmentID='$DepartmentID'";
    if (mysqli_query($conn, $updateQuery)) {
        echo '<script>alert("Department updated successfully!");</script>';
        header('Location: department.php');
        exit();
    } else {
        echo '<script>alert("Error: ' . $updateQuery . '<br>' . mysqli_error($conn) . '");</script>';
    }
}

if (isset($_POST['update_assignment'])) {
    // Validate and sanitize the input data
    $AssignmentID = mysqli_real_escape_string($conn, $_POST['update_AssignmentID']);
    $EmployeeID = mysqli_real_escape_string($conn, $_POST['update_EmployeeID']);
    $ProjectID = mysqli_real_escape_string($conn, $_POST['update_ProjectID']);
    $HoursWorked = mysqli_real_escape_string($conn, $_POST['update_HoursWorked']);

    // UPDATE into database
    $updateQuery = "UPDATE assignment SET EmployeeID ='$EmployeeID', ProjectID='$ProjectID', HoursWorked='$HoursWorked' WHERE AssignmentID='$AssignmentID'";
    if (mysqli_query($conn, $updateQuery)) {
        echo '<script>alert("Assignment updated successfully!");</script>';
        header('Location: assignment.php');
        exit();
    } else {
        echo '<script>alert("Error: ' . $updateQuery . '<br>' . mysqli_error($conn) . '");</script>';
    }
}


