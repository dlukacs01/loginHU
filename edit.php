<?php include("components/header.php"); ?>

<body class="sb-nav-fixed">

<?php include("components/topnav.php") ?>

<div id="layoutSidenav">

    <?php include("components/sidenav.php") ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Szerkesztés</h1>

                <?php
                if(empty($_GET['emp_no'])){
                    redirect("index.php");
                }else{
                    $employee = Employee::find_by_id($_GET['emp_no']);
                }
                ?>

                <form action="controllers/update.php" method="post">
                    <input type="hidden" name="emp_no" id="emp_no" value="<?php echo $employee->emp_no; ?>">
                    <div class="form-group">
                        <label for="birth_date">Születés:</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" value="<?php echo $employee->birth_date; ?>">
                    </div>
                    <div class="form-group">
                        <label for="first_name">Keresztnév:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $employee->first_name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Vezetéknév:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $employee->last_name; ?>">
                    </div>
                    <div class="form-check">
                        <label class="form-check-label" for="male">
                            <input
                                type="radio"
                                class="form-check-input"
                                id="male"
                                name="gender"
                                value="M"
                                <?php echo ($employee->gender=="M") ? "checked" : "" ?>
                            >Férfi
                        </label>
                    </div>
                    <div class="form-group form-check">
                        <label class="form-check-label" for="female">
                            <input
                                type="radio"
                                class="form-check-input"
                                id="female"
                                name="gender"
                                value="F"
                                <?php echo ($employee->gender=="F") ? "checked" : "" ?>
                            >Nő
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="hire_date">Felvétel:</label>
                        <input type="date" class="form-control" id="hire_date" name="hire_date" value="<?php echo $employee->hire_date; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Mentés</button>
                </form>

            </div>
        </main>

        <?php include("components/footer_html.php") ?>

    </div>
</div>

<?php include("components/footer.php") ?>

</body>
</html>
