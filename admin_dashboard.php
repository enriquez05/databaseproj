<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="d-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo"><i class="fas fa-building"></i> SME</div>
            <nav>
                <ul>
                    <li><a href="#"><i class="fas fa-tachometer-alt"></i> Admin Dashboard</a></li>
                    <li><a href="employee.php"><i class="fas fa-user"></i> Employees</a></li>
                    <li><a href="department.php"><i class="fas fa-sitemap"></i> Department</a></li>
                    <li><a href="assignment.php"><i class="fas fa-tasks"></i> Assignment</a></li>
                    <li><a href="project.php"><i class="fas fa-project-diagram"></i> Project</a></li>
                </ul>
            </nav>
            <div class="profile-pic">
                <button id="logout_btn"><i class="fas fa-sign-out-alt"></i> LOGOUT</button>
            </div>
        </header>
        <main>
            <section class="overview">
                <div class="client-overview">
                    <div class="title"><i class="fas fa-chart-bar"></i> Department Overview</div>
                    <div class="chart">
                        <canvas id="departmentChart"></canvas>
                    </div>
                </div>
                <div class="summary">
                    <div class="total-employees">
                        <div id="employee_tnum" class="number"></div>
                        <div class="label"><i class="fas fa-user-friends"></i> Employees</div>
                    </div>
                    <div class="total-department">
                        <div id="department_tnum" class="number"></div>
                        <div class="label"><i class="fas fa-building"></i> Departments</div>
                    </div>
                </div>
            </section>
            <section class="maps">
                <div class="summary">
                    <div class="total-assignment">
                        <div id="assignment_tnum" class="number"></div>
                        <div class="label"><i class="fas fa-tasks"></i> Assignments</div>
                    </div>
                    <div class="total-project">
                        <div id="project_tnum" class="number"></div>
                        <div class="label"><i class="fas fa-project-diagram"></i> Projects</div>
                    </div>
                </div>
                <div class="project-map">
                    <div class="title"><i class="fas fa-map"></i> Project Overview</div>
                    <div class="chart">
                        <canvas id="projectChart"></canvas>
                    </div>
                </div>
            </section>
            <section class="employee-list"> 
                <div class="list">
                    <div class="title"><i class="fas fa-list"></i> Top Employee List</div>
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
                        <div id="topA_FirstName" class="employee-name"></div>
                        <div id="topA_LastName" class="employee-name"></div>
                        <div id="topA_DepartmentID" class="department"></div>
                        <div id="topA_ProjectID" class="department"></div>
                        <div id="topA_AssignmentID" class="department"></div>
                        <div id="topA_HoursWorked" class="department"></div>
                    </div>
                    <div class="employee">
                        <div id="topB_EmployeeID" class="employee-id"></div>
                        <div id="topB_FirstName" class="employee-name"></div>
                        <div id="topB_LastName" class="employee-name"></div>
                        <div id="topB_DepartmentID" class="department"></div>
                        <div id="topB_ProjectID" class="department"></div>
                        <div id="topB_AssignmentID" class="department"></div>
                        <div id="topB_HoursWorked" class="department"></div>
                    </div>
                    <div class="employee">
                        <div id="topC_EmployeeID" class="employee-id"></div>
                        <div id="topC_FirstName" class="employee-name"></div>
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

    // Queries for fetching data
    $queries = [
        "total_employees" => "SELECT COUNT(*) AS total_employees FROM employee",
        "total_department" => "SELECT COUNT(*) AS total_department FROM department",
        "total_assignment" => "SELECT COUNT(*) AS total_assignment FROM assignment",
        "total_project" => "SELECT COUNT(*) AS total_project FROM project",
        "departments_chart" => "SELECT DepartmentName, COUNT(*) AS count FROM department GROUP BY DepartmentName",
        "project_chart" => "SELECT ProjectName, COUNT(*) AS count FROM project GROUP BY ProjectName",
        "top_employees" => "
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
            LIMIT 3"
    ];

    foreach ($queries as $key => $query) {
        $result = mysqli_query($conn, $query);
        if ($key === "departments_chart" || $key === "project_chart" || $key === "top_employees") {
            ${$key} = [];
            while ($row = mysqli_fetch_assoc($result)) {
                ${$key}[] = $row;
            }
        } else {
            $row = mysqli_fetch_assoc($result);
            ${$key} = json_encode($row[array_key_first($row)]);
        }
    }
    ?>
    <script>
        // Assigning PHP values to JavaScript variables
        var total_employee_num = <?php echo $total_employees; ?>;
        var total_department_num = <?php echo $total_department; ?>;
        var total_assignment_num = <?php echo $total_assignment; ?>;
        var total_project_num = <?php echo $total_project; ?>;

        document.getElementById("employee_tnum").textContent = total_employee_num;
        document.getElementById("department_tnum").textContent = total_department_num;
        document.getElementById("assignment_tnum").textContent = total_assignment_num;
        document.getElementById("project_tnum").textContent = total_project_num;

        // Department overview chart
        var ctxDepartment = document.getElementById('departmentChart').getContext('2d');
        var departmentNames = <?php echo json_encode(array_column($departments_chart, 'DepartmentName')); ?>;
        var departmentCounts = <?php echo json_encode(array_column($departments_chart, 'count')); ?>;

        var departmentChart = new Chart(ctxDepartment, {
            type: 'bar',
            data: {
                labels: departmentNames,
                datasets: [{
                    label: '# of Departments',
                    data: departmentCounts,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
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

        // Project overview chart
        var ctxProject = document.getElementById('projectChart').getContext('2d');
        var projectNames = <?php echo json_encode(array_column($project_chart, 'ProjectName')); ?>;
        var projectCounts = <?php echo json_encode(array_column($project_chart, 'count')); ?>;

        var projectChart = new Chart(ctxProject, {
            type: 'line',
            data: {
                labels: projectNames,
                datasets: [{
                    label: '# of Projects',
                    data: projectCounts,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
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

        // Top 3 employees
        const top_employees = <?php echo json_encode($top_employees); ?>;
        const topA_employee = top_employees[0];
        const topB_employee = top_employees[1];
        const topC_employee = top_employees[2];

        // Updating DOM with top employee details
        const setTopEmployeeDetails = (prefix, employee) => {
            document.getElementById(prefix + "EmployeeID").textContent = employee['EmployeeID'];
            document.getElementById(prefix + "FirstName").textContent = employee['FirstName'];
            document.getElementById(prefix + "LastName").textContent = employee['LastName'];
            document.getElementById(prefix + "DepartmentID").textContent = employee['DepartmentID'];
            document.getElementById(prefix + "ProjectID").textContent = employee['ProjectID'];
            document.getElementById(prefix + "AssignmentID").textContent = employee['AssignmentID'];
            document.getElementById(prefix + "HoursWorked").textContent = employee['HoursWorked'];
        };

        setTopEmployeeDetails("topA_", topA_employee);
        setTopEmployeeDetails("topB_", topB_employee);
        setTopEmployeeDetails("topC_", topC_employee);

        // Logout functionality
        document.getElementById('logout_btn').addEventListener("click", function() {
            window.location.href = 'guest_dashboard.php';
        });
    </script>
</body>
</html>
