<?php


class Db_object {

	public static function find_all() {

		// LATE STATIC BINDING
		return static::find_by_query("SELECT * FROM " . static::$db_table . " ");

	}

	public static function find_by_id($id) {

		global $database; // so we can use the db object here

		$the_result_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE emp_no = $id LIMIT 1");

		return !empty($the_result_array) ? array_shift($the_result_array) : false;

	}

	public static function find_by_query($sql) {

		global $database;

		$result_set = $database->query($sql);
		$the_object_array = array();

		// objektumok létrehozása db alapján
		while ($row = mysqli_fetch_array($result_set)) {
			$the_object_array[] = static::instantiation($row);
		}

		return $the_object_array;

	}

	public static function instantiation($the_record) {

		$calling_class = get_called_class();

		//A calling=meghívó Class példányosítása
		$the_object = new $calling_class();

        // $the_object = new static; // static means the class it is in (now its User)

        // $the_object->id = $found_user['id'];
        // $the_object->username = $found_user['username'];
        // $the_object->password = $found_user['password'];
        // $the_object->first_name = $found_user['first_name'];
        // $the_object->last_name = $found_user['last_name'];

        // auto instantiation based on db columns
        foreach ($the_record as $the_attribute => $value) {
        	if($the_object->has_the_attribute($the_attribute)) {

        		$the_object->$the_attribute = $value;

        	}
        }

        return $the_object;

	}

	// private, because we dont nee to use it outside the class
	private function has_the_attribute($the_attribute) {

		// definiált property-k lekérése
		$object_properties = get_object_vars($this);

		return array_key_exists($the_attribute, $object_properties);

	}

	protected function properties() {

		//getting all the object properties
		// return get_object_vars($this);

		$properties = array();

		foreach (static::$db_table_fields as $db_field) {
			if(property_exists($this, $db_field)) {
				$properties[$db_field] = $this->$db_field; // $db_field is a dynamic variable
			}
		}

		return $properties;

	}

	protected function clean_properties() {

		global $database;

		$clean_properties = array();

		foreach ($this->properties() as $key => $value) {
			$clean_properties[$key] = $database->escape_string($value);
		}

		return $clean_properties;

	}

	public function save() {

		// if the data is already there: update, if its not there: create
		return isset($this->emp_no) ? $this->update() : $this->create();

	}

	public function create() {

		global $database;

		// $sql = "INSERT INTO " . static::$db_table . "(username, password, first_name, last_name)";
		// $sql .= $database->escape_string($this->username) . "', '";
		// $sql .= $database->escape_string($this->password) . "', '";
		// $sql .= $database->escape_string($this->first_name) . "', '";
		// $sql .= $database->escape_string($this->last_name) . "')";

		// getting all the object properties
		$properties = $this->clean_properties();

		$sql = "INSERT INTO " . static::$db_table . "(" . implode(",", array_keys($properties)) .")";
		$sql .= "VALUES ('". implode("','", array_values($properties)) ."')";

		if($database->query($sql)) {

			// pulling the id of the last query
			$this->id = $database->the_insert_id();

			return true;

		} else {

			return false;

		}

	} // Create Method

	public function update() {

		global $database;

		$properties = $this->clean_properties();

		$properties_pairs = array();

		foreach ($properties as $key => $value) {
			$properties_pairs[] = "{$key}='{$value}'";
		}

		// $sql .= "username= '" . $database->escape_string($this->username) . "', ";
		// $sql .= "password= '" . $database->escape_string($this->password) . "', ";
		// $sql .= "first_name= '" . $database->escape_string($this->first_name) . "', ";
		// $sql .= "last_name= '" . $database->escape_string($this->last_name) . "' ";

		$sql = "UPDATE " .static::$db_table. " SET ";
		$sql .= implode(",", $properties_pairs);
		$sql .= " WHERE emp_no= " . $database->escape_string($this->emp_no);

		$database->query($sql);

		// checking if something was modified
		return (mysqli_affected_rows($database->connection) == 1) ? true : false;

	} // End of Update Method

	public function delete() {

		global $database;

		$sql = "DELETE FROM " .static::$db_table. " ";
		$sql .= "WHERE emp_no=" . $database->escape_string($this->emp_no);
		$sql .= " LIMIT 1"; // just to make sure there is only gonna come back with 1 row

		$database->query($sql);

		return (mysqli_affected_rows($database->connection) == 1) ? true : false;

	}

}

?>