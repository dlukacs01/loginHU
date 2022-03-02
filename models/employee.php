<?php

//öröklés a Db_object Class-tól
class Employee extends Db_object {

	protected static $db_table = "employees";

	// CRUD-hoz ezek kellenek (db fields)
	protected static $db_table_fields = array('birth_date', 'first_name', 'last_name', 'gender', 'hire_date');

	// property names must match db column names
	public $emp_no;
	public $birth_date;
	public $first_name;
	public $last_name;
	public $gender;
	public $hire_date;

	public $dept_name;
    public $salary;
    public $title;

} // End of Class Employee

?>