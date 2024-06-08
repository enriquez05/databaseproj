<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">SME</div>
            <nav>
                <ul>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Employees</a></li>
                    <li><a href="#">Department</a></li>
                    <li><a href="#">Assignment</a></li>
                    <li><a href="#">Project</a></li>
                </ul>
            </nav>
            <div class="search-profile">
                <input type="text" placeholder="Search">
                <div class="profile-pic"></div>
            </div>
        </header>
        <main>
            <section class="overview">
                <div class="client-overview">
                    <div class="title">Department Overview</div>
                    <div class="chart"></div>
                </div>
                <div class="summary">
                    <div class="total-employees">
                        <div class="number">550</div>
                        <div class="label">Total Employees</div>
                    </div>
                    <div class="total-department">
                        <div class="number">120</div>
                        <div class="label">Client's Feedback</div>
                    </div>
                    <div class="total-assignment">
                        <div class="number">120</div>
                        <div class="label">Client's Feedback</div>
                    </div>
                    <div class="total-project">
                        <div class="number">120</div>
                        <div class="label">Client's Feedback</div>
                    </div>
                </div>
            </section>
            <section class="maps">
                <div class="assignment-map">
                    <div class="title">Assignment Overview</div>
                    <div class="map"></div>
                </div>
                <div class="project-map">
                    <div class="title">Project Overview</div>
                    <div class="map"></div>
                </div>
            </section>
            <section class="employee-list">
                <div class="title">Top Employee List</div>
                <div class="list">
                    <div class="employee title-row">
                        <div class="employee-id">Employee ID</div>
                        <div class="employee-name">Employee</div>
                        <div class="department">Department</div>
                        <div class="work-performance">Work Performance</div>
                    </div>
                    <div class="employee">
                        <div class="employee-id">1020</div>
                        <div class="employee-name">Norma Troy</div>
                        <div class="department">UI/UX Designer</div>
                        <div class="work-performance">
                            <div class="bar" style="width: 75%;"></div>
                            <div class="percentage">75%</div>
                        </div>
                    </div>
                    <div class="employee">
                        <div class="employee-id">1021</div>
                        <div class="employee-name">Thomas Poston</div>
                        <div class="department">Web Designer</div>
                        <div class="work-performance">
                            <div class="bar" style="width: 65%;"></div>
                            <div class="percentage">65%</div>
                        </div>
                    </div>
                    <div class="employee">
                        <div class="employee-id">1022</div>
                        <div class="employee-name">Kimberly Andersen</div>
                        <div class="department">React Native Developer</div>
                        <div class="work-performance">
                            <div class="bar" style="width: 50%;"></div>
                            <div class="percentage">50%</div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <?php
    include('config/db.php');
    ?>
</body>
</html>
