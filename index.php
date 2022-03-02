<?php include("components/header.php"); ?>

<body class="sb-nav-fixed">

<?php include("components/topnav.php") ?>

<div id="layoutSidenav">

    <?php include("components/sidenav.php") ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Dolgozók adatai</h1>
                <!--<ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tables</li>
                </ol>-->
                <!--<div class="card mb-4">
                    <div class="card-body">
                        DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                        <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                        .
                    </div>
                </div>-->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Dolgozók adatai
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <?php
                            $employees = Employee::find_by_query("
                                SELECT e.*, d.dept_name, cse.salary, cte.title
                                FROM employees e
                                
                                LEFT JOIN current_dept_emp cde
                                    ON e.emp_no = cde.emp_no
                                LEFT JOIN departments d
                                    ON cde.dept_no = d.dept_no
                                    
                                LEFT JOIN current_salary_emp cse
                                    ON e.emp_no = cse.emp_no
                                    
                                LEFT JOIN current_title_emp cte
                                    ON e.emp_no = cte.emp_no
                                    
                                LIMIT 20
                            ");
                            ?>

                            <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Azonosító</th>
                                    <th>Születés</th>
                                    <th>Keresztnév</th>
                                    <th>Vezetéknév</th>
                                    <th>Neme</th>
                                    <th>Felvétel</th>
                                    <th>Aktuális osztály</th>
                                    <th>Fizetés</th>
                                    <th>Aktuális beosztás</th>
                                    <th>Szerkesztés</th>
                                    <th>Törlés</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Azonosító</th>
                                    <th>Születés</th>
                                    <th>Keresztnév</th>
                                    <th>Vezetéknév</th>
                                    <th>Neme</th>
                                    <th>Felvétel</th>
                                    <th>Aktuális osztály</th>
                                    <th>Fizetés</th>
                                    <th>Aktuális beosztás</th>
                                    <th>Szerkesztés</th>
                                    <th>Törlés</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php foreach($employees as $employee) : ?>
                                <tr>
                                    <td><?php echo $employee->emp_no; ?></td>
                                    <td><?php echo $employee->birth_date; ?></td>
                                    <td><?php echo $employee->first_name; ?></td>
                                    <td><?php echo $employee->last_name; ?></td>
                                    <td><?php echo $employee->gender; ?></td>
                                    <td><?php echo $employee->hire_date; ?></td>
                                    <td><?php echo $employee->dept_name; ?></td>
                                    <td><?php echo $employee->salary; ?></td>
                                    <td><?php echo $employee->title; ?></td>
                                    <td><a href="edit.php?emp_no=<?php echo $employee->emp_no; ?>" class="btn btn-primary" role="button">Szerkesztés</a></td>
                                    <td>
                                        <form action="controllers/delete.php" method="post">
                                        <input type="hidden" name="emp_no" id="emp_no" value="<?php echo $employee->emp_no; ?>">
                                        <input type="submit" class="btn btn-danger" value="Törlés">
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?php include("components/footer_html.php") ?>

    </div>
</div>

<?php include("components/footer.php") ?>

</body>
</html>
