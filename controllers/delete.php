<?php include("../config/init.php"); ?>

<?php

$employee = Employee::find_by_id($_GET['emp_no']);

if($employee) {

    $employee->delete();

    redirect("../index.php");

}

?>
