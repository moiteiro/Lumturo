<?php

class City extends DatabaseObject{
	
	public $id;
	public $state_id;
	public $name;

	// não manipuláveis
	// apenas para a visualização
	public $created_at;
	public $updated_at;
	
	protected static $table_name = "cities";
	protected static $db_fields = array(	
										"id"          => INTEGER,
										"state_id"    => INTEGER,
										"name"        => STRING,
										);

	/**
	 * Encontra uma cidade a partir do nome
	 * @access public
	 * @param string $name
	 * @return object
	*/
	public static function find_by_state_and_name($state, $name) {
		global $database;

		$query = sprintf("SELECT * FROM cities WHERE state_id = %s AND name ='%s'", 
			$database->escape_value($state),
			$database->escape_value($name));

		return self::find_by_sql($query);
	}	

	/**
	 * Encontra uma cidade a partir do nome
	 * @access public
	 * @param string $name
	 * @return object
	*/
	public static function find_by_name($name) {
		global $database;

		#$query = sprintf("SELECT * FROM cities WHERE name like '%%%s%%'", $database->escape_value($name));
		$query = sprintf("SELECT * FROM cities WHERE name ='%s'", $database->escape_value($name));

		return self::find_by_sql($query);
	}	
}

?>