<?php include("../config/init.php"); ?>

<?php

$employee = Employee::find_by_id($_POST['emp_no']);

if($employee) {

    $employee->birth_date = $_POST['birth_date'];
    $employee->first_name = $_POST['first_name'];
    $employee->last_name = $_POST['last_name'];
    $employee->gender = $_POST['gender'];
    $employee->hire_date = $_POST['hire_date'];

    $employee->save();

    redirect("../index.php");

}

?>
