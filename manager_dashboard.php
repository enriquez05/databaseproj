<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">SME</div>
            <nav>
            <ul>
                    <li><a href="#">Manager Dashboard</a></li>
                    <li><a href="#">Employees</a></li>
                    <li><a href="#">Department</a></li>
                    <li><a href="#">Assignment</a></li>
                    <li><a href="#">Project</a></li>
                </ul>
            </nav>
            <div class="profile-pic">
                <button id="logout_btn">LOGOUT</button>
            </div>
        </header>
        <main>
            <section class="overview">
                <div class="client-overview">
                    <div class="title">Department Overview</div>
                    <div class="chart">
                        <canvas id="departmentChart"></canvas>
                    </div>
                </div>
                <div class="summary">
                    <div class="total-employees">
                        <div id="employee_tnum" class="number"></div>
                        <div class="label">Employees</div>
                    </div>
                    <div class="total-department">
                        <div id="department_tnum" class="number"></div>
                        <div class="label">Departments</div>
                    </div>
                </div>
            </section>
            <section class="maps">
                <div class="summary">
                    <div class="total-assignment">
                        <div id="assignment_tnum" class="number"></div>
                        <div class="label">Assignments</div>
                    </div>
                    <div class="total-project">
                        <div id="project_tnum" class="number"></div>
                        <div class="label">Projects</div>
                    </div>
                </div>
                <div class="project-map">
                    <div class="title">Project Overview</div>
                    <div class="chart">
                        <canvas id="projectChart"></canvas>
                    </div>
                </div>
            </section>
            <section class="employee-list"> 
                <div class="list">
                <div class="title">Top Employee List</div>
                    <div class="employee title-row">
                        <div class="employee-id">Employee ID</div>
                        <div class="employee-name">First Name</div>
                        <div class="employee-name">Last Name</div>
                        <div class="department">Department ID</div>
                        <div class="department">Project ID</div>
                        <div class="department">Assignment ID</div>
                        <div class="department">Hours Worked</div>
                    </div>
                    <div class="employee">
                        <div id="topA_EmployeeID" class="employee-id"></div>
                        <div id="topA_FirstName"  class="employee-name"></div>
                        <div id="topA_LastName" class="employee-name"></div>
                        <div id="topA_DepartmentID" class="department"></div>
                        <div id="topA_ProjectID" class="department"></div>
                        <div id="topA_AssignmentID" class="department"></div>
                        <div id="topA_HoursWorked" class="department"></div>
                    </div>
                    <div class="employee">
                        <div id="topB_EmployeeID" class="employee-id"></div>
                        <div id="topB_FirstName"  class="employee-name"></div>
                        <div id="topB_LastName" class="employee-name"></div>
                        <div id="topB_DepartmentID" class="department"></div>
                        <div id="topB_ProjectID" class="department"></div>
                        <div id="topB_AssignmentID" class="department"></div>
                        <div id="topB_HoursWorked" class="department"></div>
                    </div>
                    <div class="employee">
                        <div id="topC_EmployeeID" class="employee-id"></div>
                        <div id="topC_FirstName"  class="employee-name"></div>
                        <div id="topC_LastName" class="employee-name"></div>
                        <div id="topC_DepartmentID" class="department"></div>
                        <div id="topC_ProjectID" class="department"></div>
                        <div id="topC_AssignmentID" class="department"></div>
                        <div id="topC_HoursWorked" class="department"></div>
                    </div>
                    
                </div>
            </section>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <?php
    include('config/db.php');
    // Query to get the total number of employees
    $query = "SELECT COUNT(*) AS total_employees FROM employee";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $total_employees = json_encode($row['total_employees']);

    // Query to get the total number of department
    $query = "SELECT COUNT(*) AS total_department FROM department";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $total_department = json_encode($row['total_department']);

    // Query to get the total number of assignment
    $query = "SELECT COUNT(*) AS total_assignment FROM assignment";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $total_assignment = json_encode($row['total_assignment']);

    // Query to get the total number of project
    $query = "SELECT COUNT(*) AS total_project FROM project";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $total_project = json_encode($row['total_project']);

    // Query to get the count of each department name
    $query = "SELECT DepartmentName, COUNT(*) AS count FROM department GROUP BY DepartmentName";
    $result = mysqli_query($conn, $query);

    $departments_chart = [];
    $counts_dept_chart = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $departments_chart[] = $row['DepartmentName'];
        $counts_dept_chart[] = $row['count'];
    }

    // Query to get the count of each project name
    $query = "SELECT ProjectName, COUNT(*) AS count FROM project GROUP BY ProjectName";
    $result = mysqli_query($conn, $query);

    $project_chart = [];
    $counts_proj_chart = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $project_chart[] = $row['ProjectName'];
        $counts_proj_chart[] = $row['count'];
    }

    // Query to get the top 3 highest worked hours with employee details
    $query = "
        SELECT 
            a.AssignmentID, 
            a.EmployeeID, 
            a.ProjectID, 
            a.HoursWorked, 
            e.FirstName, 
            e.LastName, 
            e.DepartmentID 
        FROM 
            assignment a 
        JOIN 
            employee e 
        ON 
            a.EmployeeID = e.EmployeeID 
        ORDER BY 
            a.HoursWorked DESC 
        LIMIT 3
    ";

    $result = mysqli_query($conn, $query);

    $topAssignmentsWithEmployeeDetails = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $topAssignmentsWithEmployeeDetails[] = $row;
    }

    ?>

    <script>
        var total_employee_num = <?php echo $total_employees; ?>;
        var total_department_num = <?php echo $total_department; ?>;
        var total_assignment_num = <?php echo $total_assignment; ?>;
        var total_project_num = <?php echo $total_project; ?>;

        document.getElementById("employee_tnum").textContent = total_employee_num;
        document.getElementById("department_tnum").textContent = total_department_num;
        document.getElementById("assignment_tnum").textContent = total_assignment_num;
        document.getElementById("project_tnum").textContent = total_project_num;

        // Department overview
        // Prepare data for Chart.js
        var ctxDepartment = document.getElementById('departmentChart').getContext('2d');
        var departmentNames = <?php echo json_encode($departments_chart); ?>;
        var departmentCounts = <?php echo json_encode($counts_dept_chart); ?>;
        
        // Create the bar chart
        var departmentChart = new Chart(ctxDepartment, {
            type: 'bar',
            data: {
                labels: departmentNames,
                datasets: [{
                    label: '# of Departments',
                    data: departmentCounts,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#fff'
                        }
                    }
                }
            }
        });

        // Project overview
        // Prepare data for Chart.js
        var ctxProject = document.getElementById('projectChart').getContext('2d');
        var projectNames = <?php echo json_encode($project_chart); ?>;
        var projectCounts = <?php echo json_encode($counts_proj_chart); ?>;
        
        // Create the pie chart
        var projectChart = new Chart(ctxProject, {
            type: 'line',
            data: {
                labels: projectNames,
                datasets: [{
                    label: '# of Projects',
                    data: projectCounts,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: '#fff'
                        }
                    }
                }
            }
        });


        // top 3 employee
        const top_employees = <?php echo json_encode($topAssignmentsWithEmployeeDetails); ?>;
        const topA_employee = top_employees[0];
        const topB_employee = top_employees[1];
        const topC_employee = top_employees[2];

        // TOP1
        document.getElementById("topA_EmployeeID").textContent = topA_employee['EmployeeID'];
        document.getElementById("topA_FirstName").textContent = topA_employee['FirstName'];
        document.getElementById("topA_LastName").textContent = topA_employee['LastName'];
        document.getElementById("topA_DepartmentID").textContent = topA_employee['DepartmentID'];
        document.getElementById("topA_ProjectID").textContent = topA_employee['ProjectID'];
        document.getElementById("topA_AssignmentID").textContent = topA_employee['AssignmentID'];
        document.getElementById("topA_HoursWorked").textContent = topA_employee['HoursWorked'];


        // TOP2
        document.getElementById("topB_EmployeeID").textContent = topB_employee['EmployeeID'];
        document.getElementById("topB_FirstName").textContent = topB_employee['FirstName'];
        document.getElementById("topB_LastName").textContent = topB_employee['LastName'];
        document.getElementById("topB_DepartmentID").textContent = topB_employee['DepartmentID'];
        document.getElementById("topB_ProjectID").textContent = topB_employee['ProjectID'];
        document.getElementById("topB_AssignmentID").textContent = topB_employee['AssignmentID'];
        document.getElementById("topB_HoursWorked").textContent = topB_employee['HoursWorked'];

        // TOP3
        document.getElementById("topC_EmployeeID").textContent = topC_employee['EmployeeID'];
        document.getElementById("topC_FirstName").textContent = topC_employee['FirstName'];
        document.getElementById("topC_LastName").textContent = topC_employee['LastName'];
        document.getElementById("topC_DepartmentID").textContent = topC_employee['DepartmentID'];
        document.getElementById("topC_ProjectID").textContent = topC_employee['ProjectID'];
        document.getElementById("topC_AssignmentID").textContent = topC_employee['AssignmentID'];
        document.getElementById("topC_HoursWorked").textContent = topC_employee['HoursWorked'];

        // LOGOUT
        document.getElementById('logout_btn').addEventListener("click", function(){
            window.location.href = 'guest_dashboard.php';
        })
    </script>

</body>
</html>
